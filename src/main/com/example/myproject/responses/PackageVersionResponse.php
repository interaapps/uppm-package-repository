<?php
namespace com\example\myproject\responses;

use com\example\myproject\model\Organisation;
use com\example\myproject\model\Package;
use com\example\myproject\model\PackageVersion;
use de\interaapps\jsonplus\attributes\Serialize;
use de\interaapps\jsonplus\JSONModel;

class PackageVersionResponse {
    use JSONModel;

    public int $id;
    public int $package_id;
    public string $name;
    public string $download_url;
    public string $created_at;

    public function __construct(
        PackageVersion $packageVersion
    ){
        $this->id = $packageVersion->id;
        $this->name = $packageVersion->name;
        $this->download_url = $packageVersion->download_url;
        $this->package_id = $packageVersion->package_id;
        $this->created_at = $packageVersion->created_at;
    }
}