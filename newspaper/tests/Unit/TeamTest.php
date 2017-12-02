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

   /** @test */
   public function it_has_maximum_size()
   {
       //Arrange
       $team = factory(Team::class)->create(['size' => 2]);
   
       $userOne = factory(User::class)->create(); 
       $userTwo = factory(User::class)->create(); 

       $team->addMember($userOne);
       $team->addMember($userTwo);
       
       $this->expectException(\Exception::class);
       
       //Act
       $userThree = factory(User::class)->create();
       $team->addMember($userThree);
       
       //Assert
    //    $this->assertEquals(2, $team->count());
       
       
   }

   /** @test */
   public function it_can_remove_a_member()
   {
       //Arrange
       $team = factory(Team::class)->create();

       $user1 = factory(user::class)->create();
       $user2 = factory(user::class)->create();

       $team->addmember($user1);
       $team->addmember($user2);

       //Act
       $team->discharge($user2);
   
       //Assert
       $this->assertEquals(1, $team->count());
   }

   /** @test */
   public function it_can_remove_all_members_at_once()
   {
       //Arrange
       $team = factory(Team::class)->create();
       
       $user1 = factory(user::class)->create();
       $user2 = factory(user::class)->create();

       $team->addmember($user1);
       $team->addmember($user2);
   
       //Act
       $team->dismissAllMembers();
   
       //Assert
       $this->assertEquals(0, $team->count());
    //    $this->assertEquals($user1, \App\User::find($user1->id));
   }

}

