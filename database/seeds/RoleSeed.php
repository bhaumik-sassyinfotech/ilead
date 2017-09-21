<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            [
                'title' => 'Administrator (can create other users)',
                'permissions' => '{"subdomain.manage":"true",
                                    "subdomain.view":"true",
                                    "badge.manage":"true",
                                    "badge.view":"true",
                                    "coins.manage":"true",
                                    "coins.view":"true",
                                    "transaction.manage":"true",
                                    "transaction.view":"true",
                                    "users.manage":"true",
                                    "users.view":"true",
                                    "gifts.manage":"true",
                                    "gifts.view":"true",
                                    "designs.manage":"true",
                                    "designs.view":"true",
                                    "template.manage":"true",
                                    "template.view":"true"}'
            ],
            [
                'title' => 'User',
                'permissions' => '{"subdomain.manage":"true",
                                    "subdomain.view":"true",
                                    "badge.manage":"true",
                                    "badge.view":"true",
                                    "coins.manage":"false",
                                    "coins.view":"false",
                                    "transaction.manage":"false",
                                    "transaction.view":"false",
                                    "users.manage":"true",
                                    "users.view":"false",
                                    "gifts.manage":"true",
                                    "gifts.view":"false",
                                    "designs.manage":"true",
                                    "designs.view":"true",
                                    "template.manage":"false",
                                    "template.view":"false"}'
            ],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}