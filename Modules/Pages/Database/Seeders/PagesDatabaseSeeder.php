<?php

namespace Modules\Pages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Modules\Pages\Entities\Page;

class PagesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed($this->articles());
    }

    /**
     * Run the database seeds.
     *
     * @param array $articles
     * @return void
     */
    public function seed(array $articles = []): void
    {
        foreach ($articles as $lab) {
            $data = Arr::except($lab, ['image']);

            $model = Page::create($data);
        }
    }

    private function articles()
    {
        return [
            [
                'title:ar' => 'رمضان كريم',
                'title:en' => 'Ramadan Kareem',
                'content:ar' => 'رمضان كريم',
                'content:en' => 'Ramadan Kareem',
                'link' => 'https://google.com'
            ],
        ];
    }
}
