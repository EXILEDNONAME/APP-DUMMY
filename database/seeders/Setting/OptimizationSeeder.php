<?php

namespace Database\Seeders\Setting;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use App\Models\Backend\__System\Administrative\Application\Optimization;

class OptimizationSeeder extends Seeder
{

    public function run()
    {
        $data = [
            [
                "name"          => "Autoload",
                "description"   => "system('composer dump-autoload')",
                "created_at"    => Carbon::now(),
            ],
            [
                "name"          => "Cache",
                "description"   => "php artisan cache:clear",
                "created_at"    => Carbon::now(),
            ],
            [
                "name"          => "Optimize",
                "description"   => "php artisan optimize:clear",
                "created_at"    => Carbon::now(),
            ],
        ];

        Optimization::insert($data);
    }
}
