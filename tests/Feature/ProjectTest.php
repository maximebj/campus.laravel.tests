<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_project_url()
    {
        $response = $this->get('/projects');

        $response->assertStatus(200);
    }

    public function test_project_main_heading()
    {
        $response = $this->get('/projects');

        $response->assertSee(e('Liste des projets'), false);
    }

    public function test_project_single_url()
    {
        $user = User::factory()->create();
        $project = Project::factory()->for($user)->create();

        $this->assertNotNull($project->id);

        $response = $this->get('/projects/'. $project->id); 
        $response->assertStatus(200);
    }

    public function test_project_single_main_heading()
    {
        $user = User::factory()->create();
        $project = Project::factory()->for($user)->create();

        $response = $this->get('/projects/'. $project->id);

        $response->assertSee(e($project->title), false);
    }

    public function test_project_single_author()
    {
        $user = User::factory()->create();
        $project = Project::factory()->for($user)->create();
            
        $response = $this->get('/projects/'. $project->id);

        $response->assertSee(e($project->user->name), false);
    }
}
