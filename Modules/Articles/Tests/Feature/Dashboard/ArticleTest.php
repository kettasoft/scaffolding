<?php

namespace Modules\Articles\Tests\Feature\Dashboard;

use App\Http\Middleware\VerifyCsrfToken;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Articles\Entities\Article;
use Tests\TestCase;

class ArticleTest extends TestCase
{


    /** @test */
    public function it_can_display_list_of_articles()
    {
        $this->actingAsAdmin();

        $article = Article::factory()->create();

        $response = $this->get(route('dashboard.articles.index'));

        $response->assertSuccessful();

        $response->assertSee(e($article->name));
    }

    /** @test */
    public function it_can_display_article_details()
    {
        $this->actingAsAdmin();

        $article = Article::factory()->create();

        $response = $this->get(route('dashboard.articles.show', $article));

        $response->assertSuccessful();

        $response->assertSee(e($article->name));
    }

    /** @test */
    public function it_can_create_articles()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $this->assertEquals(0, Article::count());

        $response = $this->post(
            route('dashboard.articles.store'),
            RuleFactory::make(
                [
                    '%name%' => 'Clothes',
                    '%content%' => 'Clothes',
                ]
            )
        );
        $response->assertRedirect();
        self::assertEquals(1, Article::count());
    }

    /** @test */
    public function it_can_display_articles_edit_form()
    {
        $this->actingAsAdmin();

        $article = Article::factory()->create();

        $response = $this->get(route('dashboard.articles.edit', [$article]));

        $response->assertSuccessful();

        $response->assertSee(trans('articles::articles.actions.edit'));
    }

    /** @test */
    public function it_can_update_articles()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $article = Article::factory()->create();

        $response = $this->put(
            route('dashboard.articles.update', [$article]),
            RuleFactory::make(
                [
                    '%name%' => 'Clothes',
                    '%content%' => 'Clothes',
                ]
            )
        );

        $response->assertRedirect();

        $article->refresh();

        $this->assertEquals($article->name, 'Clothes');
    }

    /** @test */
    public function it_can_delete_articles()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $article = Article::factory()->create();

        $response = $this->delete(route('dashboard.articles.destroy', [$article]));
        $response->assertRedirect();

        $this->assertEquals(Article::count(), 0);
    }
}
