<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hero - {{ $hero->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single, .select2-selection--multiple {
            min-height: 38px; border: 1px solid #dee2e6;
        }
        .select2-img { width: 20px; height: 20px; object-fit: contain; margin-right: 8px; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Hero: {{ $hero->name }}</h4>
        </div>
        <div class="card-body p-4">
            
            <form action="{{ route('heroes.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="mb-3">
                    <label class="form-label fw-bold">Nama Hero</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $hero->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Ganti Foto (Opsional)</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $hero->photo) }}" width="100" class="rounded border">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Roles</label>
                    <select name="roles[]" class="form-control select2-img-dropdown" multiple="multiple" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" data-image="{{ asset($role->image) }}"
                                {{ $hero->roles->contains($role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Lane / Position</label>
                    <select name="positions[]" class="form-control select2-img-dropdown" multiple="multiple" required>
                        @foreach($positions as $pos)
                            <option value="{{ $pos->id }}" data-image="{{ asset($pos->image) }}"
                                {{ $hero->positions->contains($pos->id) ? 'selected' : '' }}>
                                {{ $pos->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Build Items (Maksimal 6)</label>
                    <select name="items[]" id="itemSelector" class="form-control select2-img-dropdown" multiple="multiple" required>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" data-image="{{ asset($item->image) }}"
                                {{ $hero->items->contains($item->id) ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Story / Lore</label>
                    <textarea name="story" id="summernote" required>{{ old('story', $hero->story) }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning w-100">Update Hero</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({ height: 200 });

        function formatState (opt) {
            if (!opt.id) { return opt.text; }
            var imageUrl = $(opt.element).data('image'); 
            if(!imageUrl){ return opt.text; } 
            return $('<span><img src="' + imageUrl + '" class="select2-img" /> ' + opt.text + '</span>');
        };

        $('.select2-img-dropdown').select2({
            width: '100%',
            templateResult: formatState,
            templateSelection: formatState
        });

        $('#itemSelector').select2({
            width: '100%',
            maximumSelectionLength: 6,
            templateResult: formatState,
            templateSelection: formatState
        });
    });
</script>

</body>
</html>
