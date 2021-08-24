<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CalculateDistanceController extends Controller
{

    protected $locations = [

        ['id' => 1000, 'zip_code' => '37069', 'lat' => 45.35, 'lng' => 10.84],
        ['id' => 1001, 'zip_code' => '37121', 'lat' => 45.44, 'lng' => 10.99],
        ['id' => 1001, 'zip_code' => '37129', 'lat' => 45.44, 'lng' => 11.00],
        ['id' => 1001, 'zip_code' => '37133', 'lat' => 45.43, 'lng' => 11.02],
    ];

    protected $shoppers = [

        ['id' => 'S1', 'lat' => 45.46, 'lng' => 11.03, 'enabled' => true],
        ['id' => 'S2', 'lat' => 45.46, 'lng' => 10.12, 'enabled' => true],
        ['id' => 'S3', 'lat' => 45.34, 'lng' => 10.81, 'enabled' => true],
        ['id' => 'S4', 'lat' => 45.76, 'lng' => 10.57, 'enabled' => true],
        ['id' => 'S5', 'lat' => 45.34, 'lng' => 10.63, 'enabled' => true],
        ['id' => 'S6', 'lat' => 45.42, 'lng' => 10.81, 'enabled' => true],
        ['id' => 'S7', 'lat' => 45.34, 'lng' => 10.94, 'enabled' => true],
    ];

    public function index()
    {
//        $shoppers = collect($this->shoppers)->groupBy('enabled');
//
//        dd($shoppers);
//
//        $locations = $shoppers->merge($this->locations)->all();
//        dd($locations);

        foreach ($this->shoppers as $k => $v) {
            $lat1 = $v['lat'];
            $lng1 = $v['lng'];
            foreach ($this->locations as $key => $val) {
                $lat2 = $val['lat'];
                $lng2 = $val['lng'];
                $miles = $this->distance($lat1, $lng1, $lat2, $lng2);

            }
            return response()->json([
                [
                  'shopper_id'=>$v['id'],
                  'coverage' => $miles * 1.609344
                ],

            ], Response::HTTP_OK);
        }


    }

    /**
     * @param $lat1
     * @param $lon1
     * @param $lat2
     * @param $lon2
     * @return float
     */
    public function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        return $miles;

    }
}
