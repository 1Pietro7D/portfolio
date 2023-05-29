@extends('layouts.app-backoffice')

@section('content')
    @if ($skills)
        <div class="d-flex justify-content-around p-2 align-items-center">
            <h1>Skills</h1>
            {{-- Form expand for CREATE --}}
            <div class="d-flex align-items-center">
                <div class="btn btn-primary expand-form" data-data_item="skill_id" id="create-btn">
                    <i class="fa-solid fa-square-plus" id="create-icon"></i>
                </div>

                <div class="d-none form-create" id="skill_id">
                    {{-- CREATE skill --}}
                    <form action="{{ route('admin.skills.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="skill-name-create">Skill Name:</label>
                            <input type="text" id="skill-name-create" name="name" minlength="2" maxlength="40"
                                required value="{{ old('name', '') }}" placeholder="name Skill" />
                        </div>
                        <div>
                            <label for="skill_path">Icont path:</label>
                            <input type="text" id="skill_path" name="icon_path" value="{{ old('icon_path', '') }}"
                                required placeholder="here font6 Icon" />
                        </div>
                        <div>
                            <input type="submit" value="Create">
                        </div>
                    </form>
                </div>
            </div>
            {{-- END Form expand --}}
        </div>
        @if ($skills->isEmpty())
            <div class="mb-5">
                <h3>there are no skills</h3>
            </div>
        @else
            <div class="container-list-skills">
                <ul class="container-body">
                    {{-- CARDS for all skills --}}
                    @foreach ($skills->reverse() as $skill)
                        <li class="skill-item">
                            <div class="d-flex">
                                <i class="skill-icon {{ $skill->icon_path }}"></i>
                                <h4>{{ $skill->name }}</h4>
                            </div>
                            {{-- Form expand for skill for EDIT and DELETE --}}
                            <div class="d-flex align-items-center justify-content-around">
                                <div class="btn btn-primary expand-form" data-data_item="skill_id{{ $skill->id }}">
                                    <i class="fas fa-pen"></i>
                                </div>

                                <div class="my-cont-btn d-none" id="skill_id{{ $skill->id }}">
                                    {{-- EDIT skill --}}
                                    <form action="{{ route('admin.skills.update', $skill->slug) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div>
                                            <label for="skill_name_{{ $skill->id }}">New name</label>
                                            <input type="text" id="skill_name{{ $skill->id }}" name="name"
                                                minlength="2" maxlength="40" required
                                                value="{{ old('name', $skill->name) }}" required />
                                        </div>
                                        <div>
                                            <label for="skill_path{{ $skill->id }}">Icont path:</label>
                                            <input type="text" id="skill_path{{ $skill->id }}" name="icon_path"
                                                value="{{ old('icon_path', $skill->icon_path) }}" required />
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Update
                                        </button>

                                    </form>
                                    {{-- DELETE skill --}}
                                    <div>
                                        <form method="POST" action="{{ route('admin.skills.destroy', $skill->slug) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input onclick="return confirm('Do you really want to delete this Skill?')"
                                                type="submit" value="Delete" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- END Form expand --}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    @else
        <h1>ERROR -> $skills </h1>
    @endif


@endsection
