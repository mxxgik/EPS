<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appointment Confirmation</title>
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
        <h1>Appointment Confirmation</h1>

        <p>Hello {{ $appointment->patient->name }} {{ $appointment->patient->last_name }},</p>

        <p>Your appointment has been successfully scheduled. Here are the details:</p>

        <div class="details">
            <strong>Appointment Details:</strong><br>
            - <strong>Date & Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('F j, Y \a\t g:i A') }}<br>
            - <strong>Doctor:</strong> {{ $appointment->user->name }} {{ $appointment->user->last_name }}<br>
            - <strong>Reason:</strong> {{ $appointment->reason }}<br>
            - <strong>Status:</strong> {{ ucfirst($appointment->status) }}
        </div>

        <p>Please arrive 15 minutes early for your appointment. If you need to reschedule or cancel, please contact us as soon as possible.</p>

        <p>If you have any questions, please don't hesitate to contact our support team.</p>

        <p>Thanks,<br>
        {{ config('app.name') }} Team</p>
    </div>
</body>
</html>