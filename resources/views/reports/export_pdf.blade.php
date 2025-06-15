<!DOCTYPE html>
<html>
<head>
    <title>Daily Activity Logs</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Daily Activity Logs - {{ now()->toDateString() }}</h2>

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Activity</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Logged At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->activity->title }}</td>
                    <td>{{ $log->status }}</td>
                    <td>{{ $log->remarks }}</td>
                    <td>{{ $log->logged_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
