<?php

namespace Modules\Accounts\Tests\Feature\Api;

use Illuminate\Support\Facades\Event;
use Modules\Accounts\Entities\Customer;
use Modules\Accounts\Entities\Verification;
use Modules\Accounts\Events\VerificationCreated;
use Tests\TestCase;


class EmailVerificationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // set your headers here
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);

    }

    /** @test */
    public function it_can_send_or_resend_the_phone_verification_code()
    {
        Event::fake();

        $customer = Customer::factory()->create(['phone' => '987456321']);

        $response = $this->postJson(route('verification.send'), [
            'phone' => $customer->phone,
        ]);

        $response->assertSuccessful();

        Event::assertDispatched(VerificationCreated::class);
    }

    /** @test */
    public function it_can_verify_the_phone_number()
    {
        $customer = Customer::factory()->create(['phone' => '987456321']);

        Event::fake();

        Verification::create([
            'user_id' => $customer->id,
            'phone' => '987456321',
            'code' => 'foobar',
        ]);

        $this->assertEquals(Verification::count(), 1);

        $this->postJson(route('verification.verify'), [
            'code' => 'foo',
        ])->assertSee('data')
            ->assertJsonStructure([
                'data',
                'message',
                'success'
            ]);

        $this->travelTo(now()->addMinutes(5));

        $this->postJson(route('verification.verify'), [
            'code' => 'foobar',
        ])->assertSee('data')
            ->assertJsonStructure([
                'data',
                'message',
                'success'
            ]);

        $this->travelBack();

        $this->postJson(route('verification.verify'), [
            'code' => 'foobar',
        ])->assertSuccessful();

        $this->assertEquals(Verification::count(), 1);

        $this->assertNotNull($customer->refresh()->email_verified_at);
        $this->assertEquals($customer->phone, '987456321');
    }

}
