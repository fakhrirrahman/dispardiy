<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat role jika belum ada
        $roleNames = [
            Role::ROLE['ADMIN'],
            Role::ROLE['USER'],
        ];
        $this->seedRoles($roleNames);

        // 2. Seed permission hanya untuk tabel wisata_alam
        $this->seedPermissions('wisata_alam');

        // 3. Ambil role dari database
        $admin = Role::where('name', Role::ROLE['ADMIN'])->first();
        $user = Role::where('name', Role::ROLE['USER'])->first();

        // 4. Assign full permission ke admin
        $this->assignPermissionsToRole($admin, [
            'viewAny' => ['wisata_alam'],
            'view' => ['wisata_alam'],
            'create' => ['wisata_alam'],
            'update' => ['wisata_alam'],
            'delete' => ['wisata_alam'],
            'restore' => ['wisata_alam'],
            'forceDelete' => ['wisata_alam'],
        ]);

        // 5. Assign permission terbatas ke user
        $this->assignPermissionsToRole($user, [
            'viewAny' => ['wisata_alam'],
            'view' => ['wisata_alam'],
        ]);
    }

    public function seedPermissions(string $tableName): void
    {
        $permissions = [
            'viewAny',
            'view',
            'create',
            'update',
            'delete',
            'restore',
            'forceDelete',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'name' => $permission . '.' . $tableName,
            ]);
        }
    }

    public function seedRoles(array $roleNames): void
    {
        foreach ($roleNames as $roleName) {
            Role::updateOrCreate([
                'name' => $roleName,
            ]);
        }
    }

    public function assignPermissionsToRole(Role $role, array $permissions): void
    {
        foreach ($permissions as $permission => $tables) {
            $rolePermissions = Permission::whereIn(
                'name',
                array_map(fn($table) => $permission . '.' . $table, $tables)
            )->get();

            $role->permissions()->syncWithoutDetaching($rolePermissions);
        }
    }
}
