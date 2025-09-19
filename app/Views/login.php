<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: whitesmoke;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 400px;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #aaa;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            border: none;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #218838;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
        }

        .error {
            color: #b94a48;
            background: #f2dede;
        }

        .success {
            color: #155724;
            background: #d4edda;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Login</h1>

        <!-- Flash messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="message error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="message success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>

        <form action="<?= site_url('login/authenticate') ?>" method="post">
            <?= csrf_field() ?>

            <label>Email:</label>
            <input type="text" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <div style="margin-top:15px; font-size:14px; text-align:center;">
            <a href="<?= site_url('register') ?>">Don’t have an account? Register</a>
        </div>
    </div>
</body>

</html>
