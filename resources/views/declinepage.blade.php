<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Declined</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffebee;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 40px 0;
            background-color:rgba(255, 0, 0, 0.8)
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h1 {
            font-weight: 700;
            color: #d32f2f;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 400;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #c62828;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Request Successfully Declined</h1>
        <p>The notification email regarding the declined request has been sent to the applicant.</p>
        <a href="{{ route(user.dashboard, ['userId' => $userId]) }}" class="button">Return to Dashboard</a>
    </div>
</body>
</html>
