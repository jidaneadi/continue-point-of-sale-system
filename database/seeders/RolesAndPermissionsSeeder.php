<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            ['name' => 'dashboard', 'guard_name' => 'web'],
            ['name' => 'transaction-create', 'guard_name' => 'web'],
            ['name' => 'transaction-read', 'guard_name' => 'web'],
            ['name' => 'transaction-update', 'guard_name' => 'web'],
            ['name' => 'transaction-delete', 'guard_name' => 'web'],
            ['name' => 'photo-session-create', 'guard_name' => 'web'],
            ['name' => 'photo-session-read', 'guard_name' => 'web'],
            ['name' => 'photo-session-update', 'guard_name' => 'web'],
            ['name' => 'photo-session-delete', 'guard_name' => 'web'],
            ['name' => 'product-category-create', 'guard_name' => 'web'],
            ['name' => 'product-category-read', 'guard_name' => 'web'],
            ['name' => 'product-category-update', 'guard_name' => 'web'],
            ['name' => 'product-category-delete', 'guard_name' => 'web'],
            ['name' => 'product-create', 'guard_name' => 'web'],
            ['name' => 'product-read', 'guard_name' => 'web'],
            ['name' => 'product-update', 'guard_name' => 'web'],
            ['name' => 'product-delete', 'guard_name' => 'web'],
            ['name' => 'product-discount-create', 'guard_name' => 'web'],
            ['name' => 'product-discount-read', 'guard_name' => 'web'],
            ['name' => 'product-discount-update', 'guard_name' => 'web'],
            ['name' => 'product-discount-delete', 'guard_name' => 'web'],
            ['name' => 'cashier-create', 'guard_name' => 'web'],
            ['name' => 'cashier-read', 'guard_name' => 'web'],
            ['name' => 'cashier-update', 'guard_name' => 'web'],
            ['name' => 'cashier-delete', 'guard_name' => 'web'],
            ['name' => 'photographer-create', 'guard_name' => 'web'],
            ['name' => 'photographer-read', 'guard_name' => 'web'],
            ['name' => 'photographer-update', 'guard_name' => 'web'],
            ['name' => 'photographer-delete', 'guard_name' => 'web'],
            ['name' => 'customer-create', 'guard_name' => 'web'],
            ['name' => 'customer-read', 'guard_name' => 'web'],
            ['name' => 'customer-update', 'guard_name' => 'web'],
            ['name' => 'customer-delete', 'guard_name' => 'web'],
            ['name' => 'role-create', 'guard_name' => 'web'],
            ['name' => 'role-read', 'guard_name' => 'web'],
            ['name' => 'role-update', 'guard_name' => 'web'],
            ['name' => 'role-delete', 'guard_name' => 'web'],
            ['name' => 'permission-read', 'guard_name' => 'web'],
            ['name' => 'list-product-create', 'guard_name' => 'web'],
            ['name' => 'list-product-read', 'guard_name' => 'web'],
            ['name' => 'list-product-update', 'guard_name' => 'web'],
            ['name' => 'list-product-delete', 'guard_name' => 'web'],
            ['name' =>  'transaction-history-show', 'guard_name' => 'web'],

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }

        $roles = [
            ['name' => 'owner', 'guard_name' => 'web'],
            ['name' => 'cashier', 'guard_name' => 'web'],
            ['name' => 'photographer', 'guard_name' => 'web'],
            ['name' => 'customer', 'guard_name' => 'web'],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate($roleData);
        }

        $owner = Role::where('name', 'owner')->first();
        if ($owner) {
            $ownerPermissions = [
                'dashboard',
                'transaction-create',
                'transaction-read',
                'transaction-update',
                'transaction-delete',
                'photo-session-create',
                'photo-session-read',
                'photo-session-update',
                'photo-session-delete',
                'product-category-create',
                'product-category-read',
                'product-category-update',
                'product-category-delete',
                'product-create',
                'product-read',
                'product-update',
                'product-delete',
                'product-discount-create',
                'product-discount-read',
                'product-discount-update',
                'product-discount-delete',
                'cashier-create',
                'cashier-read',
                'cashier-update',
                'cashier-delete',
                'photographer-create',
                'photographer-read',
                'photographer-update',
                'photographer-delete',
                'customer-create',
                'customer-read',
                'customer-update',
                'customer-delete',
                'role-create',
                'role-read',
                'role-update',
                'role-delete',
                'permission-read',
            ];

            $owner->syncPermissions(Permission::whereIn('name', $ownerPermissions)->get());
        }

        $cashier = Role::where('name', 'cashier')->first();
        if ($cashier) {
            $cashierPermissions = [
                'dashboard',
                // 'photographer-create',
                // 'photographer-read',
                // 'photographer-update',
                // 'photographer-delete',
                'customer-create',
                'customer-read',
                'customer-update',
                'customer-delete',
                // 'product-category-create',
                // 'product-category-read',
                // 'product-category-update',
                // 'product-category-delete',
                // 'product-create',
                // 'product-read',
                // 'product-update',
                // 'product-delete',
                'product-discount-create',
                'product-discount-read',
                'product-discount-update',
                'product-discount-delete',
                'transaction-create',
                'transaction-read',
                'transaction-update',
                'transaction-delete',
            ];
            $cashier->syncPermissions(Permission::whereIn('name', $cashierPermissions)->get());
        }

        $customer = Role::where('name', 'customer')->first();
        if ($customer) {
            $customerPermissions = [
                'dashboard',
                // 'transaction-create',
                // 'transaction-read',
                'list-product-create',
                'list-product-read',
                'list-product-update',
                'list-product-delete',
                'transaction-history-show',
            ];
            $customer->syncPermissions(Permission::whereIn('name', $customerPermissions)->get());
        }
    }
}
