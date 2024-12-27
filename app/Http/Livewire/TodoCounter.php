<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoCounter extends Component
{
    public $completedCount = 0;
    public $pendingCount = 0;

    protected $listeners = ['refreshCounter' => 'updateCounter'];

    public function mount()
    {
        $this->updateCounter();
    }

    public function updateCounter()
    {
        $this->completedCount = Todo::where('status', true)->count();
        $this->pendingCount = Todo::where('status', false)->count();
    }

    public function render()
    {
        return view('livewire.todo-counter');
    }
}
