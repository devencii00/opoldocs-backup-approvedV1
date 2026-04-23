<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Admin Credentials</title>
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
        <h1 class="font-playfair text-2xl font-bold text-slate-900 mb-1">Update admin credentials</h1>
        <p class="text-xs text-slate-500 mb-4">For security, please update the default administrator email and/or password.</p>

        <div id="errorBox" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700"></div>
        <div id="successBox" class="hidden mb-3 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs text-emerald-700"></div>

        <form id="firstLoginForm" class="space-y-3">
            <div>
                <label for="new_email" class="block text-xs text-slate-600 mb-1">New email (optional)</label>
                <input type="email" id="new_email" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
            </div>
            <div class="relative">
                <label for="new_password" class="block text-xs text-slate-600 mb-1">New password (optional)</label>
                <input type="password" id="new_password" class="w-full pr-10 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <button type="button" id="toggleNewPassword" class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-slate-600 text-xl">
                    <span id="toggleNewPasswordIcon" class="material-symbols-outlined text-[20px] leading-none">visibility</span>
                </button>
            </div>
            <div>
                <label for="new_password_confirmation" class="block text-xs text-slate-600 mb-1">Confirm new password</label>
                <input type="password" id="new_password_confirmation" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
            </div>
            <button type="submit" class="w-full mt-2 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-cyan-700 text-white text-sm font-semibold hover:from-cyan-600 hover:to-cyan-800 transition-colors">
                Save and continue
            </button>
        </form>
    </div>

    <script>
        function apiFetch(path, options = {}) {
            const token = window.localStorage ? window.localStorage.getItem('api_token') : null;
            const headers = options.headers ? {...options.headers} : {};
            if (token) {
                headers['Authorization'] = 'Bearer ' + token;
            }
            if (!headers['Accept']) {
                headers['Accept'] = 'application/json';
            }
            return fetch(path, {...options, headers});
        }

        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) {
                return;
            }
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            icon.textContent = isPassword ? 'visibility_off' : 'visibility';
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('firstLoginForm');
            const errorBox = document.getElementById('errorBox');
            const successBox = document.getElementById('successBox');
            const newEmailInput = document.getElementById('new_email');
            const newPasswordInput = document.getElementById('new_password');
            const newPasswordConfirmInput = document.getElementById('new_password_confirmation');
            const toggleNewPassword = document.getElementById('toggleNewPassword');

            if (toggleNewPassword) {
                toggleNewPassword.addEventListener('click', function () {
                    togglePasswordVisibility('new_password', 'toggleNewPasswordIcon');
                });
            }

            if (!form) {
                return;
            }

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                if (errorBox) {
                    errorBox.classList.add('hidden');
                    errorBox.textContent = '';
                }
                if (successBox) {
                    successBox.classList.add('hidden');
                    successBox.textContent = '';
                }

                const body = {};

                if (newEmailInput && newEmailInput.value) {
                    body.email = newEmailInput.value;
                }

                if (newPasswordInput && newPasswordInput.value) {
                    if (!newPasswordConfirmInput || newPasswordInput.value !== newPasswordConfirmInput.value) {
                        if (errorBox) {
                            errorBox.textContent = 'Passwords do not match.';
                            errorBox.classList.remove('hidden');
                        }
                        return;
                    }
                    body.password = newPasswordInput.value;
                }

                if (!body.email && !body.password) {
                    if (errorBox) {
                        errorBox.textContent = 'Please change the email and/or password.';
                        errorBox.classList.remove('hidden');
                    }
                    return;
                }

                body.must_change_credentials = false;

                let userId = null;
                try {
                    userId = window.localStorage ? window.localStorage.getItem('current_user_id') : null;
                } catch (_) {
                    userId = null;
                }

                if (!userId) {
                    if (errorBox) {
                        errorBox.textContent = 'User information is missing. Please sign in again.';
                        errorBox.classList.remove('hidden');
                    }
                    return;
                }

                try {
                    const response = await apiFetch("{{ url('/api/users') }}/" + userId, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(body),
                    });

                    let data = {};

                    try {
                        data = await response.json();
                    } catch (_) {
                        data = {};
                    }

                    if (!response.ok) {
                        const message = data.message || 'Failed to update credentials.';
                        if (errorBox) {
                            errorBox.textContent = message;
                            errorBox.classList.remove('hidden');
                        }
                        return;
                    }

                    if (successBox) {
                        successBox.textContent = 'Credentials updated. Redirecting to dashboard.';
                        successBox.classList.remove('hidden');
                    }

                    let role = 'admin';

                    if (data.current_role && data.current_role.role_name) {
                        role = String(data.current_role.role_name).toLowerCase();
                    }

                    setTimeout(function () {
                        window.location.href = "{{ url('/dashboard') }}/" + role;
                    }, 1000);
                } catch (_) {
                    if (errorBox) {
                        errorBox.textContent = 'Network error. Please try again.';
                        errorBox.classList.remove('hidden');
                    }
                }
            });
        });
    </script>
</body>
</html>
