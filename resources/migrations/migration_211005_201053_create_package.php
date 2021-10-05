<?php
namespace resources\migrations;

use de\interaapps\ulole\orm\Database;
use de\interaapps\ulole\orm\migration\Blueprint;
use de\interaapps\ulole\orm\migration\Migration;

/**
 * CHANGED: Created table
 */
class migration_211005_201053_create_package implements Migration {
    public function up(Database $database) {
        return $database->create("uppm_packages_packages", function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->int("organisation_id");
            $blueprint->int("user_id");
            $blueprint->string("download_url");
            $blueprint->enum("type", ["MEMBER", "ADMIN", "OWNER"]);
            $blueprint->timestamp("created_at")->currentTimestamp();
        });
    }

    public function down(Database $database) {
        return $database->drop("uppm_packages_packages");
        
    }
}