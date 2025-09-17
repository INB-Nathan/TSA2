<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration</title>
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
            width: 500px;
            margin: 100px auto;
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
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type=submit],
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

        input[type=submit]:hover,
        button:hover {
            background: #218838;
        }

        label[for="terms"] {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        input[type="checkbox"] {
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Registration</h1>
        <form action="<?= site_url('register/submit') ?>" method="post">
            <label>First Name:</label>
            <input type="text" name="first_name" required>
            <br>
            <label>Last Name:</label>
            <input type="text" name="last_name" required>
            <br>
            <label>Email:</label>
            <input type="email" name="email" required>
            <br>
            <label>Password:</label>
            <input type="password" name="password" required>
            <br>
            <label for="terms">
                <input type="checkbox" name="terms" id="terms" required>
                I agree to the <a href="#">privacy policy</a>
            </label>
            <br>
            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>