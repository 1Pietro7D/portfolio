@extends('../layouts.app-backoffice')

@section('content')
    <div class="bo-home">

        <form action="{{ route('cv.view') }}" method="GET" target="_blank">
            <button type="submit" class="btn btn-primary">Apri il Curriculum Vitae</button>
        </form>
        <form action="{{ route('cv.download') }}" method="GET">
            <button type="submit" class="btn btn-primary">Scarica il Curriculum Vitae</button>
        </form>

    </div>
@endsection
