<?php

namespace Tests\Feature;

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

        $response->assertSee('<h1>Liste des projets</h1>', false);
    }
}
