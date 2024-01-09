<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_create_projects(): void
    {
        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    public function test_guests_cannot_view_projects(): void
    {
        $this->get('/projects',)->assertRedirect('login');
    }

    public function test_guests_cannot_view_a_single_project(): void
    {
        $project = Project::factory()->create();

        $this->get($project->path())->assertRedirect('login');
    }

    /**
     * Test
     */
    public function test_a_user_can_create_a_project(): void
    {
        $this->withExceptionHandling();

        $this->actingAs(User::factory()->create());

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

    public function test_a_user_can_view_their_project(): void
    {
        $this->withExceptionHandling();

        $this->be(User::factory()->create());

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description)
            ->assertOk();
    }

    public function test_an_authenticated_user_cannot_view_the_projects_of_thers(): void
    {
        $this->withExceptionHandling();

        $this->be(User::factory()->create());

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title(): void
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description(): void
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
