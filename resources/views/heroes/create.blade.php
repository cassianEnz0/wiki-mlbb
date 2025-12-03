<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Hero Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>

        body { background-color: #f3f4f6; color: #1f2937; font-family: 'Poppins', sans-serif; }
        h4, h5 { font-family: 'Cinzel', serif; color: #111827; letter-spacing: 1px; font-weight: 800; }
        .card { background: #ffffff; border: none; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .card-header { background: transparent; border-bottom: 2px solid #e5e7eb; padding: 25px; }
        .form-control, .form-select { background-color: #f9fafb !important; border: 1px solid #d1d5db !important; color: #111827 !important; padding: 12px; border-radius: 8px; height: 50px !important; }
        .form-control:focus { background-color: #ffffff !important; border-color: #111827 !important; box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1); }
        input[type="file"].form-control { height: auto !important; }
        label { color: #4b5563; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block; }
        

        .item-picker-container { position: relative; width: 100%; }
        .item-picker-trigger {
            background-color: #f9fafb; border: 1px solid #d1d5db; border-radius: 8px; min-height: 50px;
            padding: 8px; display: flex; flex-wrap: wrap; gap: 8px; cursor: pointer; align-items: center;
        }
        .item-picker-trigger:hover { border-color: #9ca3af; }
        .item-picker-dropdown {
            display: none; position: absolute; top: 105%; left: 0; width: 600px; /* Lebar dropdown */
            background: white; border: 1px solid #d1d5db; border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            z-index: 1050; overflow: hidden; height: 320px; /* Tinggi Fix */
        }
        .item-picker-dropdown.active { display: flex; }
        

        .picker-categories { width: 30%; background: #f3f4f6; border-right: 1px solid #e5e7eb; overflow-y: auto; }
        .cat-item { padding: 12px 16px; cursor: pointer; font-weight: 600; font-size: 0.85rem; color: #4b5563; transition: all 0.2s; border-left: 3px solid transparent; }
        .cat-item::first-letter {text-transform: uppercase;}
        .cat-item:hover { background: #e5e7eb; color: #111827; }
        .cat-item.active { background: white; color: #2563eb; border-left-color: #2563eb; }


        .picker-items { width: 70%; padding: 16px; overflow-y: auto; display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; align-content: start; }
        .item-card { 
            border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px; text-align: center; cursor: pointer; transition: all 0.2s; position: relative;
        }
        .item-card:hover { border-color: #2563eb; transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .item-card.selected { background-color: #eff6ff; border-color: #2563eb; }
        .item-card img { width: 32px; height: 32px; object-fit: contain; margin-bottom: 6px; }
        .item-card span { display: block; font-size: 0.7rem; line-height: 1.2; font-weight: 600; color: #374151; }
        

        .selected-badge {
            background: #fff; border: 1px solid #d1d5db; border-radius: 6px; padding: 4px 10px 4px 6px;
            font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;
        }
        .selected-badge img { width: 20px; height: 20px; object-fit: contain; border-radius: 4px; }
        .remove-item { color: #ef4444; cursor: pointer; font-weight: bold; font-size: 1rem; line-height: 1; }
        .remove-item:hover { color: #dc2626; }
        .placeholder-text { color: #9ca3af; font-style: italic; font-size: 0.9rem; margin-left: 8px; }

        .btn-primary { background-color: #111827; border: none; font-weight: bold; padding: 10px 24px; border-radius: 8px; }
        .btn-outline-secondary { color: #4b5563; border-color: #d1d5db; padding: 10px 24px; border-radius: 8px; }


        .picker-no-cat .picker-categories { display: none !important; }
        .picker-no-cat .picker-items { width: 100% !important; }
    </style>
</head>
<body class="py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header"><h4>Buat Hero Baru</h4></div>
                <div class="card-body p-5">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4"><ul class="mb-0 small">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul></div>
                    @endif

                    <form action="{{ route('heroes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-5">
                            <div class="col-md-5">
                                <h5 class="mb-4 border-bottom pb-2">Identitas Hero</h5>
                                <div class="mb-4"><label>Nama Hero</label><input type="text" name="name" class="form-control" required></div>
                                <div class="mb-4"><label>Foto Potret</label><input type="file" name="photo" class="form-control" accept="image/*" required></div>
                                
                                <div class="mb-4">
                                    <label>Role</label>
                                    <div class="item-picker-container picker-no-cat" id="rolePicker">
                                        <div class="item-picker-trigger" id="roleTrigger">
                                            <span class="placeholder-text">Pilih Role...</span>
                                        </div>
                                        <div class="item-picker-dropdown" id="roleDropdown">
                                            <div class="picker-categories"></div>
                                            <div class="picker-items" id="roleItemsContainer"></div>
                                        </div>
                                    </div>
                                    <select name="roles[]" id="realRoleInput" multiple hidden required></select>
                                </div>

                                <div class="mb-4">
                                    <label>Posisi</label>
                                    <div class="item-picker-container picker-no-cat" id="posPicker">
                                        <div class="item-picker-trigger" id="posTrigger">
                                            <span class="placeholder-text">Pilih Posisi...</span>
                                        </div>
                                        <div class="item-picker-dropdown" id="posDropdown">
                                            <div class="picker-categories"></div>
                                            <div class="picker-items" id="posItemsContainer"></div>
                                        </div>
                                    </div>
                                    <select name="positions[]" id="realPosInput" multiple hidden required></select>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <h5 class="mb-4 border-bottom pb-2">Atribut & Kisah</h5>

                                <div class="mb-4">
                                    <label>Rekomendasi Build (Maksimal 6)</label>
                                    <div class="item-picker-container" id="itemPicker">
                                        <div class="item-picker-trigger" id="pickerTrigger">
                                            <span class="placeholder-text">Klik untuk pilih item...</span>
                                        </div>
                                        <div class="item-picker-dropdown" id="pickerDropdown">
                                            <div class="picker-categories" id="pickerCategories"></div>
                                            <div class="picker-items" id="pickerItems"></div>
                                        </div>
                                    </div>
                                    <select name="items[]" id="realItemInput" multiple hidden required></select>
                                </div>

                                <div class="mb-4"><label>Kisah / Lore</label><textarea name="story" id="summernote" required></textarea></div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-5 pt-4 border-top justify-content-end">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Hero</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Tulis legenda hero disini...', tabsize: 2, height: 350,
            toolbar: [['style',['style']],['font',['bold','underline','clear']],['para',['ul','ol']]]
        });

        function setupPicker(config) {
            const { data, selectedData, triggerEl, dropdownEl, itemContainerEl, inputEl, hasCategories, maxLimit } = config;
            let currentSelection = selectedData || [];

            updateTrigger();

            if (hasCategories) {
                const catContainer = dropdownEl.find('.picker-categories');
                let firstCat = null;
                Object.keys(data).forEach((cat, idx) => {
                    if(idx===0) firstCat = cat;
                    catContainer.append(`<div class="cat-item ${idx===0?'active':''}" data-cat="${cat}">${cat}</div>`);
                });
                dropdownEl.data('render', function(catName) {
                    itemContainerEl.empty();
                    if(data[catName]) data[catName].forEach(item => appendItemCard(item));
                });
                dropdownEl.data('render')(firstCat);
                dropdownEl.on('click', '.cat-item', function() {
                    dropdownEl.find('.cat-item').removeClass('active');
                    $(this).addClass('active');
                    dropdownEl.data('render')($(this).data('cat'));
                });
            } else {
                itemContainerEl.empty();
                data.forEach(item => appendItemCard(item));
            }

            function appendItemCard(item) {
                const isSelected = currentSelection.find(i => i.id == item.id);
                const activeClass = isSelected ? 'selected' : '';
                itemContainerEl.append(`
                    <div class="item-card ${activeClass}" data-id="${item.id}" data-name="${item.name}" data-img="${item.image}">
                        <img src="{{ asset('') }}${item.image}">
                        <span>${item.name}</span>
                    </div>
                `);
            }

            function updateTrigger() {
                triggerEl.empty();
                inputEl.empty();
                if (currentSelection.length === 0) {
                    triggerEl.html('<span class="placeholder-text">Klik untuk pilih...</span>');
                } else {
                    currentSelection.forEach(item => {
                        triggerEl.append(`
                            <div class="selected-badge">
                                <img src="{{ asset('') }}${item.img}"> ${item.name}
                                <span class="remove-item" data-id="${item.id}">&times;</span>
                            </div>
                        `);
                        inputEl.append(`<option value="${item.id}" selected>${item.name}</option>`);
                    });
                }
            }

            triggerEl.on('click', function(e) {
                if(!$(e.target).hasClass('remove-item')) {
                    $('.item-picker-dropdown').not(dropdownEl).removeClass('active');
                    dropdownEl.toggleClass('active');
                }
            });

            dropdownEl.on('click', '.item-card', function(e) {
                e.stopPropagation();
                const id = $(this).data('id');
                const name = $(this).data('name');
                const img = $(this).data('img');
                const index = currentSelection.findIndex(i => i.id == id);

                if (index > -1) {
                    currentSelection.splice(index, 1);
                    $(this).removeClass('selected');
                } else {
                    if (maxLimit && currentSelection.length >= maxLimit) { alert('Maksimal ' + maxLimit + ' pilihan!'); return; }
                    currentSelection.push({ id, name, img });
                    $(this).addClass('selected');
                }
                updateTrigger();
                if (maxLimit && currentSelection.length >= maxLimit) dropdownEl.removeClass('active');
            });

            triggerEl.on('click', '.remove-item', function(e) {
                e.stopPropagation();
                const id = $(this).data('id');
                currentSelection = currentSelection.filter(i => i.id != id);
                updateTrigger();
                dropdownEl.find(`.item-card[data-id="${id}"]`).removeClass('selected');
            });
        }

        const itemsData = @json($items);
        let selectedItems = [];
        try { @if(isset($hero)) selectedItems = @json($hero->items->map(fn($i) => ['id'=>$i->id, 'name'=>$i->name, 'img'=>$i->image])); @endif } catch(e){}
        
        setupPicker({
            data: itemsData, selectedData: selectedItems,
            triggerEl: $('#pickerTrigger'), dropdownEl: $('#pickerDropdown'), itemContainerEl: $('#pickerItems'), inputEl: $('#realItemInput'),
            hasCategories: true, maxLimit: 6
        });

        const rolesData = @json($roles);
        let selectedRoles = [];
        try { @if(isset($hero)) selectedRoles = @json($hero->roles->map(fn($r) => ['id'=>$r->id, 'name'=>$r->name, 'img'=>$r->image])); @endif } catch(e){}

        setupPicker({
            data: rolesData, selectedData: selectedRoles,
            triggerEl: $('#roleTrigger'), dropdownEl: $('#roleDropdown'), itemContainerEl: $('#roleItemsContainer'), inputEl: $('#realRoleInput'),
            hasCategories: false, maxLimit: null 
        });

        const posData = @json($positions);
        let selectedPos = [];
        try { @if(isset($hero)) selectedPos = @json($hero->positions->map(fn($p) => ['id'=>$p->id, 'name'=>$p->name, 'img'=>$p->image])); @endif } catch(e){}

        setupPicker({
            data: posData, selectedData: selectedPos,
            triggerEl: $('#posTrigger'), dropdownEl: $('#posDropdown'), itemContainerEl: $('#posItemsContainer'), inputEl: $('#realPosInput'),
            hasCategories: false, maxLimit: null
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.item-picker-container').length) $('.item-picker-dropdown').removeClass('active');
        });
    });
</script>
</body>
</html>