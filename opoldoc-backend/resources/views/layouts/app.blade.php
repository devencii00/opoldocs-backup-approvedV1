<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') — Opol Doctors Clinic</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;500;600&display=swap">
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .scrollbar-hidden {
            scrollbar-width: none;
        }

        .scrollbar-hidden::-webkit-scrollbar {
            width: 0;
            height: 0;
        }
    </style>
</head>
<body class="font-sans min-h-screen bg-slate-100 text-slate-800 [background-image:radial-gradient(ellipse_at_80%_0%,rgba(6,182,212,0.06)_0%,transparent_55%)]">

    @yield('body')

    <script>
        window.apiFetch = function (path, options) {
            var token = null
            try {
                if (window.localStorage) {
                    token = window.localStorage.getItem('api_token')
                }
            } catch (e) {
                token = null
            }

            var baseOptions = options || {}
            var headers = baseOptions.headers ? Object.assign({}, baseOptions.headers) : {}

            if (token) {
                headers['Authorization'] = 'Bearer ' + token
            }

            if (!headers['Accept']) {
                headers['Accept'] = 'application/json'
            }

            return fetch(path, Object.assign({}, baseOptions, { headers: headers }))
        }
    </script>

</body>
</html>
