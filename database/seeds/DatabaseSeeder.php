<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $data = [
            [
                'id' => 1,
                'name' => 'Admin'
            ],
            [
                'id' => 2,
                'name' => 'Editor'
            ]
        ];

        foreach ($data as $item) {
            \DB::table('groups')->insert(
                [
                    'group_id' => $item['id'],
                    'group_name' => $item['name'],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]
            );
        }

        \DB::table('users')->insert([
            [
                'username' => 'superadmin',
                'password' => bcrypt('12345'),
                'email' => 'admin@app.com',
                'name' => 'Programmer Superadmin',
                'group_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
        \DB::table('users')->insert([
            [
                'username' => 'editor',
                'password' => bcrypt('123456'),
                'email' => 'editor@app.com',
                'name' => 'Editor App',
                'group_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);

        $dataModules = [
            [
                'module_name' => 'groups',
                'module_name_alias' => 'Kelompok',
                'module_db' => 'groups',
                'function' => 'index,create,edit,delete',
                'function_alias' => 'index,tambah,ubah,hapus',
                'description' => 'Group Desc'
            ],
            [
                'module_name' => 'news',
                'module_name_alias' => 'Artikel',
                'module_db' => 'news',
                'function' => 'index,create,edit,delete',
                'function_alias' => 'index,tambah,ubah,hapus',
                'description' => 'News Desc'
            ],
            [
                'module_name' => 'users',
                'module_name_alias' => 'Pengguna',
                'module_db' => 'users',
                'function' => 'index,create,edit,delete',
                'function_alias' => 'index,tambah,ubah,hapus',
                'description' => 'Users Desc'
            ],
            [
                'module_name' => 'modules',
                'module_name_alias' => 'Module',
                'module_db' => 'modules',
                'function' => 'index,create,edit,access,delete',
                'function_alias' => 'index,tambah,ubah,acl,hapus',
                'description' => 'Users Desc'
            ]
        ];

        foreach ($dataModules as $item) {
            \DB::table('modules')->insert(
                [
                    'module_name' => $item['module_name'],
                    'module_name_alias' => $item['module_name_alias'],
                    'module_db' => $item['module_db'],
                    'function' => $item['function'],
                    'function_alias' => $item['function_alias'],
                    'description' => $item['description'],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]
            );
        }
    }
}
