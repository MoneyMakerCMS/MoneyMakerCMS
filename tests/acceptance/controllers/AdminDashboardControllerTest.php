<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminDashboardControllerTest extends TestCase
{
    use CreateUsersWithRolesTrait, DatabaseTransactions, DatabaseMigrations;
    
    public function test_dashboard_controller_redirects_unauthed_user()
    {
        $this->visit('admin')->seePageIs('login');
    }

    public function test_dashboard_controller_has_authed_user()
    {
        $user = $this->createUserWith(['admin'], ['view-admin']);

        $this->actingAs($user);

        $this->visit('admin')->seePageIs('admin')->assertViewHas('user');
    }

    public function test_authed_user_without_permission_can_not_view_dashboard()
    {
        $user = $this->createUserWith(['admin'], ['foo-baz']);

        $response = $this->call('GET', 'admin');

        $this->assertEquals(302, $response->status());
    }
    
}