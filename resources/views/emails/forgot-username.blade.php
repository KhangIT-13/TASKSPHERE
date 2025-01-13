<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Username Recovery</title>
</head>

<body>
    <!-- resources/views/emails/forgot-username.blade.php -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <p>Hello,</p>
    <p>You requested your username. Here is your username:</p>
    <p><strong>{{ $user->FullName }}</strong></p>
    <p>If you didn't request this, please ignore this email.</p>

</body>

</html>
