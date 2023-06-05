<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div>
    <h4>Ride Cancellation Notification</h4>
  </div>
  <p>
    Dear Umar,
    <br>
    @php
    use Carbon\Carbon;
    $currentDateTime = Carbon::now();
    $formattedDate = $currentDateTime->format('D, F j, Y');
    $bookingDate = Carbon::parse($booking->details->pickup_date)->toDateString();
    @endphp
    We would like to inform you that a customer has canceled on <b>{{$formattedDate}}</b> their ride scheduled for <b>{{ $booking->id }}</b> on <b>{{ $bookingDate }} {{ $booking->details->pickup_time }}</b>.
    <br>
    Please take note of this cancellation and update any necessary records accordingly.
    <br>
    Thank you for your attention.
    <br>
    Best regards,
    <br>
    LightWaterLimo

  </p>
</body>
</html>