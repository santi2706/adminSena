<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear área</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            padding: 32px 16px;
            display: grid;
            place-items: center;
            background: #f3f6f4;
            color: #1f2933;
            font-family: Arial, sans-serif;
        }
        main {
            width: min(100%, 520px);
            padding: 32px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 8px 28px rgba(20, 50, 35, .1);
        }
        h1 { margin: 0 0 8px; color: #166534; }
        p { color: #52616b; line-height: 1.5; }
        label { display: block; margin: 20px 0 8px; font-weight: 700; }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5d1;
            border-radius: 7px;
        }
        button {
            width: 100%;
            margin-top: 24px;
            padding: 13px;
            border: 0;
            border-radius: 7px;
            background: #15803d;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }
        button:hover { background: #166534; }
        .message, .error {
            margin-top: 16px;
            padding: 12px;
            border-radius: 7px;
        }
        .message { background: #ecfdf3; color: #166534; }
        .error { background: #fef2f2; color: #b91c1c; }
        .preview {
            display: block;
            max-width: 100%;
            max-height: 260px;
            margin-top: 12px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <main>
        <h1>Crear área</h1>
        <p>Escribe el nombre y selecciona una imagen de tu computador. La imagen se guardará en Cloudinary.</p>

        @if (session('createdArea'))
            <div class="message">
                Área "{{ session('createdArea')->name }}" creada correctamente.
                <img
                    class="preview"
                    src="{{ session('createdArea')->imagen_url }}"
                    alt="Imagen del área {{ session('createdArea')->name }}"
                >
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('web.areas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">Nombre del área</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                maxlength="255"
                required
            >

            <label for="imagen">Imagen</label>
            <input
                id="imagen"
                name="imagen"
                type="file"
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                required
            >

            <button type="submit">Crear área</button>
        </form>
    </main>
</body>
</html>
