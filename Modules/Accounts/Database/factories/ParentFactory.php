<?php

namespace Modules\Accounts\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Accounts\Entities\ParentModel::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
