<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9; /* light green background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .dashboard-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 350px;
        }
        h2 {
            color: #2e7d32; /* dark green */
            margin-bottom: 15px;
        }
        p {
            margin: 8px 0;
            color: #555;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4caf50; /* green button */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        a:hover {
            background-color: #388e3c; /* darker green on hover */
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?= esc(session()->get('full_name')) ?>!</h2>
        <p>Your email: <?= esc(session()->get('email')) ?></p>
        <a href="<?= site_url('logout') ?>">Logout</a>
    </div>
</body>
</html>
