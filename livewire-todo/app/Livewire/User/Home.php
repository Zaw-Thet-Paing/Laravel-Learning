<?php

namespace App\Livewire\User;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{

    public $name;
    public $tasks = [];

    public function mount()
    {
        $this->tasks = Task::where('user_id', Auth::user()->id)->get();
    }

    public function toggleStatus($taskId)
    {
        $task = Task::find($taskId);
        $task->update(['status'=> !$task->status]);
        $this->tasks = Task::where('user_id', Auth::user()->id)->get();
    }

    public function saveTask()
    {
        // dd($this->name);
        Task::create([
            'name'=> $this->name,
            'user_id'=> Auth::user()->id
        ]);

        $this->name = '';
        $this->tasks = Task::where('user_id', Auth::user()->id)->get();

    }

    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);
        $task->delete();
        $this->tasks = Task::where('user_id', Auth::user()->id)->get();
    }

    public function logout()
    {
        Auth::logout();

        $this->redirect(route('login'), navigate:true);
    }

    public function render()
    {
        return view('livewire.user.home');
    }
}
