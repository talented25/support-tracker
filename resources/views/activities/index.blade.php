@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">📋 Activities</h2>

    @if (session('success'))
        <div class="bg-green-700 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('activities.create') }}"
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded mb-6">
        + Add Activity
    </a>

    @forelse($activities as $activity)
        <div class="bg-gray-800 text-gray-100 rounded shadow p-4 mb-6">
            <h3 class="text-xl font-bold mb-1">{{ $activity->title }}</h3>
            <p class="text-gray-400 mb-3">{{ $activity->description }}</p>

            <form method="POST" action="{{ route('activity_logs.store', $activity->id) }}" class="space-y-4">
                @csrf
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select name="status"
                            class="w-full bg-gray-900 border border-gray-700 text-gray-100 rounded p-2 focus:outline-none focus:ring focus:border-indigo-500"
                            required>
                            <option value="">Select status</option>
                            <option value="done">✅ Done</option>
                            <option value="pending">⏳ Pending</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium mb-1">Remarks</label>
                        <input type="text" name="remarks" placeholder="Optional remarks..."
                            class="w-full bg-gray-900 border border-gray-700 text-gray-100 rounded p-2 focus:outline-none focus:ring focus:border-indigo-500">
                    </div>
                    <div class="sm:w-1/3 mt-2 sm:mt-6">
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                            Submit Log
                        </button>
                    </div>
                </div>
            </form>

            <hr class="my-4 border-gray-700">

            <h4 class="text-sm font-semibold mb-2">📑 Logs</h4>
            @if ($activity->logs->isEmpty())
                <p class="text-gray-400">No logs yet.</p>
            @else
                <ul class="space-y-2">
                    @foreach ($activity->logs as $log)
                        <li class="bg-gray-700 p-3 rounded flex justify-between items-center">
                            <div>
                                <span class="inline-block px-2 py-1 text-xs font-bold rounded
                                    {{ $log->status === 'done' ? 'bg-green-600 text-white' : 'bg-yellow-400 text-black' }}">
                                    {{ ucfirst($log->status) }}
                                </span>
                                <span class="ml-2">{{ $log->remarks ?? 'No remarks' }}</span>
                            </div>
                            <small class="text-gray-300">
                                by {{ $log->user->name ?? 'Unknown' }} at
                                {{ \Carbon\Carbon::parse($log->logged_at)->format('Y-m-d H:i') }}
                            </small>
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="flex gap-3 mt-4">
                <a href="{{ route('activities.edit', $activity) }}"
                   class="text-blue-400 hover:underline text-sm">✏️ Edit</a>

                <form action="{{ route('activities.destroy', $activity) }}" method="POST"
                      onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400 hover:underline text-sm">🗑️ Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-gray-800 text-gray-300 p-4 rounded">
            No activities found.
        </div>
    @endforelse
</div>
@endsection
