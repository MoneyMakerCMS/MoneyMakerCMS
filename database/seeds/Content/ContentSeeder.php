<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contents')->truncate();
        $this->createContent();
    }

    public function createContent()
    {
        DB::table('contents')->insert([
            'name'       => 'App Name',
            'slug'       => 'app-name',
            'type'       => 'database',
            'type'       => 'database',
            'html'       => 1,
            'value'      => '<b>MoneyMaker</b> CM<b>$</b>',
            'enabled'    => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        DB::table('contents')->insert([
            'name'       => 'App Alt',
            'slug'       => 'app-alt',
            'type'       => 'database',
            'type'       => 'database',
            'html'       => 1,
            'value'      => '<b>MM$</b>',
            'enabled'    => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        DB::table('contents')->insert([
            'name'       => 'App Copyright ',
            'slug'       => 'app-copyright',
            'type'       => 'database',
            'type'       => 'database',
            'html'       => 1,
            'value'      => '<strong>Copyright &copy; 2016 <a href="#"><b>MoneyMaker</b> CM<b>$</b></a>.</strong> All rights reserved.',
            'enabled'    => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
}
