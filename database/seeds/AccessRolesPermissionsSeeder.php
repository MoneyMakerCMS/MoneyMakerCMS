<?php

use Illuminate\Database\Seeder;

class AccessRolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->createRoles();
        $this->seedAbilities();
        $this->assignAbilitiesToRoles();

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }

    protected function createRoles()
    {
        Bouncer::role()->truncate();

        foreach (config('core.roles') as $role) {
            Bouncer::role()->create([
                'name'  => str_slug($role),
                'title' => ucfirst($role),
            ]);
        }
    }

    public function seedAbilities()
    {
        Bouncer::ability()->truncate();

        //create view admin ability
        Bouncer::ability()->create([
            'name'  => 'view-admin',
            'title' => 'View Admin',
        ]);

        Bouncer::ability()->create([
            'name'  => 'view-dashboard',
            'title' => 'View Dashboard',
        ]);

        foreach (config('core.entities') as $entity) {
            foreach (config('core.resource_nouns') as $resource_noun) {
                $title = str_plural(collect(explode('\\', $entity))->last());

                $ability_name = ucfirst($resource_noun);

                Bouncer::ability()->create([
                    'name'        => $resource_noun,
                    'title'       => "{$ability_name} {$title}",
                    'entity_type' => $entity,
                ]);
            }
        }
    }

    protected function assignAbilitiesToRoles()
    {
        foreach (Bouncer::ability()->get() as $ability) {
            Bouncer::allow('admin')->to($ability);
        }

        Bouncer::allow('user')->to('view-dashboard');
        $godMode =  Bouncer::ability()->create([
            'name'  => '*',
            'title' => 'God Mode',
            'entity_type' => '*',
        ]);

        Bouncer::allow('super-admin')->to($godMode);
    }
}
