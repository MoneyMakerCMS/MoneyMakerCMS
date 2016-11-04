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
        $this->call(AccessRolesPermissionsSeeder::class);
        $this->call(ContentSeeder::class);
        $this->call(PagesSeeder::class);
    }
}
