<?php
namespace com\example\myproject\controller;

use com\example\myproject\model\User;
use de\interaapps\ulole\router\attributes\Controller;
use de\interaapps\ulole\router\attributes\Route;
use de\interaapps\ulole\router\Request;
use de\interaapps\ulole\router\Response;

#[Controller("/auth")]
class AuthController {
    #[Route("/", method: "GET")]
    public static function test(Request $req, Response $res){
        return [];
    }
}