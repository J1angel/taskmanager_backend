<?php
namespace App\Repositories\Interfaces;

use App\Models\Task;

Interface TasksRepositoryInterface{

    public function allTasksTodo();
    public function allTasksInprogress();
    public function allTasksDone();
    public function storeTask($data);
    public function changeTaskStatus(Task $task, string $status);
    public function updateTask(Task $task, array $details);
    public function deleteTask(Task $task);
}
