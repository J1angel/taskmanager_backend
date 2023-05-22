<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskEditRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\Interfaces\TasksRepositoryInterface;
use http\Env\Request;

class TaskController extends Controller
{

    private $taskRespository;

    public function __construct(TasksRepositoryInterface $tasksRepository)
    {
        $this->taskRespository = $tasksRepository;
    }

    public function addTask(TaskRequest $request){
        $task_details = $request->validated();

        $this->taskRespository->storeTask($task_details);

        return response()->noContent();
    }

    public function getTasksTodo(){

        $todo = (new TaskCollection($this->taskRespository->allTasksTodo()))->response()->getData(true);

        return response()->json( $todo);
    }
    public function getTasksInprogress(){

        $inprogress = (new TaskCollection($this->taskRespository->allTasksInprogress()))->response()->getData(true);

        return response()->json($inprogress);
    }
    public function getTasksDone(){

        $done = (new TaskCollection($this->taskRespository->allTasksDone()))->response()->getData(true);

        return response()->json($done);
    }

    public function changeTaskStatus(Task $task, string $status){

        $this->taskRespository->changeTaskStatus($task, $status);

        return response()->noContent();
    }

    public function updateTask(Task $task, TaskEditRequest $request){
        $task_details = $request->validated();

        $this->taskRespository->updateTask($task, $task_details);

        return response()->noContent();
    }

    public function deleteTask(Task $task){

        $this->taskRespository->deleteTask($task);
        return response()->noContent();
    }
}
