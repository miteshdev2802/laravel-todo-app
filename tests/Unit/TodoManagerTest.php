<?php

namespace Tests\Unit;

use App\Http\Livewire\TodoManager;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TodoManagerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_save_a_todo()
    {
        // Act: Interact with the Livewire component
        Livewire::test(TodoManager::class)
            ->set('newTodo', 'Test Todo')
            ->call('addTodo');

        // Assert: Check if the todo is saved in the database
        $this->assertDatabaseHas('todos', [
            'text' => 'Test Todo',
            'status' => false,
        ]);
    }

    /** @test */
    public function it_displays_validation_error_for_empty_todo()
    {
        // Act: Try to add an invalid todo
        Livewire::test(TodoManager::class)
            ->set('newTodo', '')
            ->call('addTodo')
            ->assertHasErrors(['newTodo' => 'required']);
    }

    /** @test */
    public function it_displays_validation_error_for_short_todo()
    {
        // Act: Try to add a todo with less than 3 characters
        Livewire::test(TodoManager::class)
            ->set('newTodo', 'Hi')
            ->call('addTodo')
            ->assertHasErrors(['newTodo' => 'min']);
    }

    /** @test */
    public function it_updates_a_todo_properly()
    {
        // Arrange: Create a todo
        $todo = Todo::create(['text' => 'Initial Todo', 'status' => false]);

        // Act: Update the todo's text
        Livewire::test(TodoManager::class)
            ->set('editingTodoId', $todo->id)
            ->set('editingTodoTitle', 'Updated Todo')
            ->call('updateTodo');

        // Assert: Check if the todo is updated in the database
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'text' => 'Updated Todo',
        ]);
    }

    /** @test */
    public function it_can_update_completed_status_of_a_todo()
    {
        // Arrange: Create a todo
        $todo = Todo::create(['text' => 'Incomplete Todo', 'status' => false]);

        // Act: Mark the todo as completed
        $todo->status = true;
        $todo->save();

        // Assert: Check if the status is updated
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'status' => true,
        ]);
    }
}
