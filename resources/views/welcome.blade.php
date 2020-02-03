<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tasks</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">

    </head>
    <body>

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">

                <div class="dd">
                    <ol class="dd-list">

                        @foreach($tasks as $task)
                            <li class="dd-item" data-id="{{ $task->id }}" id="task-{{ $task->id }}">
                                <div class="dd-handle">{{ $task->id }}. {{ $task->title }} <span class="badge badge-success">{{ $task->position }}</span></div>
                            </li>
                        @endforeach

                    </ol>
                </div>

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
    <script src="js/script.js"></script>
    </body>
</html>
