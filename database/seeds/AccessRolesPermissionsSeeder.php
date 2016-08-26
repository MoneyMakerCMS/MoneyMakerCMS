<?php

use Illuminate\Database\Seeder;

class AccessRolesPermissionsSeeder extends Seeder
{
    protected $abilities = ['view', 'create', 'update', 'delete'];

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
        foreach (config('core.entities') as $entity) {
            foreach (config('core.resource_nouns') as $resource_noun) {
                $title = str_plural(class_basename($entity));
                $ability_name = ucfirst($resource_noun);
                Bouncer::ability()->createForModel($entity, [
                    'name'  => $resource_noun,
                    'title' => "{$ability_name} {$title} ",
                ]);
            }
        }
    }

    protected function assignAbilitiesToRoles()
    {
        Bouncer::allow('super-admin')->to([
            'name'  => '*',
            'title' => 'God Mode',
        ], '*');

        foreach (Bouncer::ability()->get() as $ability) {
            Bouncer::allow('admin')->to($ability);
        }
    }
}
