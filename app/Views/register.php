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

        /* 🔹 Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.5);
            text-align: left;
        }

        .close {
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            color: #333;
        }

        .privacy-link {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
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
                <span>I agree to the <span class="privacy-link" id="privacyLink">privacy policy</span></span>
            </label>
            <?php if (!empty($errors['terms'])): ?><div style="color:red; font-size:12px;"><?= esc($errors['terms']) ?></div><?php endif; ?>
            <br>
            <button type="submit">Register</button>
        </form>
        <div style="margin-top:15px; font-size:14px; text-align:center;">
            <a href="<?= site_url('/') ?>">Already have an account? Login</a>
            <?php if (session()->get('is_logged_in')): ?> | <a href="<?= site_url('users') ?>">Users List</a><?php endif; ?>
        </div>

        <div id="privacyModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2>Privacy Policy</h2>
                <p><strong>Effective Date:</strong> September 19, 2025</p>
                <p>E-Shoppers respect your privacy and are committed to protecting your personal information. This document explains how we collect, use, store, and protect information when you visit or make a purchase from our e-commerce web application.</p>
                
                <h3>1. Information We Collect</h3>
                <p>Account details – your name, email, phone number, and delivery address.<br>
                Login details – username and password (your password is safely encrypted).<br>
                Orders – what you buy, payment status, and shipping details.<br>
                Payments – handled by trusted global payment partners (we never store your full credit/debit card info).<br>
                Technical info – IP address, device type, and browser details for security and performance.</p>

                <h3>2. How We Use Your Information</h3>
                <p>Register and manage your account.<br>
                Process and deliver your orders.<br>
                Send order confirmations and updates.<br>
                Provide customer service.<br>
                Improve our website and shopping experience.<br>
                Keep our platform secure and prevent fraud.</p>

                <h3>3. Global Users & Consent</h3>
                <p>E-Shoppers serve users around the world. By using our site, you agree that your data may be stored and processed in different countries where we operate.<br>
                You must check the “I agree” box before creating an account to show your consent.</p>

                <h3>4. How We Protect Your Data</h3>
                <p>Encrypted passwords and transactions.<br>
                Secure connections (SSL/TLS).<br>
                Limited access for authorized staff only.<br>
                Regular checks to prevent leaks or attacks.</p>

                <h3>5. Sharing Data</h3>
                <p>We never sell your personal information. We may share it only with:<br>
                Payment processors to handle transactions safely.<br>
                Shipping companies to deliver your orders.<br>
                Legal authorities if required by law.</p>

                <h3>6. Your Rights</h3>
                <p>No matter where you live, you can:<br>
                Ask what data we have about you.<br>
                Request corrections or updates.<br>
                Request deletion of your data or account (if not needed for legal reasons).<br>
                Withdraw your consent at any time.<br>
                To do this, contact us at <a href="mailto:e-shoppers.admin@gmail.com">e-shoppers.admin@gmail.com</a>.</p>

                <h3>7. Data Retention</h3>
                <p>We keep your information only as long as needed for orders, services, and legal requirements. After that, we delete it securely.</p>

                <h3>8. Cookie Tracking</h3>
                <p>We use cookies to:<br>
                Remember your settings and cart.<br>
                Improve your shopping experience.<br>
                Analyze site traffic.<br>
                You can manage or turn off cookies in your browser settings.</p>

                <h3>9. International Data Transfers</h3>
                <p>Because E-Shoppers operates globally, your data may be stored in servers outside your country. We take steps to make sure your data stays protected no matter where it is.</p>

                <h3>10. Third-Party Services</h3>
                <p>E-Shoppers may link to other sites (payment gateways, shipping partners, etc.). Their privacy policies are separate, so we recommend reading them too.</p>

                <h3>11. Changes to This Privacy Policy</h3>
                <p>E-Shoppers may update this Privacy Policy for major updates within the organisation. If we make changes, we'll send an email to you with the updated privacy policy as well as a form that if you agree with the changes.</p>

                <h3>12. Contact Us</h3>
                <p>If you have any questions or concerns about this Privacy Policy or your rights, please contact us at:<br>
                Email: <a href="mailto:e-shoppers@gmail.com">e-shoppers@gmail.com</a><br>
                Phone: +63 8139226405<br>
                Address: Padre Paredes St, Sampaloc, Manila, 1015 Metro Manila</p>
            </div>
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

            const privacyLink = document.getElementById("privacyLink");
            const modal = document.getElementById("privacyModal");
            const closeModal = document.getElementById("closeModal");

            privacyLink.onclick = function () {
                modal.style.display = "block";
            }

            document.getElementById("closeModal").onclick = function () {
                modal.style.display = "none";
            }

            window.onclick = function (event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </div>
</body>

</html>
