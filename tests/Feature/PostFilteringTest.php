<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostFilteringTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_only_see_posts_from_their_own_department()
    {
        // Create CS Department User and a post
        $csDeptUser = User::factory()->create(['role' => 'department']);
        $csDeptUser->profile()->create(['department' => 'Computer Science']);
        
        $this->actingAs($csDeptUser)->post(route('posts.store'), [
            'title' => 'CS Announcement',
            'content' => 'Hello CS students',
            'category' => 'News'
        ]);

        // Create EC Alumni and a post
        $ecAlumni = User::factory()->create(['role' => 'alumni']);
        $ecAlumni->profile()->create(['department' => 'Electronics']);
        
        $this->actingAs($ecAlumni)->post(route('posts.store'), [
            'title' => 'EC Meetup',
            'content' => 'Electronics engineers Assemble',
            'category' => 'Event'
        ]);

        // Verify CS Student only sees CS post
        $csStudent = User::factory()->create(['role' => 'student']);
        $csStudent->profile()->create(['department' => 'Computer Science']);
        
        $response = $this->actingAs($csStudent)->get(route('dashboard'));
        $response->assertSee('CS Announcement');
        $response->assertDontSee('EC Meetup');

        // Verify EC Alumni only sees EC post
        $response = $this->actingAs($ecAlumni)->get(route('dashboard'));
        $response->assertSee('EC Meetup');
        $response->assertDontSee('CS Announcement');
    }

    public function test_department_users_can_create_posts()
    {
        $deptUser = User::factory()->create(['role' => 'department']);
        $deptUser->profile()->create(['department' => 'Mechanical']);

        $response = $this->actingAs($deptUser)->get(route('posts.create'));
        $response->assertStatus(200);

        $response = $this->actingAs($deptUser)->post(route('posts.store'), [
            'title' => 'Mech Post',
            'content' => 'Mechanical engineering rocks',
            'category' => 'General'
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Mech Post',
            'department' => 'Mechanical'
        ]);
    }

    public function test_department_filtering_is_case_insensitive()
    {
        // Only run this test if using a DB that supports ILIKE or if we want to ensure basic behavior
        // In local/test (SQLite), ILIKE behaves like LIKE (case-insensitive)
        
        $deptUser = User::factory()->create(['role' => 'department']);
        $deptUser->profile()->create(['department' => 'computer science']); // lowercase
        
        $this->actingAs($deptUser)->post(route('posts.store'), [
            'title' => 'Lowcase Post',
            'content' => 'content',
            'category' => 'News'
        ]);

        $alumni = User::factory()->create(['role' => 'alumni']);
        $alumni->profile()->create(['department' => 'Computer Science']); // Capitalized
        
        $response = $this->actingAs($alumni)->get(route('dashboard'));
        $response->assertSee('Lowcase Post');
    }

    public function test_admin_posts_are_visible_to_all_departments()
    {
        // Create an Admin and a post
        $admin = User::factory()->create(['role' => 'admin']);
        
        $post = Post::create([
            'user_id' => $admin->id,
            'title' => 'Global Admin Post',
            'content' => 'This is a message for everyone',
            'category' => 'Announcement',
            'department' => null // Admin posts might not have a department
        ]);

        // Verify CS Student can see it
        $csStudent = User::factory()->create(['role' => 'student']);
        $csStudent->profile()->create(['department' => 'Computer Science']);
        
        $response = $this->actingAs($csStudent)->get(route('dashboard'));
        $response->assertSee('Global Admin Post');

        // Verify EC Alumni can see it
        $ecAlumni = User::factory()->create(['role' => 'alumni']);
        $ecAlumni->profile()->create(['department' => 'Electronics']);
        
        $response = $this->actingAs($ecAlumni)->get(route('dashboard'));
        $response->assertSee('Global Admin Post');
    }
}
