<?php
namespace resources\migrations;

use de\interaapps\ulole\orm\Database;
use de\interaapps\ulole\orm\migration\Blueprint;
use de\interaapps\ulole\orm\migration\Migration;

/**
 * CHANGED: Created table
 */
class migration_211005_201002_create_package_version implements Migration {
    public function up(Database $database) {
        return $database->create("uppm_packages_package_versions", function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string("name");
            $blueprint->int("package_id");
            $blueprint->string("download_url");
            $blueprint->timestamp("created_at")->currentTimestamp();
        });
    }

    public function down(Database $database) {
        return $database->drop("uppm_packages_package_versions");
        
    }
}