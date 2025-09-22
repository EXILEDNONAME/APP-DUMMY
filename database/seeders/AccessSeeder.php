<?php

namespace Database\Seeders;

use App\Models\Access;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccessSeeder extends Seeder
{

  public function run(): void
  {

    $access = [
      [
        'name'              => 'Administrator',
      ],
      [
        'name'              => 'Admin',
      ],
      [
        'name'              => 'User',
      ],

    ];
    Access::insert($access);
  }
}
