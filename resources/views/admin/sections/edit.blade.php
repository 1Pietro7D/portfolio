<div class="form-up-section d-none" id="section{{ $section->id }}">
    {{-- EDIT --}}
    <form action="{{ route('admin.sections.update', $section->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div>
            <label for="sect_title">Section Title:</label>
            <input type="text" id="sect_title" name="title" maxlength="40" required
                value="{{ old('title', $section->title) }}" />
        </div>
        <div>
            <label for="paragraph">Paragraph:</label>
            <input required maxlength="2000" type="text" required name="paragraph"
                value="{{ old('paragraph', $section->paragraph) }}" />
        </div>
        <div>
            <label for="sect_img">Img:</label>
            <input type="file" id="sect_img" name="img_path" />
        </div>

        <button class="btn btn-primary">
            <input type="submit" value="Update">
        </button>
    </form>

    {{-- DELETE --}}
    <div>
        <form method="POST" action="{{ route('admin.sections.destroy', $section->slug) }}">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Do you really want to delete this section?')" type="submit"
                class="btn btn-danger">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
    </div>
</div>
