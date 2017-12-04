<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Post;

class LikeTest extends TestCase
{

    use RefreshDatabase;
    
    protected $post;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->post = createPost();
    }

    /** @test */
    public function a_user_can_like_a_post()
    {
        $post = factory(Post::class)->create();
        $post->like($this->user);

        $this->assertDatabaseHas('likes', [
            'user_id' => $this->user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertTrue($post->isLiked());
    }

    /** @test */
    public function a_use_can_dislike_a_post()
    {
       
        $post = factory(Post::class)->create();

        $post->like();
        $post->dislike();

        $this->assertDatabaseMissing('likes',[
            'user_id' => $this->user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertFalse($post->isliked());
    }

    /** @test */
    public function a_user_may_toggle_a_post_like_status()
    {

        $post = createPost();
        $post->toggle();
        $this->assertTrue($post->isLiked());

        $post->toggle();
        $this->assertFalse($post->isLiked());
    } 

    /** @test */
    public function a_post_know_how_many_likes_it_has()
    {
        $this->post->toggle();

        $this->assertEquals(1, $this->post->likesCount());
    }
}

