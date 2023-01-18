<?php
class ErrorHandler{
    public static function handleException(Throwable $exception): void
    {
        http_response_code(500); //set the returned error type
        echo json_encode([

            "code" => $exception->getCode(),
            "message" => $exception->getMessage(),
            "file" => $exception->getFile(),
            "line" => $exception->getLine()
        ]);

    }
}