@extends('layouts.app-backoffice')

@section('content')
    @if ($icons)
        <div class="d-flex justify-content-around p-2 align-items-center">
            <h1>icons</h1>
            {{-- Form expand --}}
            <div class="d-flex align-items-center">
                <div class="btn btn-primary expand-form" data-data_item="icon_id" id="create-btn">
                    <i class="fa-solid fa-square-plus" id="create-icon"></i>
                </div>

                <div class="d-none form-create" id="icon_id">
                    {{-- CREATE icons --}}
                    <form action="{{ route('admin.icons.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="icon-name-create">icon Name:</label>
                            <input type="text" id="icon-name-create" name="name" minlength="2" maxlength="40"
                                required value="{{ old('name', '') }}" placeholder="name icon" />
                        </div>
                        <div>
                            <label for="icon_class">Icont Class:</label>
                            <input type="text" id="icon_class" name="font6_class" value="{{ old('font6_class', '') }}"
                                required placeholder="here font6 class Icon" />
                        </div>
                        <div>
                            <input type="submit" value="Create">
                        </div>
                    </form>
                </div>
            </div>
            {{-- END Form expand --}}
        </div>
        @if ($icons->isEmpty())
            <div class="mb-5">
                <h3>there are no icons</h3>
            </div>
        @else
            <div class="container-list-icons">
                <ul class="container-body">
                    {{-- CARDS --}}
                    @foreach ($icons->reverse() as $icon)
                        <li class="icon-item">
                            <div class="d-flex">
                                <i class="icon-icon {{ $icon->font6_class }}"></i>
                                <h4>{{ $icon->name }}</h4>
                            </div>
                            {{-- Form expand --}}
                            <div class="d-flex align-items-center justify-content-around">
                                <div class="btn btn-primary expand-form" data-data_item="icon_id{{ $icon->id }}">
                                    <i class="fas fa-pen"></i>
                                </div>

                                <div class="my-cont-btn d-none" id="icon_id{{ $icon->id }}">
                                    {{-- EDIT --}}
                                    <form action="{{ route('admin.icons.update', $icon->slug) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div>
                                            <label for="icon_name_{{ $icon->id }}">name icon</label>
                                            <input type="text" id="icon_name{{ $icon->id }}" name="name"
                                                minlength="2" maxlength="40" required
                                                value="{{ old('name', $icon->name) }}" required />
                                        </div>
                                        <div>
                                            <label for="icon_class{{ $icon->id }}">Icont Class:</label>
                                            <input type="text" id="icon_class{{ $icon->id }}" name="font6_class"
                                                value="{{ old('font6_class', $icon->font6_class) }}" required />
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Update
                                        </button>

                                    </form>
                                    {{-- DELETE --}}
                                    <div>
                                        <form method="POST" action="{{ route('admin.icons.destroy', $icon->slug) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input onclick="return confirm('Do you really want to delete this icon?')"
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
        <h1>ERROR -> $icons </h1>
    @endif


@endsection
