<?php
namespace App\Models\Php;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Settings\Php\Settings;


class Database {

    public function __construct($db_connector) {

        //load the db connection from the settings file
        //$configs = Settings::DBS($db_connector);

        //

        //initiate the connection to the DB
        /*$capsule = new Capsule;
        $capsule->addConnection( [
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'database' => 'emjeys',
                    'username' => 'grand','port'=>3306,
                    'password' => 'password',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();*/

        $capsule = new Capsule;
        $capsule->addConnection( [
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'database' => 'grand_queue_manager',
                    'username' => 'grand','port'=>3306,
                    'password' => 'password',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

    }



}