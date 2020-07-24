<?php


namespace App\Http\Traits;

Use Response;

trait ApiResponse
{
    /**
     * @param $result
     * @param $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message, $code)
    {
        return Response::json(self::makeResponse($message, $result), $code);
    }

    public function sendError($error, $code = 400, $data = [])
    {
        return Response::json(self::makeError($error, $data), $code);
    }

    public static function makeResponse($message, $data)
    {
        return [
            'success'   => true,
            'data'      => $data,
            'message'   => $message
        ];
    }

    public static function makeError($message, array $data = [])
    {
        $res = [
            'success'   => false,
            'message'   => $message
        ];

        if (!empty($data)) {
            $res['data'] = $data;
        } else {
            $res['data'] = 'Ошибка!!!';
        }

        return $res;
    }

}
