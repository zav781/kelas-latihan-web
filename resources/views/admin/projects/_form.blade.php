@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label class="form-label">Gambar</label>
    <div class="mb-2">
        <img id="preview"
            src="{{ !empty($project?->images) ? asset('image/' . $project->images) : '' }}"
            alt="Preview" class="img-thumbnail {{ empty($project?->images) ? 'd-none' : '' }}"
            style="width: 300px; object-fit: cover;">
    </div>
    <input type="file" name="image" id="image" accept="image/*"
        class="form-control @error('image') is-invalid @enderror">
    @if (!empty($project?->images))
        <div class="form-text">Kosongkan jika tidak ingin mengganti gambar.</div>
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $project->title ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4"
        class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Teknologi</label>
    <input type="text" name="teknologi" placeholder="Laravel & Bootstrap"
        class="form-control @error('teknologi') is-invalid @enderror"
        value="{{ old('teknologi', $project->teknologi ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select @error('status') is-invalid @enderror">
        @foreach ($statuses as $status)
            <option value="{{ $status }}" @selected(old('status', $project->status ?? 'Selesai') === $status)>
                {{ $status }}
            </option>
        @endforeach
    </select>
</div>

<a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Kembali</a>
<button type="submit" class="btn btn-primary">Simpan</button>

@push('scripts')
    <script>
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            }
        });
    </script>
@endpush
