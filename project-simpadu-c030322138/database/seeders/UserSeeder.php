<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(250)->create();

        User::create([
            'name' => 'Achmad Faqih Suyudi',
            'email' => 'c030322138@mahasiswa.poliban.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'roles' => 'mahasiswa',
        ]);
    }
}
