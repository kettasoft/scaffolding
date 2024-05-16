<?php

namespace Modules\Settings\Database\Seeders;

use App\Support\SettingJson;
use Illuminate\Database\Seeder;
use Laraeast\LaravelSettings\Facades\Settings;

class SettingsDatabaseSeeder extends Seeder
{
    /**
     * The list of the files keys.
     *
     * @var array
     */
    protected $files = [
        'logo',
        'favicon',
        'loginLogo',
        'loginBackground',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::set('name:en', 'EDA');
        Settings::set('name:ar', 'EDA');

        Settings::set('description:en', 'EDA');
        Settings::set('description:ar', 'EDA');

        Settings::set('meta_description:en', 'EDA');
        Settings::set('meta_description:ar', 'EDA');

        // images
//        foreach ($this->files as $file) {
//            Settings::set($file)->addMedia(__DIR__ . '/images/' . $file . '.png')
//                ->preservingOriginal()
//                ->toMediaCollection($file);
//        }

        app(SettingJson::class)->update();
    }
}
