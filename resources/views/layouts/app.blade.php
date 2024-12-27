<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireStyles
</head>

<body>
    <div>
        @livewire('todo-counter') <!-- Show the counter at the top -->
        @livewire('todo-manager') <!-- Todo manager below -->
    </div>
    <script>
        setTimeout(function() {
            $('#alert-success').remove();
        }, 3000);
    </script>
    @livewireScripts
</body>

</html>