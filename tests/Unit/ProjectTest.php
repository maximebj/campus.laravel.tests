<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
  use RefreshDatabase;

  public function test_project_user_relation()
  {
    $user = User::factory()->create();
    $project = Project::factory()->for($user)->create();

    $this->assertInstanceOf(User::class, $project->user);
  } 
}