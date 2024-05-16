<?php

namespace Modules\Accounts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $root = \Modules\Accounts\Entities\Admin::firstOrCreate([
            'email' => 'root@demo.com',
        ], \Modules\Accounts\Entities\Admin::factory()->raw([
            'name'             => 'Ibrahim',
            'email'            => 'root@demo.com',
            'phone'            => '01156382044',
            'preferred_locale' => 'ar',
        ]));

        $root->addRole('super_admin');

        $root->setVerified();

        $admin = \Modules\Accounts\Entities\Admin::firstOrCreate([
            'email' => 'admin@demo.com',
        ], \Modules\Accounts\Entities\Admin::factory()->raw([
            'name'             => 'Ahmed',
            'email'            => 'admin@demo.com',
            'phone'            => '987654123',
            'preferred_locale' => 'en',
        ]));

        $admin->addRole('super_admin');

        $admin->setVerified();

        $customer = \Modules\Accounts\Entities\Customer::firstOrCreate([
            'email' => 'customer@demo.com',
        ], \Modules\Accounts\Entities\Customer::factory()->raw([
            'name'             => 'Customer',
            'email'            => 'customer@demo.com',
            'phone'            => '01552416535',
            'preferred_locale' => 'en',
        ]));

        $customer->setVerified();
    }
}
