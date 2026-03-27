<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_alumni_can_access_create_post_page()
    {
        $alumni = User::factory()->create(['role' => 'alumni']);
        \App\Models\Profile::create(['user_id' => $alumni->id]);

        $response = $this->actingAs($alumni)->get(route('posts.create'));

        $response->assertStatus(200);
        $response->assertSee('Create Post');
    }

    public function test_student_cannot_access_create_post_page()
    {
        $student = User::factory()->create(['role' => 'student']);
        \App\Models\Profile::create(['user_id' => $student->id]);

        $response = $this->actingAs($student)->get(route('posts.create'));

        $response->assertStatus(403);
    }

    public function test_alumni_can_create_post()
    {
        $alumni = User::factory()->create(['role' => 'alumni']);
        \App\Models\Profile::create(['user_id' => $alumni->id]);

        $response = $this->actingAs($alumni)->post(route('posts.store'), [
            'title' => 'Test Post',
            'content' => 'Test Content',
            'category' => 'General',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'content' => 'Test Content',
            'category' => 'General',
            'user_id' => $alumni->id,
        ]);
    }

    public function test_dashboard_displays_posts_feed()
    {
        $alumni = User::factory()->create(['role' => 'alumni']);
        \App\Models\Profile::create(['user_id' => $alumni->id]);
        
        $post = Post::create([
            'user_id' => $alumni->id,
            'title' => 'Community Update',
            'content' => 'Hello everyone!',
            'category' => 'General',
        ]);

        $student = User::factory()->create(['role' => 'student']);
        \App\Models\Profile::create(['user_id' => $student->id]);

        $response = $this->actingAs($student)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Global Community');
        $response->assertSee('Community Update');
        $response->assertSee('Hello everyone!');
    }
}
