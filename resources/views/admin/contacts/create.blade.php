@extends('layouts.app-backoffice')

@section('content')
    @if (count($icons) != 0)
        <form action="{{ route('admin.contacts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="contact-name-create">Contact neame:</label>
                <input type="text" id="contact-name-create" name="name" minlength="2" maxlength="40" required
                    value="{{ old('name', '') }}" placeholder="Name contact" />
            </div>
            <div>
                <label for="contact_value">Contact:</label>
                <input type="text" id="contact_value" name="contact" value="{{ old('contact', '') }}" required
                    placeholder="here Contact" />
            </div>
            @foreach ($icons as $icon)
                <input type="radio" name="icon_id" value="{{ $icon->id }}" id="icon_radio{{ $icon->id }}"
                    {{ old('icon_id', '') == $icon->id ? 'checked' : '' }} />
                <label for="icon_radio{{ $icon->id }}">{{ $icon->name }}</label>
            @endforeach
            <div>
                <input type="submit" value="Create">
            </div>
        </form>
    @else
        <h1>there are not icon, before create your contact, create some icons</h1>
    @endif
@endsection
