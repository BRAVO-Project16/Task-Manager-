<!DOCTYPE html>
<html>

<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div>
            <h1>✓ Task Manager</h1>
            <p>Plan your tasks and get things done.</p>
        </div>

        <div class="date-box">
            📅 {{ now()->format('F d, Y') }}<br>
            {{ now()->format('g:i A') }}
        </div>
    </div>


    <!-- ADD TASK -->
    <div class="card">
        <h2>Add New Task</h2>

        <form action="{{ route('tasks.store', [], false) }}" method="POST">
            @csrf

            <div class="form-row">

                <input
                    type="text"
                    name="task_name"
                    placeholder="Task name"
                    required
                >

                <input
                    type="text"
                    name="description"
                    placeholder="Description"
                >

            </div>

            <div class="form-row">

                <div>
                    <label>Due Date</label>

                    <input
                        type="date"
                        name="due_date"
                    >
                </div>

                <div>
                    <label>Status</label>

                    <select name="status">
                        <option value="Pending">Pending</option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <button type="submit">
                    + Add Task
                </button>

            </div>
        </form>
    </div>


    <!-- MAIN CONTENT -->
    <div class="content">

        <!-- YOUR TASKS -->
        <div class="card">

            <div class="section-header">
                <h2>Your Tasks</h2>
                <span>{{ $tasks->count() }} tasks</span>
            </div>

            @foreach ($tasks as $task)

                @php
                    $status = strtolower($task->status);
                @endphp

                <div class="task">

                    <div class="check">

                        @if($status == 'completed')
                            ✓
                        @else
                            ○
                        @endif

                    </div>

                    <div class="task-info">

                        <h3
                            @if($status == 'completed')
                                class="completed-text"
                            @endif
                        >
                            {{ $task->task_name }}
                        </h3>

                        @if($task->description)
                            <p>{{ $task->description }}</p>
                        @endif

                        @if($task->due_date)
                            <small>
                                📅 {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                            </small>
                        @endif

                    </div>

                    <span class="status {{ $status }}">
                        {{ $task->status }}
                    </span>


                    <!-- ACTIONS -->
                    <div class="actions">

                        <a
                            href="{{ route('tasks.edit', $task->id, false) }}"
                            class="edit"
                        >
                            Edit
                        </a>


                        <form
                            action="{{ route('tasks.destroy', $task->id, false) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete"
                                onclick="return confirm('Delete this task?')"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach


            @if($tasks->count() == 0)

                <div class="empty">
                    <h3>No tasks yet.</h3>
                    <p>Add your first task above.</p>
                </div>

            @endif

        </div>


        <!-- DONE TASKS -->
        <div class="card done-card">

            <h2>Done Tasks</h2>

            @php
                $completedTasks = $tasks->where('status', 'Completed');
            @endphp

            <div class="done-number">
                {{ $completedTasks->count() }}
            </div>

            <p>Completed tasks</p>

            @foreach($completedTasks as $task)

                <div class="done-task">
                    ✓ {{ $task->task_name }}
                </div>

            @endforeach

            @if($completedTasks->count() == 0)
                <p class="empty">No completed tasks yet.</p>
            @endif

        </div>

    </div>

</div>

</body>
</html>