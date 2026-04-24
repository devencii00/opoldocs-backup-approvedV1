<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Staff account details</title>
</head>
<body>
    <p>Hello,</p>
    <p>An administrator has created a staff account for you in the Opol Clinic system.</p>
    <p>
        Email: {{ $user->email }}<br>
        Temporary password: {{ $plainPassword }}
    </p>
    <p>
        For security, please sign in as soon as possible and update your password when prompted on first login.
    </p>
</body>
</html>

