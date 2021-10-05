<?php
namespace com\example\myproject\controller;

use com\example\myproject\App;
use com\example\myproject\helper\Web;
use com\example\myproject\model\Organisation;
use com\example\myproject\model\Package;
use com\example\myproject\model\PackageVersion;
use com\example\myproject\model\User;
use com\example\myproject\responses\ErrorResponse;
use de\interaapps\ulole\router\attributes\Controller;
use de\interaapps\ulole\router\attributes\Route;
use de\interaapps\ulole\router\Request;
use de\interaapps\ulole\router\Response;

#[Controller()]
class PackageController {
    #[Route("/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)", method: "GET")]
    public function _getPackage(Request $req, Response $resp, $orgaName, $name)
    {
        $package = $this->getPackage($orgaName, $name);
        if ($package == null)
            return ErrorResponse::notFound();
        return $package->createResponse();
    }

    #[Route("/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/checkgithub", method: "GET")]
    public function checkGithub(Request $req, Response $resp, $orgaName, $name){
        $package = $this->getPackage($orgaName, $name);
        if ($package == null) {
            $resp->json(false);
            return;
        }

        $releases = App::getInstance()->getRouter()->getJsonPlus()->fromJson(Web::httpRequest("https://api.github.com/repos/$package->github/releases"));

        foreach ($releases as $release) {
            if (PackageVersion::table()->where("package_id", $package->id)->where("name", $release->name)->count() == 0) {
                $packageVersion = new PackageVersion();
                $packageVersion->name = $release->name;
                $packageVersion->download_url = $release->zipball_url;
                $packageVersion->package_id = $package->id;
                $packageVersion->save();
            }
        }

        $resp->json(true);
    }

    #[Route("/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/((@)?[a-zA-Z0-9_.-]+)", method: "GET")]
    public function getVersion(Request $req, Response $resp, $orgaName, $name, $version)
    {
        $package = $this->getPackage($orgaName, $name);
        if ($package == null) return ErrorResponse::notFound();
        $versionR = PackageVersion::table()->where("package_id", $package->id);
        if ($version == '@latest')
            $versionR->orderBy("created_at", true);
        else
            $versionR->where("name", $version);
        $version = $versionR->get();
        if ($version == null) return ErrorResponse::notFound();
        return $version->createResponse();
    }

    private function getPackage($orga, $name) : Package|null {
        $orga = Organisation::table()->where("name", $orga)->get();
        if ($orga == null)
            return null;
        $package = Package::table()->where("name", $name)->where("organisation_id", $orga->id)->get();
        return $package;
    }
}