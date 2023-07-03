<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Truncate users tables before seeding by dropping everything and resetting index to 0
         *
         * @return void
         */
        DB::table('users')->truncate();

        User::factory()->times(5)->create();
    }
}
