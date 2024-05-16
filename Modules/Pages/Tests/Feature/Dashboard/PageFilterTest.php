<?php

namespace Modules\Pages\Tests\Feature\Dashboard;

use Modules\Pages\Entities\Page;
use Tests\TestCase;

class PageFilterTest extends TestCase
{


    /** @test */
    public function it_can_filter_pages_by_title()
    {
        $this->actingAsAdmin();

        Page::factory()->create([
            'title' => 'سياسة الخصوصية',
        ]);

        Page::factory()->create([
            'title' => 'شروط الاستخدام',
        ]);

        $this->get(route('dashboard.pages.index', [
            'title' => 'سياسة الخصوصية',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('pages::pages.actions.filter'))
            ->assertSee('سياسة الخصوصية')
            ->assertDontSee('شروط الاستخدام');
    }
}
