<section>
    <h1>{{ $section->title }}</h1>
    <p>{{ $section->paragraph }}</p>
    @if ($section->img_path)
        <img class="w-25" src="{{ asset('storage/' . $section->img_path) }}" alt="{{ $section->paragraph }}">
    @endif

    <button class="btn btn-primary expand-form" data-data_item="section{{ $section->id }}">
        <i class="fas fa-pen"></i>
    </button>
</section>
