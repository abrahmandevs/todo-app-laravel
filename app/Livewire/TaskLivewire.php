<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Validate;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TaskLivewire extends Component
{

    public $rows, $remaningTask;

    // public $addTodo;
    public $currentTab='defaultTab';
    public $test;

   /*  protected function rules(){
		// $validation = [];
		// $validation['addTodo'] = ['required','string','between:3,100'];
		// return $validation;
        return [
            'addTodo' => ['required', 'string', 'between:3,100'],
        ];
    }

	protected function messages(){
		return [
            'addTodo.required' => 'Required.',
            'addTodo.between' => 'The todo must be between 3-100 characters.',
        ];
    } */

    #[Validate('required|min:5')]
    public string $addTodo = '';



    public function allRest(){
        $this->resetErrorBag();
        $this->reset();
        $this->mount();
    }

    function createTodo ($tab){
        $this->validate();
        if (!auth()->check()) {
            return redirect(route('login'));
        }

        Task::create([
            'name'=>$this->addTodo,
            'assigned_id'=>Auth::id()
        ]);

        $this->allRest();
        $this->currentTab = $tab;
    }

    // delete todo
    function deleteTodo ($id){
        $checkTask = Task::whereId($id)->first();
        if (!$checkTask) {
           dd($id);
        }
        $checkTask->delete();
        $this->allRest();
        return back();
    }

    // singel complete task
    function completed ($id){
        $taskList= Task::where('id',$id)->where('status', 0)->update(['status' => 1]);
        $this->allRest();
    }

    // check all complete task
    function checkAllTask (){
        $taskList= Task::where('status', 0)->update(['status' => 1]);
        $this->allRest();
    }

    // all complete task
    function allTask ($tab){
        $this->currentTab = $tab;
        $this->rows = Task::orderBy('id','DESC')->get();
    }
    // all active task
    function activeTask ($tab){
        $this->currentTab = $tab;
        $this->rows= Task::where('status', 0)->orderBy('id','DESC')->get();
    }

    // all completed task
    function completedTask ($tab){
        $this->currentTab = $tab;
        $this->rows = Task::where('status', 1)->orderBy('id','DESC')->get();
    }

    // clear completed task
    function clearCompletedTask (){
        $this->rows=Task::where('status', 1)->get();
        foreach ($this->rows as $row) {
            $row->delete();
        }
        $this->allRest();
        return back();

    }

    public function mount(){
        $this->rows = Task::orderBy('id','DESC')->get();
        $this->remaningTask = $this->rows->where('status',0)->count();
    }

    public function render()
    {
        return view('livewire.task-livewire',['rows'=>$this->rows]);
    }
}
