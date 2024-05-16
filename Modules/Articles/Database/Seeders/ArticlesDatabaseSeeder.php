<?php

namespace Modules\Articles\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Modules\Articles\Entities\Article;

class ArticlesDatabaseSeeder extends Seeder
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

            $model = Article::create($data);
        }
    }

    private function articles()
    {
        return [
            [
                'name:ar' => 'رمضان كريم',
                'name:en' => 'Ramadan Kareem',
                'content:ar' => 'رمضان كريم',
                'content:en' => 'Ramadan Kareem',
            ],
        ];
    }
}
