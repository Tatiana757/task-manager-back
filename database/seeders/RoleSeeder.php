<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $projectManager = Role::firstOrCreate(['name' => 'project_manager']);
        $developer = Role::firstOrCreate(['name' => 'developer']);

        $permissions = [
            'view-tasks',
            'create-tasks',
            'edit-tasks',
            'delete-tasks',
            'change-task-status',
            'assign-task-responsible',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        
        $admin->syncPermissions(Permission::all());
        
        $projectManager->syncPermissions([
            'view-tasks',
            'create-tasks',
            'edit-tasks',
            'delete-tasks',
            'change-task-status',
            'assign-task-responsible',
        ]);

        $developer->syncPermissions([
            'view-tasks',
            'edit-tasks',
            'change-task-status',
        ]);
    }
} 