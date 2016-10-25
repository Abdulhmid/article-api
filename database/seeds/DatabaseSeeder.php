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
    }
}
