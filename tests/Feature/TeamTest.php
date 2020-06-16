<?php

namespace Tests\Feature;

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function team_has_name()
    {
        $team = new Team(['name' => 'wildan']);

        $this->assertEquals('wildan', $team->name);
    }
    /** @test */
    public function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2, $team->count());
    }
    /** @test */
    // public function a_team_has_maximum_size()
    // {
    //     $team = factory(Team::class)->create(['size' => 2]);
    //     $user = factory(User::class)->create();
    //     $user2 = factory(User::class)->create();

    //     $team->add($user);
    //     $team->add($user2);

    //     $this->assertEquals(2, $team->count());

    //     $this->setExpectedExceptionFromAnnotation();

    //     $user3 = factory(User::class)->create();

    //     $team->add($user3);
    // }
    /** @test */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());
    }
    /** @test */
    public function a_team_can_remove_members()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $users = factory(User::class, 2)->create();

        $team->add($users);
        $team->remove($users[0]);

        $this->assertEquals(1, $team->count());
    }
    /** @test */
    public function a_team_can_remove_more_thane_one_members_at_once()
    {
        $team = factory(Team::class)->create(['size' => 3]);

        $users = factory(User::class, 3)->create();

        $team->add($users);
        $team->remove($users->slice(0, 2));

        $this->assertEquals(1, $team->count());
    }
    /** @test */
    public function a_team_can_remove_multiple_members_at_once()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $users = factory(User::class, 2)->create();

        $team->add($users);
        $team->restart();

        $this->assertEquals(0, $team->count());
    }
}
