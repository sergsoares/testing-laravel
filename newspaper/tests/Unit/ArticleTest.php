<?php

namespace Tests\Unit;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Article;

class ArticleTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function it_fetches_trending_articles()
    {
        //Given - Arrange
        factory(\App\Article::class, 2)->create();
        factory(\App\Article::class)->create(['reads' => 10]);
        $mostPopular = factory(\App\Article::class)->create(['reads' => 20]);

        //When - Act
        $articles = Article::trending();

        //Then - Assert
        $this->assertEquals($mostPopular->id, $articles->first()->id);
        $this->assertCount(3, $articles);

    }
}
