<?php

namespace Modules\Articles\Tests\Feature\Dashboard;

use Modules\Articles\Entities\Article;
use Tests\TestCase;

class ArticleFilterTest extends TestCase
{


    /** @test */
    public function it_can_filter_articles_by_name()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('ar');

        Article::factory()->create([
            'name:ar' => 'ملابس',
        ]);

        Article::factory()->create([
            'name:ar' => 'هواتف',
        ]);

        $this->get(route('dashboard.articles.index', [
            'name' => 'ملابس',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('articles::articles.actions.filter'))
            ->assertSee('ملابس')
            ->assertDontSee('هواتف');
    }
}
