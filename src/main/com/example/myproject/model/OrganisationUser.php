<?php
namespace com\example\myproject\model;

use de\interaapps\jsonplus\JSONModel;
use de\interaapps\ulole\orm\ORMModel;

class OrganisationUser {
    use ORMModel;
    use JSONModel;

    public int $id;
    public int $organisation_id;
    public int $user_id;
    public string $type;
    public string $created_at;

    protected $ormSettings = [
        'identifier' => 'id'
    ];
}