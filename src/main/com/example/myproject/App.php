<?php
namespace com\example\myproject;

use com\example\myproject\controller\AuthController;
use com\example\myproject\controller\PackageController;
use com\example\myproject\controller\SecondTestController;
use com\example\myproject\controller\OrganisationController;
use com\example\myproject\controller\UserController;
use com\example\myproject\helper\Web;
use com\example\myproject\model\Organisation;
use com\example\myproject\model\Package;
use com\example\myproject\model\PackageVersion;
use com\example\myproject\model\User;
use de\interaapps\ulole\core\jobs\JobModel;
use de\interaapps\ulole\orm\migration\Migrator;
use de\interaapps\ulole\orm\migration\table\MigrationModel;
use de\interaapps\ulole\orm\UloleORM;
use de\interaapps\ulole\core\Environment;
use de\interaapps\ulole\core\WebApplication;
use de\interaapps\ulole\core\traits\Singleton;

class App extends WebApplication {

    use Singleton;

    public function __construct() {
        self::setInstance($this);
    }

    public function init() : void {
        $this->getConfig()
            ->loadPHPFile("env.php")
            ->loadENVFile(".env")
            ->loadJSONFile("env.json");

        $this->initDatabase("database");

        $dbPrefix = "uppm_packages_";
        UloleORM::register("${dbPrefix}packages", Package::class);
        UloleORM::register("${dbPrefix}organisations", Organisation::class);
        UloleORM::register("${dbPrefix}package_versions", PackageVersion::class);

        // If you want to use Jobs
        UloleORM::register("${dbPrefix}jobs", JobModel::class);
        $this->getJobHandler()->setMode("database"); // You can choose "sync" as well
    }

    /**
     * This'll be called before running the app for the web.
     * Handle routes, views and other stuff needed for running for the web here.
     */
    public function run() : void {
        $router = $this->getRouter();

        $router->notFound(function(){
            view("error", ["error" => "Page not found"]);
        });

        $router->get("/autoload.txtphp", function(){
            return Web::httpRequest("https://raw.githubusercontent.com/interaapps/uppm/master/autoload.php");
        });

        $router->addController(new PackageController());
        $router->addController(new AuthController());
        $router->addController(new UserController());
        $router->addController(new OrganisationController());
    }

    public static function main(Environment $environment){
        (new self())->start($environment);
    }
}
