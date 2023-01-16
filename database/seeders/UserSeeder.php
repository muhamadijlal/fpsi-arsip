<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $users = [
            [
                'nama' => 'root',
                'email' => 'root@root.com',
                'role' => 'root',
                'password' =>  Hash::make('12345'),
            ],
            [
                'nama' => 'dosen',
                'email' => 'dosen@dosen.com',
                'role' => 'dosen',
                'password' =>  Hash::make('12345'),
            ],
            [
                'nama' => 'tu',
                'email' => 'tu@tu.com',
                'role' => 'tu',
                'password' =>  Hash::make('12345'),
            ],
            [
                'nama' => 'Mahasiswa 1',
                'nim' => '18416255201201',
                'email' => 'user1@mhs.com',
                'role' => 'mahasiswa',
                'password' =>  Hash::make('12345'),
            ],
            [
                'nama' => 'Mahasiswa 2',
                'nim' => '18416255201202',
                'email' => 'user2@mhs.com',
                'role' => 'mahasiswa',
                'password' =>  Hash::make('12345'),
            ],
            [
                'nama' => 'kepala tu',
                'email' => 'ktu@ktu.com',
                'role' => 'kepala',
                'password' =>  Hash::make('12345'),
            ],
            [
                'nama' => 'dekan',
                'email' => 'dekan@dekan.com',
                'role' => 'kepala',
                'password' =>  Hash::make('12345'),
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
