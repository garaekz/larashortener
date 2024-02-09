<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\Short;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This should seed 100 Short records to each App
        $apps = App::all();

        $apps->each(function ($app) {
            Short::factory(100)
                ->create([
                    'shortable_id' => $app->id,
                    'shortable_type' => App::class,
                ]);
        });
    }
}
