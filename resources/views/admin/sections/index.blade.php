@extends('layouts.app-backoffice')

@section('content')
    @if (!$section)
        @include('../admin/sections/create')
    @else
        @include('../admin/sections/show')

        @include('../admin/sections/edit')
    @endif
@endsection
