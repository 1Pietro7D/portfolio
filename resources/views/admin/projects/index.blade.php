@extends('layouts.app-backoffice')

@section('content')
    @if ($projects)
        <div class="d-flex justify-content-around p-2 align-items-center">
            <h1>Projects</h1>
            {{-- CREATE PROJECT --}}
            <div>
                <a class="btn btn-success" href="{{ route('admin.projects.create') }}">Add Project</a>
            </div>
        </div>
        @if ($projects->isEmpty())
            <div>
                <h3>there are no projects</h3>
            </div>
        @else
            <div class="container-cards-projects">
                <div class="container-body">
                    {{-- CARDS --}}
                    @foreach ($projects->reverse() as $project)
                        {{-- PROJECT --}}
                        <div class="proj-card">
                            <div class="body-card">
                                {{-- SHOW --}}
                                <div class="proj-show">
                                    <a href="{{ route('admin.projects.show', $project->slug) }}"
                                        id="proj-show-{{ $project->slug }}">
                                        {{-- Title project --}}
                                        <h4 class="proj-title">{{ $project->title }}</h4>
                                    </a>
                                </div>
                                {{-- Buttons --}}
                                <div class="my-cont-btn">
                                    {{-- EDIT --}}
                                    <div>
                                        <a href="{{ route('admin.projects.edit', $project->slug) }}">Edit</a>
                                    </div>
                                    {{-- DELETE --}}
                                    <div>
                                        <form method="POST" action="{{ route('admin.projects.destroy', $project->slug) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input onclick="return confirm('Do you really want to delete this Project?')"
                                                type="submit" value="Delete" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        <h1>ERROR -> $projects </h1>
    @endif


    @foreach ($projects as $project)
        <style>
            #proj-show-{{ $project->slug }} {
                background-image: url({{ asset('storage/' . $project->img_path) }} );
                background-repeat: no-repeat;
                background-position: center center;
                background-size: cover;
            }
        </style>
    @endforeach

@endsection
