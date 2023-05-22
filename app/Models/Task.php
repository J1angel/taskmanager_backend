<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'created_by'
    ];

    public function taskStatus()
    {
        return $this->hasOne('App\Models\TaskState', 'task_id', 'id');
    }

    public function owner()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function todo(){
        return $this->whereHas('taskStatus', function ($query) {
            $query->where('status', 'todo');
        });
    }

    public function inprogress(){
        return $this->whereHas('taskStatus', function ($query){
            $query->where('status', 'inprogress');
        });
    }

    public function done(){
        return $this->whereHas('taskStatus', function ($query){
            $query->where('status', 'done');
        });
    }


}
