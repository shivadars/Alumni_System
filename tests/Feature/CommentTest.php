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

    public function test_user_can_comment_via_ajax(): void
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

        $response = $this->actingAs($user)->postJson(route('posts.comments.store', $post), [
            'content' => 'AJAX comment',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['comment', 'message']);
        $this->assertDatabaseHas('comments', ['content' => 'AJAX comment']);
    }

    public function test_user_can_delete_own_comment(): void
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

        $comment = $post->comments()->create([
            'user_id' => $user->id,
            'content' => 'Original comment',
        ]);

        $response = $this->actingAs($user)->deleteJson(route('comments.destroy', $comment));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    public function test_user_cannot_delete_others_comment(): void
    {
        $user1 = \App\Models\User::factory()->create(['role' => 'alumni']);
        $user1->profile()->create(['department' => 'Computer Science']);
        $user2 = \App\Models\User::factory()->create(['role' => 'alumni']);
        $user2->profile()->create(['department' => 'Computer Engineering']);
        
        $post = \App\Models\Post::create([
            'user_id' => $user1->id,
            'title' => 'Test Post',
            'content' => 'Test Content',
            'category' => 'General',
            'department' => 'Computer Science',
        ]);

        $comment = $post->comments()->create([
            'user_id' => $user1->id,
            'content' => 'User 1 comment',
        ]);

        $response = $this->actingAs($user2)->deleteJson(route('comments.destroy', $comment));

        $response->assertStatus(403);
        $this->assertDatabaseHas('comments', ['id' => $comment->id]);
    }

    public function test_admin_can_delete_any_comment(): void
    {
        $user = \App\Models\User::factory()->create(['role' => 'alumni']);
        $user->profile()->create(['department' => 'Computer Science']);
        $admin = \App\Models\User::factory()->create(['role' => 'admin']);
        $admin->profile()->create(['department' => 'Administration']);
        
        $post = \App\Models\Post::create([
            'user_id' => $user->id,
            'title' => 'Test Post',
            'content' => 'Test Content',
            'category' => 'General',
            'department' => 'Computer Science',
        ]);

        $comment = $post->comments()->create([
            'user_id' => $user->id,
            'content' => 'User comment',
        ]);

        $response = $this->actingAs($admin)->deleteJson(route('comments.destroy', $comment));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }
}
