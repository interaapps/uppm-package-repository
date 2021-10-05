<?php
namespace com\example\myproject\model;

use com\example\myproject\responses\PackageResponse;
use com\example\myproject\responses\PackageVersionResponse;
use de\interaapps\jsonplus\JSONModel;
use de\interaapps\ulole\orm\ORMModel;

class PackageVersion {
    use ORMModel;
    use JSONModel;

    public int $id;
    public int $package_id;
    public string $name;
    public string $download_url;
    public string $created_at;

    protected $ormSettings = [
        'identifier' => 'id'
    ];


    public function createResponse() : PackageVersionResponse {
        return new PackageVersionResponse($this);
    }
}