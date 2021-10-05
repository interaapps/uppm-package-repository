<?php
namespace com\example\myproject\responses;

class ErrorResponse {
    public bool $error = true;
    public function __construct(
        public string|null $message = null
    ){ }

    public static function notFound() : ErrorResponse {
        return new ErrorResponse("Resource not found.");
    }
}