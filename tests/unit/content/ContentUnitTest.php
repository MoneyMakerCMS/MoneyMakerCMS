<?php

use App\Models\Content\Content as ContentModel;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ContentUnitTest extends TestCase
{
    use CreateUsersWithRolesTrait, WithoutMiddleware, DatabaseTransactions, DatabaseMigrations;

    private $contentRepo;

    public function test_content_returns_slug_for_not_found_items()
    {
        $string = Content::render('app-name');

        $this->assertEquals('app-name', $string);
    }

    public function test_content_returns_slug_for_disabled_items()
    {
        $content = $this->createContent(['html' => 0, 'enabled' => 0]);

        $string = Content::render('app-name');

        $this->assertEquals('app-name', $string);
    }

    public function test_content_can_return_plain_text_string()
    {
        $content = $this->createContent(['html' => 0]);

        $string = Content::render('app-name');

        $this->assertEquals('MoneyMaker CM$', $string);
    }

    public function test_content_can_return_markup_string()
    {
        $content = $this->createContent(['html' => 1, 'enabled' => 1]);

        $string = Content::render('app-name');

        $this->assertEquals('<b>MoneyMaker</b> CM<b>$</b>', $string);
    }

    public function test_can_create_content()
    {
        $this->setUserActions();

        $response = $this->call('POST', '/admin/content/create', [
            'name'       => 'App Name',
            'slug'       => 'app-name',
            'type'       => 'database',
            'html'       => 1,
            'value'      => '<b>MoneyMaker</b> CM<b>$</b>',
            'enabled'    => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        $this->seeInDatabase('contents', [
            'name'    => 'App Name',
            'slug'    => 'app-name',
            'type'    => 'database',
            'html'    => 1,
            'value'   => '<b>MoneyMaker</b> CM<b>$</b>',
            'enabled' => 1,
        ]);

        $this->assertRedirectedToRoute('admin.content.edit', [1]);
    }

    public function test_can_edit_content()
    {
        $this->setUserActions();

        $this->call('POST', '/admin/content/create', [
            'name'       => 'App Name',
            'slug'       => 'app-name',
            'type'       => 'database',
            'html'       => 1,
            'value'      => '<b>MoneyMaker</b> CM<b>$</b>',
            'enabled'    => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        $response = $this->call('POST', '/admin/content/1/edit', [
            'content_id' => 1,
            'name'       => 'New App Name',
            'slug'       => 'new-app-name',
            'type'       => 'database',
            'html'       => 1,
            'value'      => '<b>MoneyMaker</b> CM<b>$</b>',
            'enabled'    => 1,
        ]);

        $this->seeInDatabase('contents', [
            'name' => 'New App Name',
            'slug' => 'new-app-name',
        ]);

        $this->assertRedirectedToRoute('admin.content.edit', [1]);
    }

    public function test_content_must_have_unique_name_slug()
    {
        $this->setUserActions();

        $this->call('POST', '/admin/content/create', [
            'name'       => 'App Name',
            'slug'       => 'app-name',
            'type'       => 'database',
            'html'       => 1,
            'value'      => '<b>MoneyMaker</b> CM<b>$</b>',
            'enabled'    => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        $response = $this->call('POST', '/admin/content/create', [
            'name'       => 'App Name',
            'slug'       => 'app-name',
            'type'       => 'database',
            'html'       => 1,
            'value'      => '<b>MoneyMaker</b> CM<b>$</b>',
            'enabled'    => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        $this->assertSessionHasErrors(['slug']);
    }

    public function test_content_requires_all_fields()
    {
        $this->setUserActions();

        $this->call('POST', '/admin/content/create', [
            'name'       => '',
            'slug'       => '',
            'type'       => 'database',
            'html'       => 0,
            'value'      => '',
            'enabled'    => 0,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        $this->assertSessionHasErrors(['name', 'slug', 'value']);
    }

    protected function setUserActions()
    {
        $user = $this->createUserWith(['admin'], ['view-admin']);
        $user->allow('create', ContentModel::class);
        $user->allow('edit', ContentModel::class);
        $user->allow('view', ContentModel::class);
        $this->actingAs($user);
    }

    protected function createContent($override = [])
    {
        $default = [
            'name'       => 'App Name',
            'slug'       => 'app-name',
            'type'       => 'database',
            'html'       => 1,
            'value'      => '<b>MoneyMaker</b> CM<b>$</b>',
            'enabled'    => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ];

        $data = array_merge($default, $override);

        return DB::table('contents')->insert($data);
    }
}
