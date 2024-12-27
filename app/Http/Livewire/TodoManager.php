<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;

class TodoManager extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $todos = [];
    public $newTodo = '';
    public $perPage = 10;
    public $editingTodoId = null;
    public $editingTodoTitle = '';
    public $confirmingDeleteId = null;
    public $filter = 'all';

    protected $rules = [
        'newTodo' => 'required|min:3|max:255',
        'editingTodoTitle' => 'required|min:3|max:255',
    ];

    public function mount()
    {
        $this->refreshTodos();
    }

    public function refreshTodos()
    {
        if ($this->filter === '0') {
            return $this->todos = Todo::where('status', '0')->orderBy('created_at', 'ASC')->paginate($this->perPage);
        } elseif ($this->filter === '1') {
            return $this->todos = Todo::where('status', '1')->orderBy('created_at', 'ASC')->paginate($this->perPage);
        } else {
            return $this->todos = Todo::orderBy('created_at', 'ASC')->paginate($this->perPage);
        }
        // return $this->todos = Todo::paginate($this->perPage);
    }

    public function addTodo()
    {
        $this->validateOnly('newTodo');

        $todo = Todo::create(['text' => $this->newTodo, 'status' => 0]);
        $this->refreshTodos();
        $this->newTodo = '';
        $this->emit('refreshCounter'); // Emit event to update counter
        session()->flash('message', 'Post successfully added.', array('timeout' => 3000));
    }

    public function editTodo($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $this->editingTodoId = $id;
            $this->editingTodoTitle = $todo->text;
        }
    }

    public function updateTodo()
    {
        $this->validateOnly('editingTodoTitle');

        $todo = Todo::find($this->editingTodoId);
        if ($todo) {
            $todo->text = $this->editingTodoTitle;
            $todo->save();
            $this->refreshTodos();
            $this->cancelEdit();
            $this->emit('refreshCounter'); // Emit event to update counter
            session()->flash('message', 'Todo successfully updated.', array('timeout' => 3000));
        }
    }

    public function cancelEdit()
    {
        $this->editingTodoId = null;
        $this->editingTodoTitle = '';
    }

    public function toggleTodoCompletion($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->status = !$todo->status;
            $todo->save();
            $this->refreshTodos();
            $this->emit('refreshCounter'); // Emit event to update counter
            session()->flash('message', 'Todo status changed successfully.', array('timeout' => 3000));
        }
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function deleteTodo()
    {
        if ($this->confirmingDeleteId) {
            Todo::destroy($this->confirmingDeleteId);
            $this->refreshTodos();
            $this->confirmingDeleteId = null;
            $this->emit('refreshCounter'); // Emit event to update counter
            session()->flash('message', 'Todo deleted successfully.', array('timeout' => 3000));
        }
    }

    public function render()
    {
        $todosData = $this->refreshTodos();
        return view('livewire.todo-manager', ['todos' => $todosData]);
    }
}
