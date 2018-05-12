<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Core\Models\User;
use App\Modules\Core\Models\Group;
use Illuminate\Support\Facades\DB;
use App\Modules\Core\Models\Privilege;

class CoreDatabaseSeeder extends Seeder
{
    private $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /**
         * Seeder
         */
        $this->seedUser();
        $this->seedDept();
        $this->seedEmployee();
        $this->seedGroup();
        $this->seedPosition();
        $this->seedPrivilege();

        /**
         * Assign group to user
         */
        $this->addSystemToSystemGroup();
        $this->addSuperAdminToSuperAdminGroup();
        $this->addAdminToAdminGroup();
        $this->addPetugasToPetugasGroup();

        /**
         * Assign privilege to group
         */
        // $this->addAllPrivilegeToSuperAdminGroup();
        $this->addPrivilegesToAdmin();
        $this->addPrivilegesToPetugas();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function seedUser()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            [
                'username' => 'system',
                'email' => 'system@ajaro.id',
                'password' => bcrypt('systemsystem'),
                'status' => User::STATUS_ACTIVE
            ],
            [
                'username' => 'superadmin',
                'email' => 'superadmin@ajaro.id',
                'password' => bcrypt('superadminsuperadmin'),
                'status' => User::STATUS_ACTIVE
            ],
            [
                'username' => 'admin',
                'email' => 'admin@ajaro.id',
                'password' => bcrypt('adminadmin'),
                'status' => User::STATUS_ACTIVE
            ],
            [
                'username' => 'petugas',
                'email' => 'petugas@ajaro.id',
                'password' => bcrypt('petugaspetugas'),
                'status' => User::STATUS_ACTIVE
            ]
        ]);

        foreach (range(1, 50) as $index) {
            DB::table('users')->insert([
                'username' => $this->faker->userName,
                'email' => $this->faker->email,
                'password' => bcrypt('secret'),
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }

    private function seedDept()
    {
        DB::table('depts')->truncate();

        foreach (range(1, 50) as $index) {
            $code = $this->faker->unique()->randomNumber(5);

            DB::table('depts')->insert([
                'code' => $code,
                'name' => 'dept-'.$code,
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }

    private function seedEmployee()
    {
        DB::table('employees')->truncate();

        foreach (range(1, 100) as $index) {
            $code = $this->faker->unique()->randomNumber(5);

            DB::table('employees')->insert([
                'code' => $code,
                'name' => $this->faker->name,
                'address' => $this->faker->address,
                'city' => $this->faker->city,
                'birth_date' => $this->faker->date('Y-m-d', 'now'),
                'birth_city' => $this->faker->city,
                'gender' => 'L',
                'marital_status_id' => 1,
                'village_id' => 3402122002,
                'job_status' => 1,
                'phone_number' => $this->faker->phoneNumber,
                'email' => $this->faker->email,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }

    private function seedGroup()
    {
        DB::table('groups')->truncate();

        DB::table('groups')->insert([
            [
                'name' => 'system',
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'name' => 'superadmin',
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'name' => 'admin',
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'name' => 'petugas',
                'created_by' => 1,
                'updated_by' => 1
            ]
        ]);
    }

    private function seedPosition()
    {
        DB::table('positions')->truncate();

        foreach (range(1, 50) as $index) {
            $code = $this->faker->unique()->randomNumber(5);

            DB::table('positions')->insert([
                'code' => $code,
                'name' => $this->faker->jobTitle(),
                'dept_id' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }

    /**
     * @author Yuana
     * note : Urutan memengaruhi
     */
    private function seedPrivilege()
    {
        DB::table('privileges')->truncate();

        DB::table('privileges')->insert([

            Privilege::generatePrivilege('user-index', 'User Get All', 'User'),
            Privilege::generatePrivilege('user-show', 'User Get One', 'User'),
            Privilege::generatePrivilege('user-store', 'User Create', 'User'),
            Privilege::generatePrivilege('user-update', 'User Update', 'User'),
            Privilege::generatePrivilege('user-destroy', 'User Destroy', 'User'),
            Privilege::generatePrivilege('user-assign-group', 'User Assign Group', 'User'),
            Privilege::generatePrivilege('user-revoke-group', 'User Revoke Group', 'User'),
            Privilege::generatePrivilege('user-password-reset', 'User Password Reset', 'User'),

            Privilege::generatePrivilege('dept-index', 'Dept Get All', 'Department'),
            Privilege::generatePrivilege('dept-show', 'Dept Get One', 'Department'),
            Privilege::generatePrivilege('dept-store', 'Dept Create', 'Department'),
            Privilege::generatePrivilege('dept-update', 'Dept Update', 'Department'),
            Privilege::generatePrivilege('dept-destroy', 'Dept Destroy', 'Department'),

            Privilege::generatePrivilege('employee-index', 'Employee Get All', 'Employee'),
            Privilege::generatePrivilege('employee-show', 'Employee Get One', 'Employee'),
            Privilege::generatePrivilege('employee-store', 'Employee Create', 'Employee'),
            Privilege::generatePrivilege('employee-update', 'Employee Update', 'Employee'),
            Privilege::generatePrivilege('employee-destroy', 'Employee Destroy', 'Employee'),
            Privilege::generatePrivilege('employee-upload-photo', 'Employee Upload Photo', 'Employee'),

            Privilege::generatePrivilege('group-index', 'Group Get All', 'Group'),
            Privilege::generatePrivilege('group-show', 'Group Get One', 'Group'),
            Privilege::generatePrivilege('group-store', 'Group Create', 'Group'),
            Privilege::generatePrivilege('group-update', 'Group Update', 'Group'),
            Privilege::generatePrivilege('group-update-users', 'Group Update Users', 'Group'),
            Privilege::generatePrivilege('group-destroy', 'Group Destroy', 'Group'),
            Privilege::generatePrivilege('group-add-privilege', 'Group Add Privilege', 'Group'),
            Privilege::generatePrivilege('group-remove-privilege', 'Group Remove Privilege', 'Group'),
            Privilege::generatePrivilege('group-update-privileges', 'Group Update Privileges (array)', 'Group'),

            Privilege::generatePrivilege('position-index', 'Position Get All', 'Position'),
            Privilege::generatePrivilege('position-show', 'Position Get One', 'Position'),
            Privilege::generatePrivilege('position-store', 'Position Create', 'Position'),
            Privilege::generatePrivilege('position-update', 'Position Update', 'Position'),
            Privilege::generatePrivilege('position-destroy', 'Position Destroy', 'Position'),

            Privilege::generatePrivilege('privilege-index', 'Privilege Get All', 'Privilege'),
            Privilege::generatePrivilege('privilege-show', 'Privilege Get One', 'Privilege'),
            Privilege::generatePrivilege('privilege-store', 'Privilege Create', 'Privilege'),
            Privilege::generatePrivilege('privilege-update', 'Privilege Update', 'Privilege'),
            Privilege::generatePrivilege('privilege-destroy', 'Privilege Destroy', 'Privilege'),
        ]);
    }

    private function addSystemToSystemGroup()
    {
        $user = User::where('email', 'system@ajaro.id')->first();
        $user->assignGroup('system');
    }

    private function addSuperAdminToSuperAdminGroup()
    {
        $user = User::where('email', 'superadmin@ajaro.id')->first();
        $user->assignGroup('superadmin');
    }

    private function addAdminToAdminGroup()
    {
        $user = User::where('email', 'admin@ajaro.id')->first();
        $user->assignGroup('admin');
    }

    private function addPetugasToPetugasGroup()
    {
        $user = User::where('email', 'petugas@ajaro.id')->first();
        $user->assignGroup('petugas');
    }

    private function addPrivilegesToAdmin()
    {
        $privileges = [
            120, 118, 116,
            114, 113, 112, 111, 110, 109,
            103, 102, 101, 100, 99,
            98, 97, 96, 95, 94,
            93, 92, 91, 90, 89,
            85, 84,
            80, 79,
            75, 74,
            70, 69,
            65, 64,
            63, 62, 61, 60, 59,
            54, 55,
            49, 50,
            44, 45,
            39, 40,
            29,
            24,
            21,
            19, 18, 17, 16, 15, 14,
            8, 5, 4, 3, 2, 1
        ];

        $privileges = collect($privileges)
                    ->map(function ($privId) {
                        return [
                            'privileges_id' => $privId,
                            'groups_id' => 3
                        ]; //admin => group_id = 3
                    });

        DB::table('privileges_groups')->insert($privileges->toArray());
    }

    private function addPrivilegesToPetugas()
    {
        $privileges = [
            120, 118, 116,
            114, 113, 112, 111, 110, 109,
            103, 102, 101, 100, 99,
            98, 97, 96, 95, 94,
            93, 92, 91, 90, 89,
            85, 84,
            80, 79,
            75, 74,
            70, 69,
            65, 64,
            63, 62, 61, 60, 59,
            54, 55,
            49, 50,
            44, 45,
            39, 40,
            29,
            21,
            19, 17, 15,
            8, 4, 2,
        ];

        $privileges = collect($privileges)
                    ->map(function ($privId) {
                        return [
                            'privileges_id' => $privId,
                            'groups_id' => 4
                        ]; //petugas => group_id = 4
                    });

        DB::table('privileges_groups')->insert($privileges->toArray());
    }
}
