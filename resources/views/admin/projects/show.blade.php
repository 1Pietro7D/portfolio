@extends('layouts.app-backoffice')

@section('content')
    {{-- TITLE --}}
    <h1>{{ $project->title }}</h1>

    {{-- DESCRIPTION --}}
    <p>{{ $project->description }}</p>

    {{-- IMAGE --}}
    @if ($project->img_path)
        <div class="proj-img">
            <img class="w-25" src="{{ asset('storage/'.$project->img_path) }}" alt="{{ $project->description }}">
        </div>
    @else
        <div>Has not image</div>
    @endif
    {{-- VIDEO --}}
    @empty ($project->video_path)
        <div>Has not video</div>
    @else
        @if(Str::endsWith($project->video_path, '.mp4'))
            <video controls class="proj-video">
                <source src="{{ asset('storage/'.$project->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @elseif(Str::endsWith($project->video_path, '.mkv'))
            <video controls class="proj-video">
            <source src="{{ asset('storage/'.$project->video_path) }}" type="video/x-matroska">
            Your browser does not support the video tag.
            </video>
        @endif
    @endif
    {{-- SKILLS --}}
    @if ($project->skills)
        {{ count($project->skills) }}
        {{ ($project->skills) }}
        @foreach ($project->skills as $skill)
        <br> {{$skill->name}} <br>
        @endforeach
    @else
        false
    @endempty

    {{-- DELETE --}}
    <form class="mt-3" method="POST" action="{{ route('admin.projects.destroy', $project->slug) }}">
        @csrf
        @method('DELETE')
        <input onclick="return confirm('Do you really want to delete this Project?')" type="submit" value="Delete">
    </form>

    {{-- EDIT --}}
    <div class="mt-3">
        <a href="{{ route('admin.projects.edit', $project->slug) }}">Edit Project</a>
    </div>
    {{-- LOCAL STYLE --}}

    <style>
        .proj-video{
            width: 720px;
            height: 360px
        }
    </style>
@endsection


