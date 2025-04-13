<!DOCTYPE html>
<html>
<head>
    <title>Done TODOs</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>

    <h2>Done TODO Items</h2>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>TODO</th>
                <th>Created At</th>
                <th>Done</th>
            </tr>
        </thead>
        <tbody>
            @forelse($todos as $todo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $todo->todo }}</td>
                    <td>{{ $todo->created_at->format('Y-m-d H:i') }}</td>
                    <td><input type="checkbox" disabled {{ $todo->done ? 'checked' : '' }}></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No active TODOs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('todos.index') }}" onclick="disableUnloadHandler()">Go to main TODO page</a>

    <script>
        let allowUnload = true;

        function disableUnloadHandler() {
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
                alert("5min session ended.");
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
