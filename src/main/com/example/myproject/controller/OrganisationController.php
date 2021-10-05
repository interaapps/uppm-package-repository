<?php
namespace com\example\myproject\controller;

use com\example\myproject\model\Organisation;
use de\interaapps\ulole\router\attributes\Controller;
use de\interaapps\ulole\router\attributes\Route;
use de\interaapps\ulole\router\Request;
use de\interaapps\ulole\router\Response;

#[Controller()]
class OrganisationController {
    #[Route("/", method: "GET")]
    public static function getOrgas(Request $req, Response $resp){
        return array_map(fn($o)=>$o->createResponse(), Organisation::table()->all());
    }

    #[Route("/([a-zA-Z0-9_-]+)", method: "GET")]
    public static function getOrga(Request $req, Response $resp, $name){
        return Organisation::table()->where("name", $name)->get()->createResponse();
    }
}