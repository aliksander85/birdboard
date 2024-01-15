<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;


    public function test_a_project_have_tasks(): void
    {
        $project = ProjectFactory::create();

        $this
            ->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    public function test_only_the_owner_of_a_project_may_add_tasks(): void
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    public function test_only_the_owner_of_a_project_may_update_a_task(): void
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $task = $project->tasks()->first();

        $this->patch($task->path(), ['body' => 'changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    public function test_task_requires_a_body(): void
    {
        $project = ProjectFactory::create();

        $attributes = Task::factory()->raw(['body' => '']);

        $this
            ->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }

    public function test_a_task_can_be_updated(): void
    {
        $project = ProjectFactory::withTasks(1)->create();

        $task = $project->tasks()->first();

        $attributes = [
            'body' => 'changed',
            'completed' => true,
        ];

        $this
            ->actingAs($project->owner)
            ->patch($task->path(), $attributes);

        $this->assertDatabaseHas('tasks', $attributes);
    }
}
