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

    public $rows, $remaningTask, $targetedData;

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
    function completed ($id,$tab){
        $taskList= Task::where('id',$id)->first();
        $taskList->update([
            'status'=> $taskList->status==0? 1:0,
        ]);
        $this->test = $id .''. $tab;
        // $this->allRest();
        // $this->rows=
        // $this->targetedData = $this->rows;
        $this->mount();

        $this->currentTab = $tab;
        $this->test = $this->targetedData;

    }

    // check all complete task
    function checkAllTask (){
        $taskList= Task::where('status', 0)->update(['status' => 1]);
        $this->allRest();
    }

    // all complete task
    function allTask ($tab){
        $this->currentTab = $tab;
        $this->rows = $this->targetedData= Task::orderBy('id','DESC')->get();
        // $this->targetedData=$this->rows;
        $this->allRest();
    }
    // all active task
    function activeTask ($tab){
        $this->allRest();
        $this->currentTab = $tab;
        $this->targetedData=  Task::where('status', 0)->orderBy('id','DESC')->get();
        // $this->rows= $this->targetedData;
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
        $this->remaningTask = Task::where('status',0)->count();
        $this->targetedData=$this->rows;
    }

    public function render()
    {
        return view('livewire.task-livewire',['rows'=>$this->rows]);
    }
}
