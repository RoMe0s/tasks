<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{

    private $RD_p = [
        'task.take',
        'task.write',
        'task.close',
        'project.read'
    ];
    private $Accountant_p = [
        'task.take',
        'task.write',
        'task.close',
        'project.read'
    ];
    private $ProductOwner_p = [
        'task.take',
        'task.write',
        'task.close',
        'project.read',
        'project.users'
    ];
    private $Client_p = [
        'task.take',
        'task.write',
        'task.close',
        'project.read'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = config('permissions');

        $groups = ['RD', 'Accountant', 'ProductOwner', 'Client'];

        $Administrators = \Spatie\Permission\Models\Role::create(['name' => 'Administrators', 'image' => '/images/user/admin.png']);
        $RD = \Spatie\Permission\Models\Role::create(['name' => 'R&D', 'image' => '/images/user/r&d.png']);
        $Accountant = \Spatie\Permission\Models\Role::create(['name' => 'Accountant', 'image' => '/images/user/acc.png']);
        $ProductOwner = \Spatie\Permission\Models\Role::create(['name' => 'Product Owner', 'image' => '/images/user/po.png']);
        $Client = \Spatie\Permission\Models\Role::create(['name' => 'Client', 'image' => '/images/user/client.png']);

        foreach($permissions as $key => $functions) {

            foreach($functions as $function) {

                $name = $key . '.' . $function;

                \Spatie\Permission\Models\Permission::create(['name' => $name]);

                $Administrators->givePermissionTo($name);

            }

        }

        $RD->givePermissionTo($this->RD_p);

        $Accountant->givePermissionTo($this->Accountant_p);

        $ProductOwner->givePermissionTo($this->ProductOwner_p);

        $Client->givePermissionTo($this->Client_p);

        $user = \App\Models\User::where('email', 'admin@admin.com')->first();

        $user->assignRole('Administrators');
    }
}
