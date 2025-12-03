<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hero: {{ $hero->name }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    <style>
        /* === BASE VARIABLES === */
        :root { 
            --bg-body: #f3f4f6; 
            --bg-card: #ffffff; 
            --text-main: #1f2937; 
            --border-color: #d1d5db; 
            --input-bg: #ffffff; 
            --input-border: #9ca3af;
            
            /* Light Mode Specifics */
            --header-bg: #e2e8f0;
            --header-text: #374151;
            --hover-item: rgba(0,0,0,0.05);
        }
    
        /* === DARK MODE VARIABLES === */
        html.dark { 
            --bg-body: #050914;       
            --bg-card: #0f172a;       
            --text-main: #ffffff;     
            --border-color: #facc15;  
            --input-bg: #1e293b;      
            --input-border: #64748b;  
            
            /* Dark Mode Specifics */
            --header-bg: #334155;
            --header-text: #facc15;
            --hover-item: rgba(250, 204, 21, 0.2);
        }
    
        body { 
            background-color: var(--bg-body); 
            color: var(--text-main); 
            font-family: 'Poppins', sans-serif; /* FORCE CLEAN FONT EVERYWHERE */
            transition: all 0.3s ease;
        }

        .card { 
            background-color: var(--bg-card); 
            border: 1px solid var(--border-color); 
            border-radius: 12px; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        
        /* HEADINGS (Decorative Font) */
        h4, h5 { 
            font-family: 'Cinzel', serif; 
            font-weight: 800; 
            letter-spacing: 1px; 
            color: var(--text-main);
        }
        html.dark h4, html.dark h5 { 
            color: #facc15; 
            text-shadow: 0 0 10px rgba(250, 204, 21, 0.3); 
        }

        /* LABELS (Clean Font) */
        .form-label { 
            font-family: 'Poppins', sans-serif;
            font-size: 0.75rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            margin-bottom: 8px; 
            color: #4b5563; 
        }
        html.dark .form-label { color: #facc15; }

        /* INPUTS */
        .form-control { 
            background-color: var(--input-bg) !important; 
            border: 2px solid var(--input-border) !important; 
            color: var(--text-main) !important; 
            font-weight: 500;
            border-radius: 8px;
        }
        .form-control:focus { 
            box-shadow: 0 0 0 4px rgba(250, 204, 21, 0.25); 
            border-color: #facc15 !important; 
        }

        /* PICKER BOX */
        .picker-box { 
            background-color: var(--input-bg); 
            border: 2px solid var(--input-border); 
            color: var(--text-main);
            border-radius: 8px; 
            padding: 12px; 
            min-height: 50px; 
            cursor: pointer; 
            display: flex; flex-wrap: wrap; gap: 8px; align-items: center; 
            font-weight: 500;
        }
        html.dark .picker-box { border-color: #facc15; }

        /* DROPDOWN */
        .picker-dropdown { 
            position: absolute; 
            background: var(--bg-card); 
            border: 2px solid var(--border-color); 
            z-index: 1050; width: 100%; max-height: 400px; overflow-y: auto; display: none; 
            border-radius: 8px; margin-top: 5px; padding: 10px; 
            box-shadow: 0 10px 40px rgba(0,0,0,0.5); 
        }
        .picker-dropdown.show { display: block; }

        /* CATEGORY HEADER (FIXED COLORS) */
        .category-header {
            background-color: var(--header-bg);
            color: var(--header-text);
            font-family: 'Cinzel', serif;
            font-weight: 800;
            font-size: 0.7rem;
            padding: 8px 12px;
            border-radius: 4px;
            margin: 12px 0 8px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ITEMS GRID */
        .items-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 8px; }

        .picker-item { 
            text-align: center; padding: 8px; border: 1px solid transparent; border-radius: 6px; cursor: pointer; 
            color: var(--text-main); font-size: 0.7rem; font-weight: 600;
        }
        .picker-item:hover { background-color: var(--hover-item); }
        html.dark .picker-item:hover { border: 1px solid #facc15; }
        
        .picker-item img { width: 40px; height: 40px; object-fit: contain; margin-bottom: 5px; display: block; margin: 0 auto; }
        
        .picker-item.selected { 
            background-color: rgba(250, 204, 21, 0.15); 
            border: 1px solid #facc15; 
            color: #d97706; /* Dark Gold Text */
        }
        html.dark .picker-item.selected { color: #facc15; }

        /* SELECTED BADGE */
        .selected-badge { 
            background: rgba(128, 128, 128, 0.1); border: 1px solid var(--border-color); color: var(--text-main); 
            padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; 
        }
        html.dark .selected-badge { 
            background: rgba(66, 32, 6, 0.5); 
            border-color: #facc15; 
            color: #facc15; 
        }

        /* BUTTONS (FIXED FONT) */
        .btn {
            font-family: 'Poppins', sans-serif !important; 
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            padding: 10px 24px;
        }
        .btn-primary { background-color: #1f2937; color: white; border: none; }
        html.dark .btn-primary { background-color: #facc15; color: #000; }
        html.dark .btn-primary:hover { background-color: #eab308; }

        .btn-secondary { background-color: #9ca3af; color: white; border: none; }
        html.dark .btn-secondary { background-color: #334155; color: #cbd5e1; }

        /* Summernote Fixes */
        html.dark .note-editor { border-color: var(--input-border); }
        html.dark .note-toolbar { background-color: #1e293b; border-bottom: 1px solid #475569; }
        html.dark .note-editing-area { background-color: #0f172a; color: #ffffff; }
        html.dark .note-placeholder { color: #94a3b8; }
        html.dark .note-btn { color: white; background: #334155; }
    </style>
</head>
<body class="py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card mb-5">
                <div class="card-header py-4 px-4 border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="m-0">Edit Hero: {{ $hero->name }}</h4>
                    @if($hero->photo)
                        <img src="{{ asset('storage/' . $hero->photo) }}" class="rounded-circle" width="50" height="50" style="object-fit:cover; border: 2px solid #ca8a04;">
                    @endif
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul></div>
                    @endif

                    <form action="{{ route('heroes.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-5">
                            <div class="col-md-5">
                                <h5 class="mb-3 border-bottom pb-2">Identitas Hero</h5>
                                <div class="mb-3">
                                    <label class="form-label">Nama Hero</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $hero->name) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ganti Foto</label>
                                    <input type="file" name="photo" class="form-control">
                                    <div class="form-text text-muted small">Kosongkan jika tidak ingin mengubah foto.</div>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label class="form-label">Role</label>
                                    <div class="picker-box" id="roleTrigger">Pilih Role...</div>
                                    <div class="picker-dropdown" id="roleDropdown"></div>
                                    <select name="roles[]" id="roleInput" multiple hidden></select>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label class="form-label">Posisi / Lane</label>
                                    <div class="picker-box" id="posTrigger">Pilih Posisi...</div>
                                    <div class="picker-dropdown" id="posDropdown"></div>
                                    <select name="positions[]" id="posInput" multiple hidden></select>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <h5 class="mb-3 border-bottom pb-2">Atribut & Kisah</h5>
                                <div class="mb-3 position-relative">
                                    <label class="form-label">Rekomendasi Build (Max 6)</label>
                                    <div class="picker-box" id="itemTrigger">Pilih Item Build...</div>
                                    <div class="picker-dropdown" id="itemDropdown"></div>
                                    <select name="items[]" id="itemInput" multiple hidden></select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kisah / Lore</label>
                                    <textarea id="summernote" name="story">{{ old('story', $hero->story) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
    // 1. Force Dark Mode if enabled
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    }

    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Tulis legenda hero...', tabsize: 2, height: 300,
            toolbar: [['style',['style']],['font',['bold','underline','clear']],['para',['ul','ol']],['view',['fullscreen']]]
        });

        // 2. Load Master Data from Controller
        const roles = @json($roles ?? []);
        const positions = @json($positions ?? []);
        const items = @json($items ?? []); // Grouped Object
        const baseUrl = "{{ asset('') }}";

        // 3. Load EXISTING Data (Prioritize Old Input, then DB)
        // Note: We use pluck('id') to get simple array of IDs [1, 2, 5]
        const oldRoles = @json(old('roles', $hero->roles->pluck('id')));
        const oldPos = @json(old('positions', $hero->positions->pluck('id')));
        const oldItems = @json(old('items', $hero->items->pluck('id')));

        // 4. Main Logic
        function setupPicker(triggerId, dropdownId, inputId, dataSource, selectedIdsRaw = [], maxSelect = null) {
            const $trigger = $(triggerId);
            const $dropdown = $(dropdownId);
            const $input = $(inputId);
            
            // Ensure all IDs are strings for comparison
            let currentSelection = Array.isArray(selectedIdsRaw) ? selectedIdsRaw.map(String) : [];

            // Helper: Render HTML for one item
            function renderItemHTML(obj) {
                let imgPath = obj.image;
                if (imgPath && !imgPath.startsWith('http')) imgPath = baseUrl + imgPath;
                
                const isSelected = currentSelection.includes(String(obj.id));
                const activeClass = isSelected ? 'selected' : '';

                return `
                    <div class="picker-item ${activeClass}" data-id="${obj.id}" data-name="${obj.name}">
                        ${imgPath ? `<img src="${imgPath}">` : ''}
                        <span>${obj.name}</span>
                    </div>
                `;
            }

            // A. RENDER DROPDOWN CONTENT
            $dropdown.empty();
            if (Array.isArray(dataSource)) {
                // Flat Array (Roles)
                let html = '<div class="items-grid">';
                dataSource.forEach(obj => { html += renderItemHTML(obj); });
                html += '</div>';
                $dropdown.append(html);
            } else {
                // Grouped Object (Items)
                Object.keys(dataSource).forEach(category => {
                    $dropdown.append(`<div class="category-header">${category}</div>`);
                    let html = '<div class="items-grid">';
                    dataSource[category].forEach(obj => { html += renderItemHTML(obj); });
                    html += '</div>';
                    $dropdown.append(html);
                });
            }

            // B. UPDATE UI BASED ON PRE-SELECTED DATA
            updateTriggerUI();

            // C. EVENT HANDLERS
            $trigger.off('click').on('click', function(e) {
                e.stopPropagation();
                $('.picker-dropdown').not($dropdown).removeClass('show');
                $dropdown.toggleClass('show');
            });

            $dropdown.off('click', '.picker-item').on('click', '.picker-item', function(e) {
                e.stopPropagation();
                const id = String($(this).data('id'));

                if (currentSelection.includes(id)) {
                    currentSelection = currentSelection.filter(x => x !== id);
                    $(this).removeClass('selected');
                } else {
                    if (maxSelect && currentSelection.length >= maxSelect) { alert('Maksimal ' + maxSelect + ' item!'); return; }
                    currentSelection.push(id);
                    $(this).addClass('selected');
                }
                updateTriggerUI();
            });

            // D. UPDATE TRIGGER & HIDDEN INPUT
            function updateTriggerUI() {
                $input.empty();
                $trigger.empty();

                if (currentSelection.length === 0) {
                    $trigger.text('Pilih...');
                } else {
                    currentSelection.forEach(selId => {
                        let itemData = null;
                        
                        // Search for the item data based on ID
                        if (Array.isArray(dataSource)) {
                            itemData = dataSource.find(x => String(x.id) === selId);
                        } else {
                            // Search inside groups
                            Object.values(dataSource).forEach(group => {
                                const found = group.find(x => String(x.id) === selId);
                                if (found) itemData = found;
                            });
                        }

                        if (itemData) {
                            // Append Badge to Trigger Box
                            $trigger.append(`<div class="selected-badge">${itemData.name}</div>`);
                            // Append <option selected> to Hidden Select
                            $input.append(`<option value="${itemData.id}" selected>${itemData.id}</option>`);
                        }
                    });
                }
            }
        }

        // 5. Initialize Pickers
        setupPicker('#roleTrigger', '#roleDropdown', '#roleInput', roles, oldRoles);
        setupPicker('#posTrigger', '#posDropdown', '#posInput', positions, oldPos);
        setupPicker('#itemTrigger', '#itemDropdown', '#itemInput', items, oldItems, 6);

        $(document).on('click', function() { $('.picker-dropdown').removeClass('show'); });
    });
</script>
</body>
</html>
