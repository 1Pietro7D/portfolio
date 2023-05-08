@extends('layouts.app-backoffice')

@section('content')
    <form action="{{ route('admin.contacts.update', $contact->slug) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div>
            <label for="contact-name-create">Contact neame:</label>
            <input type="text" id="contact-name-create" name="name" minlength="2" maxlength="40" required
                value="{{ old('name', $contact->name) }}" placeholder="Name contact" />
        </div>
        <div>
            <label for="contact_value">Contact:</label>
            <input type="text" id="contact_value" name="contact" value="{{ old('contact', $contact->contact) }}" required
                placeholder="here Contact" />
        </div>
        @foreach ($icons as $icon)
            <input type="radio" name="icon_id" value="{{ $icon->id }}" id="icon_radio{{ $icon->id }}"
                {{ old('icon_id', $contact->icon) == $icon ? 'checked' : '' }} />
            <label for="icon_radio{{ $icon->id }}">{{ $icon->name }}</label>
        @endforeach
        <div>
            <input type="submit" value="Update">
        </div>
    </form>
@endsection
