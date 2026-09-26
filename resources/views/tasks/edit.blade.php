<!DOCTYPE html>
<html>

<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<div class="edit-container">

    <!-- HEADER -->
    <div class="edit-header">

        <h1>✎ Edit Task</h1>

        <p>Update your task information.</p>

    </div>


    <!-- EDIT FORM -->
    <div class="card">

        <form
            action="/tasks/{{ $task->id }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="form-group">

                <label>Task Name</label>

                <input
                    type="text"
                    name="task_name"
                    value="{{ $task->task_name }}"
                    required
                >

            </div>


            <div class="form-group">

                <label>Description</label>

                <input
                    type="text"
                    name="description"
                    value="{{ $task->description }}"
                >

            </div>


            <div class="form-group">

                <label>Status</label>

                <select name="status">

                    <option
                        value="Pending"
                        {{ $task->status == 'Pending' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="Ongoing"
                        {{ $task->status == 'Ongoing' ? 'selected' : '' }}
                    >
                        Ongoing
                    </option>

                    <option
                        value="Completed"
                        {{ $task->status == 'Completed' ? 'selected' : '' }}
                    >
                        Completed
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>Due Date</label>

                <input
                    type="date"
                    name="due_date"
                    value="{{ $task->due_date }}"
                >

            </div>


            <div class="button-row">

                <a href="/tasks" class="back">
                    ← Back to Tasks
                </a>

                <button type="submit">
                    ✓ Update Task
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>