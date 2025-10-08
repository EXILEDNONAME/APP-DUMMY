<?php

namespace Database\Seeders\Setting;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use App\Models\Backend\__System\Administrative\Application\Customization;

class CustomizationSeeder extends Seeder
{

    public function run()
    {
        $data = [
            [
                'topbar_application'    => '0',
                'topbar_chat'           => '0',
                'topbar_notification'   => '0',
                'topbar_search'         => '0',
                'created_at'            => Carbon::now(),
            ],
        ];

        Customization::insert($data);
    }
}
