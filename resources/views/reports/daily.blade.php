@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">📅 Daily Activity Logs</h2>

    @if ($logs->isEmpty())
        <p>No logs found for today.</p>
    @else
        <ul class="space-y-3">
            @foreach ($logs as $log)
                <li class="bg-gray-800 p-4 rounded shadow text-white">
                    <strong>{{ $log->activity->title }}</strong><br>
                    {{ ucfirst($log->status) }} - {{ $log->remarks ?? 'No remarks' }}<br>
                    by <em>{{ $log->user->name ?? 'Unknown' }}</em>
                    at {{ \Carbon\Carbon::parse($log->logged_at)->format('Y-m-d H:i') }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
notepad resources\views\reports\range_form.blade.php
