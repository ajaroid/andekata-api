<?php

namespace App\Modules\Simdes\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('provincy')->truncate();
        DB::table('regency')->truncate();
        DB::table('subdistrict')->truncate();
        DB::table('village')->truncate();

        $sql = app_path('Modules/Simdes/Database/Seeds/wilayah.sql');
        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $db = env('DB_DATABASE');

        $q = sprintf("mysql -u %s -p%s %s < %s", $user, $password, $db, $sql);
        var_dump($q);
        exec($q);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
