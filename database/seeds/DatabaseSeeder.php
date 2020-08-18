<?php

use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
<<<<<<< HEAD
        $this->call(PriceBandsTableSeeder::class);
=======
        $this->call(CategoriesTableSeeder::class);

>>>>>>> 6e272e9202afcccdffc2527bc8bbcf57542c7326

        Model::reguard();
    }
}
