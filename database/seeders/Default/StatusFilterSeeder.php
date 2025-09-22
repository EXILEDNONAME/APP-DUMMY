<?php

namespace Database\Seeders\Default;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Backend\__System\Datatable\StatusFilter;

class StatusFilterSeeder extends Seeder {

  public function run() {
    $data = [
      [
        'name'        => 'default',
        'properties'  => '{"1": "Default", "2": "Pending", "3": "Progress", "4": "Success", "5": "Failed"}',
        'created_at'  => Carbon::now(),
      ],
    ];

    StatusFilter::insert($data);
  }

}
