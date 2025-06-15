@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Report from {{ $request->from_date }} to {{ $request->to_date }}</h2>

    @if($logs->isEmpty())
        <p>No activity logs found for this date range.</p>
    @else
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">User</th>
                    <th class="border px-4 py-2">Activity</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Remarks</th>
                    <th class="border px-4 py-2">Logged At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td class="border px-4 py-2">{{ $log->user->name }}</td>
                        <td class="border px-4 py-2">{{ $log->activity->title }}</td>
                        <td class="border px-4 py-2">{{ $log->status }}</td>
                        <td class="border px-4 py-2">{{ $log->remarks }}</td>
                        <td class="border px-4 py-2">{{ $log->logged_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
