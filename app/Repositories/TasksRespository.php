<?php

namespace App\Repositories;

use App\Repositories\Interfaces\TasksRepositoryInterface;
use App\Models\Task;

class TasksRespository implements TasksRepositoryInterface
{
    protected $tasks;

    function __construct(Task $t) {
        $this->tasks = $t;
    }

    public function storeTask($data)
    {
        return $this->tasks->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'due_date' => $data['dueDate'],
            'created_by' => auth()->user()->id,
        ])->taskStatus()->create([
            'status' => 'todo'
        ]);
    }

    public function allTasksTodo()
    {
        return $this->tasks->todo()->with('owner')->latest()->paginate(10);
    }

    public function allTasksInprogress()
    {
        return $this->tasks->inprogress()->with('owner')->latest()->paginate(10);
    }

    public function allTasksDone()
    {
        return $this->tasks->done()->with('owner')->latest()->paginate(10);
    }

    public function changeTaskStatus(Task $task, string $status){
        return $task->taskStatus()->update(['status' => $status]);
    }

    public function updateTask(Task $task, array $details)
    {
        return $task->update($details);
    }

    public function deleteTask(Task $task)
    {
        $task->taskStatus()->delete();
        return $task->delete();

    }

}
