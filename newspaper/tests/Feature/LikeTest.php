<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Post;

class LikeTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_user_can_like_a_post()
    {
        //Arrange

        // Given i have a post

        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $post->like($user);

    
        //Assert
        // then we should see evidence in the database, and the post
        // should be liked.
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertTrue($post->isLiked());
        
    }

    /** @test */
    public function a_use_can_dislike_a_post()
    {
       
        //Given the situation than
        // have a post
        // a User
        // that is logged
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $this->actingAs($user);

        // When him like a post and after
        //dislike the post
        $post->like();
        $post->dislike();

        // Then doesnt exists likes by that user
        $this->assertDatabaseMissing('likes',[
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertFalse($post->isliked());
    }

    /** @test */
    public function a_user_may_toggle_a_post_like_status()
    {
        //Given an post
        // And a user
        // and this user is logged
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $this->actingAs($user);


        //Act
        //When him toogle a post it is liked
        //And if him toogle again it is unliked
        //Each togle make the posted like and Disliked

        $post->toggle();
        $this->assertTrue($post->isLiked());
        $post->toggle();
        $this->assertFalse($post->isLiked());
    } 

    /** @test */
    public function a_post_know_how_many_likes_it_has()
    {
        //Arrange
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $this->actingAs($user);
   
        //Act
        $post->toggle();
    
        //Assert
        $this->assertEquals(1, $post->likesCount());
        
    }
}

