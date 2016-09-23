<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 if (! DB::table('pages')->where('name', 'Home Page')->first()) {
            $this->create_default_page();
        }
    }

    public function create_default_page()
    {
    	 //insert default table
        $page = DB::table('pages')->insert([
            'name' => 'Home Page',
            'uri' => '/',
            'route' => 'frontend.index',
            'type' => 'database',
            'middleware' => '["web"]',
            'layout' => 'frontend.layouts.master',
            'section' => 'content',
            'content' => '<h1>@content(\'app-name\')</h1>',
            'file' => '',
            'active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $page = DB::table('pages')->where('name', 'Home Page')->first();

        DB::table('seo')->insert([
            'entity_id' => $page->id,
            'entity_type' => 'App\\Models\\Pages\\Page',
            'title' => 'Default Homepage Title',
            'description' => 'Default Homepage Description',
            'keywords' => '',
            'robots' => 'noindex,nofollow',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
