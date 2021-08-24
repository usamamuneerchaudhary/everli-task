<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertBinariesController extends Controller
{
    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $binary = decbin($request->number);
            $binaryrev = strrev($binary);
            $reversednumber = bindec($binaryrev);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'error' => false,
            'binary' => $binary,
            'binary_revered' => $binaryrev,
            'reversed_equivalent' => $reversednumber
        ], Response::HTTP_OK);
    }
}
