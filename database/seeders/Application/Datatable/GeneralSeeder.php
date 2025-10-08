<?php

namespace database\seeders\Application\Datatable;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSeeder extends Seeder {

  public function run(): void {
    $faker = Faker::create('id_ID');

    for($i = 1; $i <= 10000; $i++){
      DB::table('system_application_table_generals')->insert([
        'name'          => $faker->name,
        'description'   => $faker->name,
        'created_at'    => $faker->dateTime,
        'date'          => $faker->dateTime,
      ]);
    }
  }
}
