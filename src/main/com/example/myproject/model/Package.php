<?php
namespace com\example\myproject\model;

use com\example\myproject\responses\OrganisationResponse;
use com\example\myproject\responses\PackageResponse;
use com\example\myproject\responses\PackageVersionResponse;
use de\interaapps\jsonplus\JSONModel;
use de\interaapps\ulole\orm\ORMModel;

class Package {
    use ORMModel;
    use JSONModel;
    
    public int $id;
    public string $name;
    public int $organisation_id;
    public string $github;
    public string $created_at;

    protected $ormSettings = [
        'identifier' => 'id'
    ];

    public function createResponse() : PackageResponse {
        return new PackageResponse($this,
                array_map(fn($pv)=>$pv->createResponse(), PackageVersion::table()->where("package_id", $this->id)->orderBy("created_at", true)->all()));
    }
}