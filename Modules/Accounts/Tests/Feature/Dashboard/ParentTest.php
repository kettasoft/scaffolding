<?php

namespace Modules\Accounts\Tests\Feature\Dashboard;

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Accounts\Entities\ParentModel;
use Tests\TestCase;

class ParentTest extends TestCase
{
    /** @test */
    public function it_can_display_list_of_parents()
    {
        $this->actingAsAdmin();

        $parent = ParentModel::factory()->create();

        $response = $this->get(route('dashboard.parents.index'));

        $response->assertSuccessful();

        $response->assertSee(e($parent->name));
    }

    /** @test */
    public function it_can_display_parent_details()
    {
        $this->actingAsAdmin();

        $parent = ParentModel::factory()->create();

        $response = $this->get(route('dashboard.parents.show', $parent));

        $response->assertSuccessful();

        $response->assertSee(e($parent->name));
    }

    /** @test */
    public function it_can_display_parent_create_form()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.parents.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('accounts::parents.actions.create'));
    }

    /** @test */
    public function it_can_create_parents()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $parentsCount = ParentModel::count();

        $response = $this->postJson(
            route('dashboard.parents.store'),
            [
                'name' => 'ParentModel',
                'email' => 'parent@demo.com',
                'phone' => '123456789',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]
        );

        $response->assertRedirect();

        $this->assertEquals(ParentModel::count(), $parentsCount + 1);
    }

    /** @test */
    public function it_can_display_parent_edit_form()
    {
        $this->actingAsAdmin();

        $parent = ParentModel::factory()->create();

        $response = $this->get(route('dashboard.parents.edit', $parent));

        $response->assertSuccessful();

        $response->assertSee(trans('accounts::parents.actions.edit'));
    }

    /** @test */
    public function it_can_update_parents()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $parent = ParentModel::factory()->create();

        $response = $this->put(
            route('dashboard.parents.update', $parent),
            [
                'name' => 'ParentModel',
                'email' => 'parent@demo.com',
                'phone' => '123456789',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]
        );

        $response->assertRedirect();

        $parent->refresh();

        $this->assertEquals($parent->name, 'ParentModel');
    }

    /** @test */
    public function it_can_delete_parent()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $parent = ParentModel::factory()->create();

        $parentsCount = ParentModel::count();

        $response = $this->delete(route('dashboard.parents.destroy', $parent));
        $response->assertRedirect();

        $this->assertEquals(ParentModel::count(), $parentsCount - 1);
    }
}
