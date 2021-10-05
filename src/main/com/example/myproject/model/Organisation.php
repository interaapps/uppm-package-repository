<?php
namespace com\example\myproject\model;

use com\example\myproject\responses\OrganisationResponse;
use com\example\myproject\responses\PackageResponse;
use com\example\myproject\responses\PackageVersionResponse;
use de\interaapps\jsonplus\JSONModel;
use de\interaapps\ulole\orm\ORMModel;

class Organisation {
    use ORMModel;
    use JSONModel;

    public int $id;
    public string $name;
    public string $created_at;

    protected $ormSettings = [
        'identifier' => 'id'
    ];

    public function createResponse() : OrganisationResponse {
        return new OrganisationResponse($this, array_map(fn($p)=>$p->createResponse(), Package::table()->where("organisation_id", $this->id)->all()));
    }
}