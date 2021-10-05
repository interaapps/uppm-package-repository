<?php
namespace com\example\myproject\responses;

use com\example\myproject\model\Organisation;
use com\example\myproject\model\Package;
use de\interaapps\jsonplus\attributes\Serialize;
use de\interaapps\jsonplus\JSONModel;

class PackageResponse {
    use JSONModel;

    public int $id;
    public int $organisation_id;
    public string $name;
    public string $github;
    public string $created_at;

    public function __construct(
        Package $package,
        public array $versions
    ){
        $this->id = $package->id;
        $this->name = $package->name;
        $this->github = $package->github;
        $this->organisation_id = $package->organisation_id;
        $this->created_at = $package->created_at;
    }
}