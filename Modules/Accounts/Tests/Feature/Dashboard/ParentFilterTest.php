<?php

namespace Modules\Accounts\Tests\Feature\Dashboard;

use Modules\Accounts\Entities\ParentModel;
use Tests\TestCase;

class ParentFilterTest extends TestCase
{


    /** @test */
    public function it_can_filter_parents_by_name()
    {
        $this->actingAsAdmin();

        ParentModel::factory()->create(['name' => 'Ahmed']);

        ParentModel::factory()->create(['name' => 'Mohamed']);

        $this->get(route('dashboard.parents.index', [
            'name' => 'ahmed',
        ]))
            ->assertSuccessful()
            ->assertSee('Ahmed')
            ->assertDontSee('Mohamed');
    }

    /** @test */
    public function it_can_filter_parents_by_email()
    {
        $this->actingAsAdmin();

        ParentModel::factory()->create([
            'name' => 'User 1',
            'email' => 'user1@demo.com',
        ]);

        ParentModel::factory()->create([
            'name' => 'User 2',
            'email' => 'user2@demo.com',
        ]);

        $this->get(route('dashboard.parents.index', [
            'email' => 'user1@',
        ]))
            ->assertSuccessful()
            ->assertSee('User 1')
            ->assertDontSee('User 2');
    }

    /** @test */
    public function it_can_filter_parents_by_phone()
    {
        $this->actingAsAdmin();

        ParentModel::factory()->create([
            'name' => 'User 1',
            'phone' => '123',
        ]);

        ParentModel::factory()->create([
            'name' => 'User 2',
            'email' => '456',
        ]);

        $this->get(route('dashboard.parents.index', [
            'phone' => '123',
        ]))
            ->assertSuccessful()
            ->assertSee('User 1')
            ->assertDontSee('User 2');
    }
}
