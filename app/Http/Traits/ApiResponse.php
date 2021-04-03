<?php

namespace App\Http\traits;

trait APIResponse
{
    public function success($data, $status = 200) {
        if ($status == 200) {
            $message = 'Data Sent Successfully';
        } if ($status == 201) {
            $message = 'Data created Successfully';
        } if ($status == 202) {
            $message = 'Data Accepted';
        }

        return [
            'data' => $data,
            'success' => in_array($status, [200, 201, 202]) ? true : false,
            'message' => $message,
        ];
    }

    // public function failure($data, $status = 500) {
    //     // TODO
    // }
}
