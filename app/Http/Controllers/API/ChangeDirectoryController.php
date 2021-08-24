<?php

namespace App\Http\Controllers\API;

use App\Helpers\Path;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeDirectoryController extends Controller
{
    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $path = new Path('/a/b/c/d');
        } catch (QueryException $exception) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'error' => false,
            'newPath' => $path->cd($request->newPath),
        ], Response::HTTP_OK);
    }


}
