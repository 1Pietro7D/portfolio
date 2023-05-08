@extends('layouts.app-backoffice')

@section('content')
    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div>
            <label for="port_name" >Portfolio Name:</label>
            <input type="text" id="port_name" name="name" maxlength="40" required value="{{ old('name', '') }}">
        </div>
        <div>
            <label for="cv">Carica il tuo CV in formato PDF:</label>
            <input type="file" id="cv" name="curriculum_vitae_pdf" accept=".pdf" value="{{ old('curriculum_vitae_pdf', '') }}">
        </div>
        <div>
            <input type="submit" value="Create">
        </div>
    </form>

@endsection
