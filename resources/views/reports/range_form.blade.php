@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold">📅 Generate Report by Date Range</h2>
    </div>

    {{-- Date Range Form --}}
    <form method="POST" action="{{ route('reports.range.submit') }}" class="bg-white p-6 rounded shadow-md mb-10 max-w-xl">
        @csrf
        <div class="mb-4">
            <label for="from_date" class="block text-sm font-medium">From Date</label>
            <input type="date" name="from_date" id="from_date" required value="{{ old('from_date') }}" class="mt-1 block w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label for="to_date" class="block text-sm font-medium">To Date</label>
            <input type="date" name="to_date" id="to_date" required value="{{ old('to_date') }}" class="mt-1 block w-full border border-gray-300 rounded p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">🔍 Generate</button>
    </form>

    {{-- Logs Display --}}
    @if(request()->isMethod('post'))
        <div class="bg-gray-50 p-5 rounded shadow border border-blue-100">
            <h3 class="text-xl font-semibold mb-4">
                🗂️ Activity Logs from {{ request('from_date') }} to {{ request('to_date') }}
            </h3>

            @if(isset($logs) && count($logs))
                <div class="space-y-4">
                    @foreach($logs as $log)
                        <div class="p-4 bg-white rounded border-l-4 border-blue-500 shadow-sm">
                            <p class="font-semibold text-lg">{{ $log->activity->title ?? 'Untitled Activity' }}</p>
                            <p class="text-sm">Status: <span class="capitalize font-medium">{{ $log->status }}</span> - {{ $log->remarks ?: 'No remarks' }}</p>
                            <p class="text-xs text-gray-500 mt-1">By {{ $log->user->name ?? 'Unknown' }} at {{ \Carbon\Carbon::parse($log->logged_at)->format('Y-m-d H:i') }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-red-500 font-semibold">⚠️ No activity logs found in this date range.</p>
            @endif
        </div>
    @endif

</div>
@endsection
