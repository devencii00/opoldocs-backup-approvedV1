<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>First Login – Update Password</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;600&display=swap">
    <style>
        .font-playfair { font-family: 'Playfair Display', serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-100 p-4 font-sans">
    <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
        <h1 class="font-playfair text-2xl font-bold text-slate-900 mb-1">Set a new password</h1>
        <p class="text-xs text-slate-500 mb-4">
            For security, please change the temporary password you received. Your email is already set.
        </p>

        <div id="staffFirstLoginError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700"></div>
        <div id="staffFirstLoginSuccess" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs text-emerald-700"></div>

        <form id="staffFirstLoginForm" class="space-y-3">
            <div class="relative">
                <label for="staff_new_password" class="block text-xs text-slate-600 mb-1">New password</label>
                <input type="password" id="staff_new_password" class="w-full pr-10 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <button type="button" id="staffTogglePassword" class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-slate-600 text-xl">
                    <span id="staffTogglePasswordIcon" class="material-symbols-outlined text-[20px] leading-none">visibility</span>
                </button>
            </div>
            <div>
                <label for="staff_new_password_confirmation" class="block text-xs text-slate-600 mb-1">Confirm new password</label>
                <input type="password" id="staff_new_password_confirmation" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
            </div>
            <button type="submit" class="w-full mt-2 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-cyan-700 text-white text-sm font-semibold hover:from-cyan-600 hover:to-cyan-800 transition-colors">
                Save and continue
            </button>
        </form>
    </div>

    <script>
        function staffApiFetch(path, options) {
            var token = null
            try {
                token = window.localStorage ? window.localStorage.getItem('api_token') : null
            } catch (_) {
                token = null
            }
            var headers = (options && options.headers) ? Object.assign({}, options.headers) : {}
            if (token) {
                headers['Authorization'] = 'Bearer ' + token
            }
            if (!headers['Accept']) {
                headers['Accept'] = 'application/json'
            }
            return fetch(path, Object.assign({}, options, { headers: headers }))
        }

        function togglePasswordVisibility(inputId, iconId) {
            var input = document.getElementById(inputId)
            var icon = document.getElementById(iconId)
            if (!input || !icon) {
                return
            }
            var isPassword = input.type === 'password'
            input.type = isPassword ? 'text' : 'password'
            icon.textContent = isPassword ? 'visibility_off' : 'visibility'
        }

        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('staffFirstLoginForm')
            var errorBox = document.getElementById('staffFirstLoginError')
            var successBox = document.getElementById('staffFirstLoginSuccess')
            var newPasswordInput = document.getElementById('staff_new_password')
            var confirmInput = document.getElementById('staff_new_password_confirmation')
            var toggleBtn = document.getElementById('staffTogglePassword')

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    togglePasswordVisibility('staff_new_password', 'staffTogglePasswordIcon')
                })
            }

            if (!form) {
                return
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault()

                if (errorBox) {
                    errorBox.classList.add('hidden')
                    errorBox.textContent = ''
                }
                if (successBox) {
                    successBox.classList.add('hidden')
                    successBox.textContent = ''
                }

                var password = newPasswordInput ? newPasswordInput.value : ''
                var confirm = confirmInput ? confirmInput.value : ''

                if (!password || !confirm) {
                    if (errorBox) {
                        errorBox.textContent = 'Please enter and confirm your new password.'
                        errorBox.classList.remove('hidden')
                    }
                    return
                }

                if (password !== confirm) {
                    if (errorBox) {
                        errorBox.textContent = 'Passwords do not match.'
                        errorBox.classList.remove('hidden')
                    }
                    return
                }

                var userId = null
                try {
                    userId = window.localStorage ? window.localStorage.getItem('current_user_id') : null
                } catch (_) {
                    userId = null
                }

                if (!userId) {
                    if (errorBox) {
                        errorBox.textContent = 'User information is missing. Please sign in again.'
                        errorBox.classList.remove('hidden')
                    }
                    return
                }

                staffApiFetch("{{ url('/api/users') }}/" + userId, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        password: password,
                        must_change_credentials: false
                    })
                })
                    .then(function (response) {
                        return response.json().then(function (data) {
                            return { ok: response.ok, data: data }
                        })
                    })
                    .then(function (result) {
                        if (!result.ok) {
                            if (errorBox) {
                                var message = result.data && result.data.message ? result.data.message : 'Failed to update password.'
                                errorBox.textContent = message
                                errorBox.classList.remove('hidden')
                            }
                            return
                        }

                        if (successBox) {
                            successBox.textContent = 'Password updated. Redirecting to dashboard...'
                            successBox.classList.remove('hidden')
                        }

                        var role = 'admin'

                        if (result.data && result.data.current_role && result.data.current_role.role_name) {
                            role = String(result.data.current_role.role_name).toLowerCase()
                        }

                        setTimeout(function () {
                            window.location.href = "{{ url('/dashboard') }}/" + role
                        }, 1000)
                    })
                    .catch(function () {
                        if (errorBox) {
                            errorBox.textContent = 'Network error while updating password.'
                            errorBox.classList.remove('hidden')
                        }
                    })
            })
        })
    </script>
</body>
</html>
