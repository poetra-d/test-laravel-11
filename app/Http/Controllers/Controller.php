<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function responseJson($data = null, $status = 200, $message = 'Ok', $httpStatus = 200) {
        return response()->json([
            'status' => $status,
            'message' => __($message),
            'data' => $data,
        ], $httpStatus);
    }

    protected function responseError($message = 'Ok', $status = 400) {
        return $this->responseJson(null, $status, $message, $status);
    }

    protected function responseNotFound() {
        return $this->responseJson(null, 404, 'Data tidak ditemukan');
    }

    protected function responseSuccess($message = 'Berhasil') {
        return $this->responseJson(null, 200, $message);
    }

    protected function responseValidator($data = null, $message = null) {
        $errors = [];
        foreach ($data->getRules() as $key => $attribute) {
            $errors = $data->errors()->getMessages();
            if (array_key_exists($key, $errors)) {
                $errors[$key] = implode('\n', $errors[$key]);
                if ($message == null) {
                    $message = $errors[$key];
                }
            }
        }

        return response()->json([
            'status' => 400,
            'message' => $message ?? __('Mohon lengkapi formulir terlebih dahulu'),
            'data' => $errors,
        ], 400);
    }
}