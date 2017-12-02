<?php

namespace Tests\Unit;

use App\Team;
use App\User;
use Tests\TestCase;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_team_has_a_name()
    {
        //Arrange
        $team = Team::create(['name' => 'Xteam', 'size' => 6]);

        //Assert
        $this->assertEquals('Xteam', $team->name); 
    }

   /** @test */
   public function a_team_can_add_members()
   {
       //Arrange
       $team = factory(Team::class)->create();
       $user1 = factory(User::class)->create();
       $user2 = factory(User::class)->create();
       $user3 = factory(User::class)->create();

       //Act
       $team->addMember($user1);
       $team->addMember($user2);
       $team->addMember($user3);
   
       //Assert
       $this->assertEquals(3, $team->count());
       
   } 

}
