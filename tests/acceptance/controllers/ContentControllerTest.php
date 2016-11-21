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
        $content = factory(Content::class)->create();

        $user = $this->createUserWith(['admin'], ['view-admin']);

        $user->allow('update', Content::class);

        $this->actingAs($user);
        
        $this->visit('admin/content/'. $content->id . '/edit');
        $content_id = $content->id;

        $params = $this->updateParams(['_token' => csrf_token(), 'enabled' => 0 ,'html' => 1, 'content_id' => $content_id]);

        $this->post('admin/content/'. $content_id . '/edit', $params);
        
        $updated_content = Content::find($content_id);

        $this->assertEquals(0, $updated_content->enabled);
        $this->assertEquals(1, $updated_content->html);
    }

    private function updateParams($overrides = [])
    {
        $defaults = [
            'name'       => 'App Name',
            'slug'       => 'app-name',
            'type'       => 'database',
            'html'       => 1,
            'value'      => '<b>MoneyMaker</b> CM<b>$</b>',
            'enabled'    => 1,
        ];

        return array_merge($defaults, $overrides);
    }
}
