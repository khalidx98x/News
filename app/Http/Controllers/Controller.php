<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\MessageBag;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function success($data, $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'errors' => 0,
        ], $status)
            ->header('Content-type', 'application/json');
    }

    public function error($data, $status = 500)
    {
        if ($data instanceof MessageBag) {
            $data = $data->first();
        }
        $response = response()->json([
            'status' => 'error',
            'data' => $data,
            'errors' => 1,
        ], $status)
            ->header('Content-type', 'application/json');

        return $response;
    }
}
