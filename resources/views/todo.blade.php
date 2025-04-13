<!DOCTYPE html>
<html>
<head>
    <title>TODO App</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>

    <h2>Add New TODO</h2>
    <form method="POST" action="{{ route('todos.store') }}">
        @csrf
        <input name="todo" type="text" required autofocus>
        <button type="submit">Add TODO</button>
    </form>

    <h2>Active TODOs</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>TODO</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($todos as $todo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $todo->todo }}</td>
                    <td>{{ $todo->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No TODOs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
