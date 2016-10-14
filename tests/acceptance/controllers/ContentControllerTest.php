<?php

use App\Models\Content\Content;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContentControllerTest extends TestCase
{
    use CreateUsersWithRolesTrait, DatabaseTransactions, DatabaseMigrations;

    public function test_content_controller_redirects_unauthed_user()
    {
        $this->visit('admin/content')->seePageIs('login');
    }

    public function test_content_controller_allows_user_with_correct_permission()
    {
        $user = $this->createUserWith(['admin'], ['view-admin']);

        $user->allow('view', Content::class);

        $this->actingAs($user);

        $this->visit('admin/content');
    }

    public function test_authed_user_without_permission_can_not_view_content()
    {
        $user = $this->createUserWith(['admin'], ['foo-baz']);

        $this->actingAs($user);

        $response = $this->call('GET', 'admin/content');

        $this->assertEquals(403, $response->status());
    }

    public function test_authed_user_without_permission_can_not_create_content()
    {
        $user = $this->createUserWith(['admin'], ['foo-baz']);

        $this->actingAs($user);

        $response = $this->call('GET', 'admin/content/create');

        $this->assertEquals(403, $response->status());
    }

    public function test_content_controller_allows_user_with_correct_permission_to_create_content()
    {
        $user = $this->createUserWith(['admin'], ['view-admin']);

        $user->allow('create', Content::class);

        $this->actingAs($user);

        $this->visit('admin/content/create');
    }

    public function test_content_controller_allows_user_with_correct_permission_to_edit_content()
    {
        $user = $this->createUserWith(['admin'], ['view-admin']);

        $user->allow('edit', Content::class);
        $user->allow('update', Content::class);

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


        DB::table('contents')->insert($default);

        $content_id = DB::getPdo()->lastInsertId();

        $this->actingAs($user);
        $content = Content::find($content_id);
        $this->assertTrue(Bouncer::allows('edit', Content::class));
        $this->assertTrue(Bouncer::allows('edit', $content));
        $this->assertTrue(Bouncer::allows('update', $content));
    }
}
