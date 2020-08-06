<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ],
            [
                'name'        => 'Participant',
                'slug'        => 'participant',
                'description' => 'Participant Role',
                'level'       => 1,
            ],
            [
                'name'        => 'QuizMaster',
                'slug'        => 'quizmaster',
                'description' => 'QuizMaster Role',
                'level'       => 3,
            ],
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $RoleItem['name'],
                    'slug'          => $RoleItem['slug'],
                    'description'   => $RoleItem['description'],
                    'level'         => $RoleItem['level'],
                ]);
            }
        }
    }
}
