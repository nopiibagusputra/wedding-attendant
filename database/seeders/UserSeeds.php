<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        //buat user admin
        User::truncate();
        User::create([
            'name'  => 'admin',
            'level' => 'admin',
            'active'=> '1',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(60),
            'verificationcode' => Str::random(20),
        ]);

         //buat user sekolah
         User::create([
             'name'  => 'sekolah',
             'level' => 'sekolah',
             'active'=> '1',
             'email' => 'sekolah@sekolah.com',
             'email_verified_at' => now(),
             'password' => bcrypt('sekolah'),
             'remember_token' => Str::random(60),
             'verificationcode' => Str::random(20),
         ]);
        Schema::enableForeignKeyConstraints();
    }
}
