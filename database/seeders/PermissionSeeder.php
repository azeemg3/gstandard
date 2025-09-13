<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'application_setting_view',
            'bs_add',
            'bs_delete',
            'bs_edit',
            'bs_view',
            'city_add',
            'city_delete',
            'city_edit',
            'city_view',
            // Staff Salaries permissions
            'staff_salary_add',
            'staff_salary_delete',
            'staff_salary_edit',
            'staff_salary_view',
            // Expenses permissions
            'expense_add',
            'expense_delete',
            'expense_edit',
            'expense_view',
            'country_add',
            'country_delete',
            'country_edit',
            'country_view',
            'role_add',
            'role_assign_permission',
            'role_delete',
            'role_edit',
            'role_view',
            'service_add',
            'service_delete',
            'service_edit',
            'service_view',
            'source_query_add',
            'source_query_delete',
            'source_query_edit',
            'source_query_view',
            'user_add',
            'user_delete',
            'user_edit',
            'user_view',
            'branch_add',
            'branch_delete',
            'branch_edit',
            'branch_view',
            'company_add',
            'company_delete',
            'company_edit',
            'company_view',
            'transaction_fee_add',
            'transaction_fee_delete',
            'transaction_fee_edit',
            'transaction_fee_view',
            'transaction_add',
            'transaction_delete',
            'transaction_edit',
            'transaction_view',
            'profit_report',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Admin role
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        $adminRole->syncPermissions(Permission::all());

        // Assign role to Super Admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'), // change later
            ]
        );

        $user->assignRole($adminRole);
    }
}
