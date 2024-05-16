<?php

namespace Modules\Accounts\Tests\Feature\Api;

use Laravel\Sanctum\Sanctum;
use Modules\Accounts\Entities\Customer;
use Tests\TestCase;

class ProfileTest extends TestCase
{


    /** @test */
    public function only_to_authenticated_user_can_display_his_profile()
    {
        $user = Customer::factory()->create();

        $this->getJson(route('user.profile.show'))
            ->assertStatus(401);

        Sanctum::actingAs($user, ['*']);

        $this->getJson(route('user.profile.show'))
            ->assertSuccessful()
            ->assertSee('data')
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'phone',
                ]
            ]);
    }

    /** @test */
    public function only_to_authenticated_user_can_update_his_profile()
    {
        $user = Customer::factory()->create([
            'name' => 'Ahmed',
            'email' => 'ahmed@demo.com',
            'phone' => '123456789',
        ]);

        $this->postJson(route('user.profile.update'))
            ->assertStatus(401);

        Sanctum::actingAs($user, ['*']);

        // test validation

        $this->postJson(route('user.profile.update'), [
            'name' => 'Ahmed',
            'email' => 'ahmed@demo.com',
            'phone' => '123456789',
        ])->assertSee('data')
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'phone',
                ]
            ]);

        $this->postJson(route('user.profile.update'), [
            'name' => 'Mohamed',
            'email' => 'mohamed@demo.com',
            'phone' => '12345678',
        ])->assertSuccessful()
            ->assertSee('data')
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'phone',
                ]
            ]);
    }
}
