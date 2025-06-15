@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Activity</h2>

    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('activities.update', $activity) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $activity->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $activity->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Activity</button>
        <a href="{{ route('activities.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
