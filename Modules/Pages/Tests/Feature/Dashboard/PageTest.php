<?php

namespace Modules\Pages\Tests\Feature\Dashboard;

use App\Http\Middleware\VerifyCsrfToken;
use Astrotomic\Translatable\Validation\RuleFactory;
use Modules\Pages\Entities\Page;
use Tests\TestCase;

class PageTest extends TestCase
{


    /** @test */
    public function it_can_display_list_of_pages()
    {
        $this->actingAsAdmin();

        $page = Page::factory()->create();

        $response = $this->get(route('dashboard.pages.index'));

        $response->assertSuccessful();

        $response->assertSee(e($page->name));
    }

    /** @test */
    public function it_can_display_page_details()
    {
        $this->actingAsAdmin();

        $page = Page::factory()->create();

        $response = $this->get(route('dashboard.pages.show', $page));

        $response->assertSuccessful();

        $response->assertSee(e($page->title));
    }

    /** @test */
    public function it_can_create_pages()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $response = $this->post(
            route('dashboard.pages.store'),
            RuleFactory::make(
                [
                    '%title%' => 'privacy policy',
                    '%content%' => 'privacy policy description',
                    'link' => '#',
                ]
            )
        );

        $response->assertRedirect();
        $this->assertEquals(Page::all()->last()->title, 'privacy policy');
    }

    /** @test */
    public function it_can_display_pages_edit_form()
    {
        $this->actingAsAdmin();

        $page = Page::factory()->create();

        $response = $this->get(route('dashboard.pages.edit', [$page]));

        $response->assertSuccessful();

        $response->assertSee(trans('pages::pages.actions.edit'));
    }

    /** @test */
    public function it_can_update_pages()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $page = Page::factory()->create();

        $response = $this->put(
            route('dashboard.pages.update', [$page]),
            RuleFactory::make(
                [
                    '%title%' => 'privacy',
                    '%content%' => 'privacy policy description',
                    'link' => '#',
                ]
            )
        );

        $response->assertRedirect();

        $page->refresh();

        $this->assertEquals($page->title, 'privacy');
        $this->assertEquals($page->link, '#');
    }

    /** @test */
    public function it_can_delete_pages()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $page = Page::factory()->create();

        $pagesCount = Page::count();

        $response = $this->delete(route('dashboard.pages.destroy', [$page]));
        $response->assertRedirect();

        $this->assertEquals(Page::count(), $pagesCount - 1);
    }

    /** @test */
    public function it_can_delete_front_pages()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $page = Page::factory()->create();

        $pages = Page::get();

        $pagesCount = $pages->count();

        $response = $this->delete(route('dashboard.pages.destroy', [$page]));
        $response->assertRedirect();

        $pages_after = Page::get();

        $this->assertEquals($pages_after->count(), $pagesCount - 1);
    }
}
