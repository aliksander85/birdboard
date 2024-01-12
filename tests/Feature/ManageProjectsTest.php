<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_manage_projects(): void
    {
        $project = Project::factory()->create();

        $this->get('/projects',)->assertRedirect('login');
        $this->get('/projects/create',)->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

    /**
     * Test
     */
    public function test_a_user_can_create_a_project(): void
    {
        $this->withExceptionHandling();

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->title,
            'description' => $this->faker->text,
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        // $content = $this->get('/projects')->getContent();

        // file_put_contents('name.html', $content);

        // test passed successfully even when there is no GET route
        // so it should be used with the following assertOk
        $this->get('/projects')
            ->assertSee($attributes['title'])
            ->assertOk();
    }

    public function test_a_user_can_view_their_project(): void
    {
        // $this->withExceptionHandling();

        $this->signIn();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description)
            ->assertOk();
    }

    public function test_an_authenticated_user_cannot_view_the_projects_of_thers(): void
    {
        $this->withExceptionHandling();

        $this->signIn();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title(): void
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description(): void
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
