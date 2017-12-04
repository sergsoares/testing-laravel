<?php


function createPost(array $attributes = [])
{
    return factory(Post::class)->create($attributes);
}
