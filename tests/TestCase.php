<?php

namespace Tests;

use Database\Seeders\LaratrustSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Modules\Accounts\Entities\Admin;
use Modules\Accounts\Entities\Customer;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * Set the currently logged in admin for the application.
     *
     * @param null $driver
     * @return Admin
     */
    public function actingAsAdmin($driver = null)
    {
        $this->seed(LaratrustSeeder::class);

        $admin = Admin::factory()->create();

        $admin->addRole('super_admin');

        $this->be($admin, $driver);

        return $admin;
    }

    /**
     * Set the currently logged in admin for the application.
     *
     * @param null $driver
     * @return Customer
     */
    public function actingAsCustomer($driver = null): Customer
    {
        $this->seed(LaratrustSeeder::class);

        $customer = Customer::factory()->create();

        $this->be($customer, $driver);

        return $customer;
    }
}
