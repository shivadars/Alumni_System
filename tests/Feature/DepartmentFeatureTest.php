<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Ensure default profile is created for users if needed by middleware
        // (Assuming project structure requires it based on 'profile.complete' middleware)
    }

    public function test_department_user_can_access_departments_list()
    {
        $user = User::factory()->create(['role' => 'department']);
        $user->profile()->create(['department' => 'Admin']);

        $response = $this->actingAs($user)->get(route('department.index'));

        $response->assertStatus(200);
        $response->assertSee('Departments');
    }

    public function test_department_user_can_see_unique_departments_from_alumni()
    {
        $deptUser = User::factory()->create(['role' => 'department']);
        $deptUser->profile()->create(['department' => 'IT']);

        $alumni1 = User::factory()->create(['role' => 'alumni']);
        $alumni1->profile()->create(['department' => 'Computer Science']);

        $alumni2 = User::factory()->create(['role' => 'alumni']);
        $alumni2->profile()->create(['department' => 'Electronics']);

        $response = $this->actingAs($deptUser)->get(route('department.index'));

        $response->assertStatus(200);
        $response->assertSee('Computer Science');
        $response->assertSee('Electronics');
    }

    public function test_department_user_can_view_alumni_in_department()
    {
        $deptUser = User::factory()->create(['role' => 'department']);
        $deptUser->profile()->create(['department' => 'IT']);

        $alumni = User::factory()->create(['role' => 'alumni', 'name' => 'Rahul']);
        $alumni->profile()->create(['department' => 'Computer Science']);

        $student = User::factory()->create(['role' => 'student', 'name' => 'John']);
        $student->profile()->create(['department' => 'Computer Science']);

        $response = $this->actingAs($deptUser)->get(route('department.show', 'Computer Science'));

        $response->assertStatus(200);
        $response->assertSee('Rahul');
        $response->assertDontSee('John');
    }

    public function test_student_cannot_access_department_routes()
    {
        $student = User::factory()->create(['role' => 'student']);
        $student->profile()->create(['department' => 'Computer Science']);

        $response = $this->actingAs($student)->get(route('department.index'));

        $response->assertRedirect(route('dashboard'));
    }

    public function test_alumni_cannot_access_department_routes()
    {
        $alumni = User::factory()->create(['role' => 'alumni']);
        $alumni->profile()->create(['department' => 'Computer Science']);

        $response = $this->actingAs($alumni)->get(route('department.index'));

        $response->assertRedirect(route('dashboard'));
    }

    public function test_department_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'IT Dept',
            'email' => 'itdept@example.com',
            'role' => 'department',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('users', [
            'email' => 'itdept@example.com',
            'role' => 'department',
            'status' => 'approved',
        ]);
    }
}
