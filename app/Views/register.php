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
        <?php $errors = session('errors'); ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div style="color:#b94a48; background:#f2dede; padding:10px; border-radius:6px; margin-bottom:15px;">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div style="color:#155724; background:#d4edda; padding:10px; border-radius:6px; margin-bottom:15px;">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($errors)): ?>
            <div style="color:#856404; background:#fff3cd; padding:10px; border-radius:6px; margin-bottom:15px;">
                <ul style="margin:0; padding-left:18px;">
                    <?php foreach ($errors as $e): ?>
                        <li><?= esc($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('register/submit') ?>" method="post" novalidate>
            <?= csrf_field() ?>

            <label>First Name:</label>
            <input type="text" name="first_name" value="<?= old('first_name') ?>" required>
            <?php if (!empty($errors['first_name'])): ?><div style="color:red; font-size:12px;"><?= esc($errors['first_name']) ?></div><?php endif; ?>
            <br>
            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?= old('last_name') ?>" required>
            <?php if (!empty($errors['last_name'])): ?><div style="color:red; font-size:12px;"><?= esc($errors['last_name']) ?></div><?php endif; ?>
            <br>
            <label>Email:</label>
            <input type="email" name="email" value="<?= old('email') ?>" required>
            <?php if (!empty($errors['email'])): ?><div style="color:red; font-size:12px;"><?= esc($errors['email']) ?></div><?php endif; ?>
            <br>
            <label>Password:</label>
            <input type="password" name="password" id="password" required autocomplete="new-password">
            <?php if (!empty($errors['password'])): ?><div style="color:red; font-size:12px;"><?= esc($errors['password']) ?></div><?php endif; ?>
            <br>
            <label>Confirm Password:</label>
            <input type="password" name="password_confirm" id="password_confirm" required autocomplete="new-password">
            <?php if (!empty($errors['password_confirm'])): ?><div style="color:red; font-size:12px;"><?= esc($errors['password_confirm']) ?></div><?php endif; ?>
            <small style="display:block; color:#555; font-size:12px; margin-top:2px;">Min 8 chars, 1 uppercase, 1 digit, 1 special character, no spaces. Must match password.</small>
            <div id="password-error" style="color: red; font-size: 12px; margin-top:4px;"></div>
            <br>
            <label for="terms" style="display:flex; align-items:center; gap:6px;">
                <input type="checkbox" name="terms" id="terms" value="1" <?= old('terms') ? 'checked' : '' ?> required>
                <span>I agree to the <a href="<?= site_url('privacy-policy') ?>" target="_blank">privacy policy</a></span>
            </label>
            <?php if (!empty($errors['terms'])): ?><div style="color:red; font-size:12px;"><?= esc($errors['terms']) ?></div><?php endif; ?>
            <br>
            <button type="submit">Register</button>
        </form>
        <div style="margin-top:15px; font-size:14px; text-align:center;">
            <a href="<?= site_url('/') ?>">Already have an account? Login</a>
            <?php if (session()->get('is_logged_in')): ?> | <a href="<?= site_url('users') ?>">Users List</a><?php endif; ?>
        </div>
        <script>
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirm');
            const errorDiv = document.getElementById('password-error');
            const pattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?])(?!.*\s).{8,}$/;

            function validatePasswords() {
                const pwd = passwordInput.value;
                const conf = confirmInput.value;
                if (!pwd && !conf) {
                    errorDiv.textContent = '';
                    return;
                }
                if (pwd && !pattern.test(pwd)) {
                    errorDiv.textContent = 'Password must be at least 8 chars, include 1 uppercase, 1 digit, 1 special char, and no spaces.';
                    return;
                }
                if (conf && pwd !== conf) {
                    errorDiv.textContent = 'Passwords do not match.';
                    return;
                }
                errorDiv.textContent = '';
            }

            passwordInput.addEventListener('input', validatePasswords);
            confirmInput.addEventListener('input', validatePasswords);
        </script>
    </div>
</body>

</html>