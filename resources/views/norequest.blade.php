<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Requests</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 40px 0;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        h1 {
            font-weight: 300;
            color: #000;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            color: #666;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #000000;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 400;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>No Requests Available</h1>
        <p>Currently, there are no requests for your data. Check back later or explore other options.</p>
        <a href="{{ route('user.dashboard', ['userId' => $userId]) }}" class="button">Go to Dashboard</a>
    </div>
</body>
</html>
