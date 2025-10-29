<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome Email</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; padding: 20px; border-radius: 5px; }
        h1 { color: #333; }
        p { line-height: 1.6; }
        .button { display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .details { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Vita!</h1>

        <p>Hello {{ $user->name }},</p>

        <p>Thank you for registering with our appointment system. Your account has been successfully created.</p>

        <div class="details">
            <strong>Your registration details:</strong><br>
            - <strong>Name:</strong> {{ $user->name }} {{ $user->last_name }}<br>
            - <strong>Email:</strong> {{ $user->email }}<br>
            - <strong>Role:</strong> {{ ucfirst($user->role) }}
        </div>

        <p>You can now log in to your account and start using our services.</p>

        <p><a href="http://localhost:3000" class="button">Login to Your Account</a></p>

        <p>If you have any questions, please don't hesitate to contact our support team.</p>

        <p>Thanks,<br>
        {{ config('app.name') }} Team</p>
    </div>
</body>
</html>
