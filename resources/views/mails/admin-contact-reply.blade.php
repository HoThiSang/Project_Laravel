<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Email</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }

        .message {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="message">
            <h2>Hi, {{ $userName }}!</h2>
            <h2>Thank You for Contacting Us!</h2>
            <p>We truly appreciate your interest in our store and products. Your email has been received, and we will get back to you as soon as possible.</p>
            <p></p>
            <h3>Here are the service of our store :</h3>
            <ul>
                <li><strong>Service 1:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                <li><strong>Service 2:</strong> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                <li><strong>Service 3:</strong> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat?</li>
                <li><strong>Service 4:</strong> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
            </ul>
        </div>
    </div>
</body>

</html>

