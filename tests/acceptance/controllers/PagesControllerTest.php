<?php

use App\Models\Pages\Page;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PagesControllerTest extends TestCase
{
    use CreateUsersWithRolesTrait, CreatePageTrait, DatabaseTransactions, DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
     
        $this->app->instance('dynamic_routes_path', base_path('tests/tmp/routes.php'));
     
        if (! file_exists(app('dynamic_routes_path'))) {
            touch(app('dynamic_routes_path'));
        }
    }

    public function tearDown()
    {
        unlink(app('dynamic_routes_path'));
        
        parent::tearDown();
    }

    public function test_pages_controller_redirects_unauthed_user()
    {
        $this->visit('admin/pages')->seePageIs('login');
    }

    public function test_pages_controller_allows_user_with_correct_permission()
    {
        $user = $this->createUserWith(['admin'], ['view-admin']);

        $user->allow('view', Page::class);

        $this->actingAs($user);

        $this->visit('admin/pages');
    }

    public function test_authed_user_without_permission_can_not_view_pages()
    {
        $user = $this->createUserWith(['admin'], ['foo-baz']);

        $this->actingAs($user);

        $response = $this->call('GET', 'admin/pages');

        $this->assertEquals(403, $response->status());
    }

    public function test_pages_controller_allows_user_with_correct_permission_to_create_page()
    {
        $user = $this->createUserWith(['admin'], ['view-admin']);

        $user->allow('create', Page::class);

        $this->actingAs($user);
    }

    public function test_created_page_route_exists()
    {
        $page = $this->createPage();

        $this->seeInDatabase('pages', [
            'name'       => 'Home Page',
            'uri'        => 'test-page',
            'route'      => 'frontend.test-page',
            'type'       => 'database',
        ]);
    }

    public function test_page_middleware_functions()
    {
        $page = $this->createPage(['middleware' => ['web', 'auth']]);
    }
}
