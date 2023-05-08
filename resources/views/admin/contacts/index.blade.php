@extends('layouts.app-backoffice')

@section('content')
    @if ($contacts)
        <div class="d-flex justify-content-around p-2 align-items-center">
            <h1>contacts</h1>
            {{-- CREATE contact --}}
            <div>
                <a class="btn btn-success" href="{{ route('admin.contacts.create') }}">Add Contact</a>
            </div>
        </div>
        @if ($contacts->isEmpty())
            <div>
                <h3>there are no contacts</h3>
            </div>
        @else
            <div class="container-list-contacts">
                <div class="container-body">
                    {{-- List --}}
                    @foreach ($contacts as $contact)
                        {{-- Contact --}}
                        <div class="contact-item">
                            <div class="body-item d-flex justify-content-between">
                                {{-- SHOW --}}
                                <div class="contact-show">
                                    {{-- Name contact --}}
                                    <h4 class="contact-name">{{ $contact->name }}</h4>
                                    <span>{{ $contact->contact }}</span>
                                    <i class="{{ $contact->icon->font6_class }}"></i>
                                </div>
                                {{-- Buttons --}}
                                <div class="cont-btn">
                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.contacts.edit', $contact->slug) }}" class="btn btn-primary">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    {{-- DELETE --}}
                                    <div>
                                        <form method="POST" action="{{ route('admin.contacts.destroy', $contact->slug) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Do you really want to delete this contact?')"
                                                type="submit" class="btn btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
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
        <h1>ERROR -> $contacts </h1>
    @endif

@endsection
