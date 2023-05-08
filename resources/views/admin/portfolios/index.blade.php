@extends('layouts.app-backoffice')

@section('content')
    <section class="container-fluid">
        {{-- @dd($portfolio) --}}
        @if(!$portfolio)
        <div class="mb-5">
            <a href="{{ route('admin.portfolios.create') }}">Add new Portfolio</a>
        </div>
        @else
            <h1>{{ $portfolio->name }}</h1>


            @if($portfolio->curriculum_vitae_pdf)
                <form action="{{ route('admin.cv.view') }}" method="GET" target="_blank">
                    <button type="submit" class="btn btn-primary">Apri il Curriculum Vitae</button>
                </form>
                <form action="{{ route('admin.cv.download') }}" method="GET">
                    <button type="submit" class="btn btn-primary">Scarica il Curriculum Vitae</button>
                </form>
            @else

            @endif
            <div class="mt-3">
                <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}">Edit Portfolio</a>
            </div>
            <form class="btn btn-danger" method="POST" action="{{ route('admin.portfolios.destroy', $portfolio->id) }}">
                @csrf
                @method('DELETE')
                <input onclick="return confirm('Do you really want to delete this portfolio?')" type="submit" value="Delete">
            </form>
        @endif
@endsection
