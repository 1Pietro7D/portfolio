<form action="{{ route('admin.sections.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="sect_title">Section Title:</label>
        <input type="text" id="sect_title" name="title" maxlength="40" required value="{{ old('title', '') }}" />
    </div>
    <div>
        <label for="paragraph">Paragraph:</label>
        <input required maxlength="2000" type="text" required name="paragraph" value="{{ old('paragraph', '') }}" />
    </div>
    <div>
        <label for="sect_img">Img:</label>
        <input type="file" id="sect_img" name="img_path" />
    </div>

    <div>
        <input type="submit" value="Create">
    </div>
</form>
