<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Halbert Patton', 'email' => 'devris@scdhn.com', 'password' => '$2a$10$G/.FuoxfPPsXnHe.A0SFAOkLHfdYJeMF0RP6.vJ/1hCp3g/o7EfIS'], //password: 11111111
            ['name' => 'Kemp White', 'email' => 'jinx3r@sfdi.site', 'password' => '$2a$10$G/.FuoxfPPsXnHe.A0SFAOkLHfdYJeMF0RP6.vJ/1hCp3g/o7EfIS'],
            ['name' => 'Warwick Booth', 'email' => 'farttaxi@chantellegribbon.com', 'password' => '$2a$10$G/.FuoxfPPsXnHe.A0SFAOkLHfdYJeMF0RP6.vJ/1hCp3g/o7EfIS'],
            ['name' => 'Norman Waters', 'email' => 'davepeloso@emvil.com', 'password' => '$2a$10$G/.FuoxfPPsXnHe.A0SFAOkLHfdYJeMF0RP6.vJ/1hCp3g/o7EfIS'],
            ['name' => 'Kevin Reeves', 'email' => 'diannegrandon14@nbobd.com', 'password' => '$2a$10$G/.FuoxfPPsXnHe.A0SFAOkLHfdYJeMF0RP6.vJ/1hCp3g/o7EfIS'],
            ['name' => 'Victor Hunt', 'email' => 'knodelvladislav@sanvekhuyenmai.com', 'password' => '$2a$10$G/.FuoxfPPsXnHe.A0SFAOkLHfdYJeMF0RP6.vJ/1hCp3g/o7EfIS'],
        ];
        foreach ($users as $user) {
            User::updateOrCreate($user);
        }
    }
}
