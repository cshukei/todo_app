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
    <form method="POST" action="{{ route('todos.store') }}" onsubmit="disableUnloadHandler()">
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
    <script>
        let allowUnload = true;

        function disableUnloadHandler() {
            console.log("disableUnloadHandler")
            allowUnload = false;
        }

        window.addEventListener("beforeunload", function (e) {
            if (allowUnload) {
                const url = "{{ route('todos.session.end') }}";
                const data = new FormData();
                data.append('_token', '{{ csrf_token() }}');
                navigator.sendBeacon(url, data);
            }
        });

        // Inactivity timer — still OK to call session end
        let timeout;
        function resetTimer() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                console.log("5min");
                alert("Your session has ended.");
                fetch("{{ route('todos.session.end') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                });
            }, 5 * 60 * 1000); // 5 minutes
        }

        ['click', 'mousemove', 'keydown'].forEach(evt =>
            window.addEventListener(evt, resetTimer)
        );
        resetTimer();
    </script>
</body>
</html>
