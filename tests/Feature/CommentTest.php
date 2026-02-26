<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_comment_on_post(): void
    {
        $user = \App\Models\User::factory()->create(['role' => 'alumni']);
        $user->profile()->create(['department' => 'Computer Science']);
        
        $post = \App\Models\Post::create([
            'user_id' => $user->id,
            'title' => 'Test Post',
            'content' => 'Test Content',
            'category' => 'General',
            'department' => 'Computer Science',
        ]);

        $response = $this->actingAs($user)->post(route('posts.comments.store', $post), [
            'content' => 'This is a test comment',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'content' => 'This is a test comment',
        ]);
    }

    public function test_empty_comment_is_rejected(): void
    {
        $user = \App\Models\User::factory()->create(['role' => 'alumni']);
        $user->profile()->create(['department' => 'Computer Science']);
        
        $post = \App\Models\Post::create([
            'user_id' => $user->id,
            'title' => 'Test Post',
            'content' => 'Test Content',
            'category' => 'General',
            'department' => 'Computer Science',
        ]);

        $response = $this->actingAs($user)->post(route('posts.comments.store', $post), [
            'content' => '',
        ]);

        $response->assertSessionHasErrors('content');
        $this->assertEquals(0, \App\Models\Comment::count());
    }
}
