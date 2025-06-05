<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SEO Manager - Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            padding: 40px;
            background: #f8f9fa;
        }
        .seo-box {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 0 10px rgba(0,0,0,.05);
        }
        .form-label {
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="seo-box">
        <h4 class="mb-4"><i class="bi bi-globe"></i> Configuración SEO por página</h4>
        <form method="POST" action="{{ route('seo.save') }}">
            @csrf
            <div class="mb-3">
                <label for="slug" class="form-label">Slug de la página</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $slug ?? '') }}" placeholder="ej: nosotros, contacto" required>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Meta Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $seo['title'] ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Meta Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $seo['description'] ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="keywords" class="form-label">Keywords</label>
                <input type="text" name="keywords" id="keywords" class="form-control" value="{{ old('keywords', $seo['keywords'] ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="canonical" class="form-label">Canonical URL</label>
                <input type="text" name="canonical" id="canonical" class="form-control" value="{{ old('canonical', $seo['canonical'] ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="robots" class="form-label">Meta Robots</label>
                <select name="robots" id="robots" class="form-select">
                    <option value="">-- Seleccionar --</option>
                    <option value="index, follow" {{ (old('robots', $seo['robots'] ?? '') == 'index, follow') ? 'selected' : '' }}>index, follow</option>
                    <option value="noindex, follow" {{ (old('robots', $seo['robots'] ?? '') == 'noindex, follow') ? 'selected' : '' }}>noindex, follow</option>
                    <option value="noindex, nofollow" {{ (old('robots', $seo['robots'] ?? '') == 'noindex, nofollow') ? 'selected' : '' }}>noindex, nofollow</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="og_title" class="form-label">OG Title (Facebook)</label>
                <input type="text" name="og_title" id="og_title" class="form-control" value="{{ old('og_title', $seo['og_title'] ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="og_description" class="form-label">OG Description</label>
                <textarea name="og_description" id="og_description" class="form-control" rows="2">{{ old('og_description', $seo['og_description'] ?? '') }}</textarea>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar SEO</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
