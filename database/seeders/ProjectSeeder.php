<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'name' => 'First Project',
                'users' => [
                    ['role' => 1],
                    ['role' => 2],
                    ['role' => 2],
                ]
            ]
        ];

        foreach ($projects as $project) {
            $pr = Project::create(['name' => $project['name']]);
            $counter = 0;
            foreach (User::limit(3)->get() as $user) {
                $pr->assignUser($user, Role::find($project['users'][$counter++]['role']));
            }
        }
    }
}
