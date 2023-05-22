<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskState;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_create_tasks()
    {
        $user = User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);


        $response_task = $this->post('/api/task/create', [
            'title' => 'Test Title Task',
            'description' => 'Test Description Task',
            'dueDate' => date('Y-m-d')
        ]);

        $response_task->assertNoContent();

    }

    public function test_user_can_get_todo_tasks()
    {
        $user = User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);


        $response_task = $this->get('/api/todo');

        $response_task->assertStatus(200);

    }

    public function test_user_can_get_inprogress_tasks()
    {
        $user = User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);


        $response_task = $this->get('/api/inprogress');

        $response_task->assertStatus(200);

    }

    public function test_user_can_get_done_tasks()
    {
        $user = User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);


        $response_task = $this->get('/api/done');

        $response_task->assertStatus(200);

    }

    public function test_user_can_change_task_status()
    {
        $user = User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);


        $task_todo = Task::factory()->create([
            'title' => 'Test Title Task Todo',
            'description' => 'Test Description Task Todo',
            'due_date' => date('Y-m-d'),
            'created_by' => $user->id,
        ]);

        $task_todo = Task::factory()->create([
            'title' => 'Test Title Task Todo',
            'description' => 'Test Description Task Todo',
            'due_date' => date('Y-m-d'),
            'created_by' => $user->id,
        ]);

        TaskState::factory()->create([
            'task_id' =>  $task_todo->id,
            'status' => 'todo',
        ]);


        $response_task_todo = $this->post('/api/task-change-status/'.$task_todo->id.'/todo');

        $response_task_todo->assertNoContent();

        $task_inprogress = Task::factory()->create([
            'title' => 'Test Title Task Inprogress',
            'description' => 'Test Description Task Inprogress',
            'due_date' => date('Y-m-d'),
            'created_by' => $user->id,
        ]);


        TaskState::factory()->create([
            'task_id' =>  $task_inprogress->id,
            'status' => 'todo',
        ]);


        $response_task_inprogress = $this->post('/api/task-change-status/'.$task_inprogress->id.'/inprogress');

        $response_task_inprogress->assertNoContent();

        $task_done = Task::factory()->create([
            'title' => 'Test Title Task Done',
            'description' => 'Test Description Task Done',
            'due_date' => date('Y-m-d'),
            'created_by' => $user->id,
        ]);

        TaskState::factory()->create([
            'task_id' =>  $task_done->id,
            'status' => 'todo',
        ]);

        $response_task_done = $this->post('/api/task-change-status/'.$task_done->id.'/done');

        $response_task_done->assertNoContent();

    }


    public function test_user_can_update_own_task()
    {
        $user = User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);


        $task = Task::factory()->create([
            'title' => 'Test Title Task',
            'description' => 'Test Description Task ',
            'due_date' => date('Y-m-d'),
            'created_by' => $user->id,
        ]);

        TaskState::factory()->create([
            'task_id' =>  $task->id,
            'status' => 'todo',
        ]);

        $response_task = $this->post('/api/task/'.$task->id,[
            'title' => 'Updated from Test Feature Title',
            'description' => 'Updated from Test Feature Description',
            'due_date' => date('Y-m-d', strtotime('2023-06-30'))
        ]);

        $response_task->assertNoContent();

    }

    public function test_user_can_delete_own_task()
    {
        $user = User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);


        $task = Task::factory()->create([
            'title' => 'Test Title Task To Delete',
            'description' => 'Test Description To Delete',
            'due_date' => date('Y-m-d'),
            'created_by' => $user->id,
        ]);

        TaskState::factory()->create([
            'task_id' =>  $task->id,
            'status' => 'todo',
        ]);

        $response_task = $this->post('/api/delete/'.$task->id);

        $response_task->assertNoContent();

    }




}
