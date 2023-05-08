@extends('layouts.app-backoffice')

@section('content')
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="proj_title">Project Title:</label>
            <input type="text" id="proj_title" name="title" maxlength="40" required value="{{ old('title', '') }}" />
        </div>
        <div>
            <label for="description">Description:</label>
            <input required maxlength="2000" type="text" required name="description"
                value="{{ old('description', '') }}" />
        </div>
        <div>
            <label for="proj_img">Img:</label>
            <input type="file" id="proj_img" name="img_path" value="{{ old('img_path', '') }}" />
        </div>
        <div>
            <label for="proj_video">Video:</label>
            <input type="file" id="proj_video" name="video_path" accept=".mp4,.mkv"
                value="{{ old('video_path', '') }}" />
        </div>
        <div>
            <label for="url_input">Inserisci Link per GitHub:</label>
            <input type="url" id="url_input" name="link_github" />
        </div>
        @foreach ($skills as $skill)
            <input {{ in_array($skill->id, old('skill', [])) ? 'checked' : '' }} type="checkbox" name="skills[]"
                id="skill_{{ $skill->id }}" value="{{ $skill->id }}" />
            <label for="skill_{{ $skill->id }}">{{ $skill->name }}</label>
        @endforeach
        <div>
            <input type="submit" value="Create">
        </div>
    </form>
@endsection

{{-- TODO : future implements
EXAMPLE FOR ERROR MESSAGE

@error('description')
    <div class="my-2 bg-danger text-white">
        {{ $message }}
    </div>
@enderror

IN CONTROLLER IN CATCH

catch(Error $e)
    { $message =  $e->getMessage(); }

--}}
