<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Test
     */
    public function test_a_user_can_create_a_project(): void
    {
        $this->withExceptionHandling();

        $attributes = [
            'title' => $this->faker->title,
            'description' => $this->faker->text,
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        // $content = $this->get('/projects')->getContent();

        // file_put_contents('name.html', $content);

        // test passed successfully even when there is no GET route
        $this->get('/projects')->assertSee($attributes['title']);

        // so it should be used with the following assert
        $this->get('/projects')->assertOk();
    }

    public function test_a_project_requires_a_title(): void
    {
        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description(): void
    {
        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
