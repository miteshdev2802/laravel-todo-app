<div class="container mt-5">
    <!-- Filter Options -->
    <div class="row">
        <!-- insert field -->
        <div class="col-sm">
            <h1 class="mb-4 text-primary">Todo Manager</h1>
            <div class="mb-3 col-md-12">
                <div>
                    @if (session()->has('message'))
                    <div class="alert alert-success" id="alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>
                <form wire:submit.prevent="addTodo">
                    <h4><input type="text" class="form-control mb-2" wire:model.lazy="newTodo" placeholder="Enter a new todo"></h4>
                    @error('newTodo') <span class="text-danger">{{ $message }}</span> @enderror
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            @if($confirmingDeleteId)
            <div>
                <h5>Are you sure you want to delete this todo?</h5>
                <button wire:click="deleteTodo" class="btn btn-danger">Yes</button>
                <button wire:click="$set('confirmingDeleteId', null)" class="btn btn-secondary">No</button>
            </div>
            @endif
        </div>
        <!-- filer -->
        <div class="col-sm">
            <div>
                <label>
                    <h5><input class="form-check-input" type="radio" wire:model="filter" value="all" selected /> All</h5>
                </label>
                <label>
                    <h5> <input class="form-check-input" type="radio" wire:model="filter" value="0" /> Pending</h5>
                </label>
                <label>
                    <h5><input class="form-check-input" type="radio" wire:model="filter" value="1" /> Completed</h5>
                </label>
            </div>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Status</th>
                            <th scope="col">Text</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $key=>$todo)
                        <tr scope="row">
                            <td style="width: 10%">{{$todos->firstItem() + $key}}</td>
                            @if($editingTodoId === $todo->id)
                            <td style="width: 60%" colspan="3">
                                <!-- Edit Todo -->
                                <input type="text" class="form-control" wire:model.lazy="editingTodoTitle">
                                <button wire:click="updateTodo" class="btn btn-success ms-2">Save</button>
                                <button wire:click="cancelEdit" class="btn btn-info ms-2">Cancel</button>
                                @error('editingTodoTitle') <span class="error text-danger">{{ $message }}</span> @enderror
                                @else
                            <td style="width: 10%">
                                <input type="checkbox" wire:click="toggleTodoCompletion({{ $todo->id }})"
                                    {{ $todo->status ? 'checked' : '' }}>
                            </td>
                            <td style="width: 60%">
                                <span style="text-decoration: {{ $todo->status ? 'line-through' : 'none' }}">
                                    {{ $todo->text }}
                                </span>
                            </td>
                            <td style="width: 20%">
                                @if(!$todo->status)
                                <button wire:click="editTodo({{ $todo->id }})" class="btn btn-warning btn-sm">Edit</button>
                                @endif
                                <button wire:click="confirmDelete({{ $todo->id }})" class="btn btn-danger btn-sm" data-bs-target="#confirmDeleteModal">Delete</button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $todos->Links() }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation -->
    @if($confirmingDeleteId)
    <!-- <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this todo?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" wire:click="$set('confirmingDeleteId', null)">Cancel</button>
                    <button class="btn btn-danger" wire:click="deleteTodo" data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div> -->
    @endif
</div>