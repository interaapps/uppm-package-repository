<?php
namespace com\example\myproject\responses;

use com\example\myproject\model\Organisation;
use de\interaapps\jsonplus\attributes\Serialize;
use de\interaapps\jsonplus\JSONModel;

class OrganisationResponse {
    use JSONModel;

    public int $id;
    public string $name;
    public string $created_at;

    public function __construct(
        Organisation $organisation,
        public array $packages
    ){
        $this->id = $organisation->id;
        $this->name = $organisation->name;
        $this->created_at = $organisation->created_at;
    }
}