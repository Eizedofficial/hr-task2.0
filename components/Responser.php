<?php

class Responser
{
    public static function response(bool $status, array $data = [], string $message = null): void
    {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ]);

        exit(0);
    }
}