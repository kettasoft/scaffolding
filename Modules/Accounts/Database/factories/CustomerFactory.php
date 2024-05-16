<?php

namespace Modules\Accounts\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Accounts\Entities\Customer;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Accounts\Entities\Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Customer',
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'email_verified_at' => now(),
            'password' => \Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return CustomerFactory
     */
    public function configure()
    {
        return $this->afterCreating(function (Customer $user) {
            Customer::withoutEvents(function () use ($user) {
                $user->forceFill([
                    'email_verified_at' => now(),
                ])->save();
            });
        });
    }
}

