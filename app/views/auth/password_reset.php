<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
            background-color: #DFF2EB;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            padding: 0;
            display: flex;
            width: 1000px;
            max-width: 90%;
            margin: auto;
            background: white;
            border-radius: 35px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .left-section {
            flex: 1;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('/public/pics/openart-image_bz8EyY46_1731771483860_raw.jpg') no-repeat center;
            background-size: cover;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .right-section {
            flex: 1;
            padding: 40px;
            background: white;
        }

        .form-title {
            color: #4A628A;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #4A628A;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #4A628A;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background: #7AB2D3;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #4A628A;
        }

        .form-footer a {
            color: #4A628A;
            text-decoration: none;
            font-weight: bold;
        }

        .message {
            padding: 15px;
            background-color: #e7f5e5;
            border: 1px solid #d1f3d1;
            color: #4A628A;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-section {
                padding: 60px 20px;
            }

            .right-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <h2>Reset Your Password</h2>
            <p>Enter your email to receive a password reset link.</p>
        </div>

        <div class="right-section">
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'email_sent') {
                echo '<div class="message"><p>Password reset email has been sent.</p></div>';
            }
            ?>
            <h2 class="form-title">Reset Password</h2>
            <form method="POST" action="<?= site_url('auth/password-reset'); ?>">
                <?php csrf_field(); ?>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                    <span class="invalid-feedback" role="alert">
                        <strong>We can&#039;t find a user with that email address.</strong>
                    </span>
                    <span class="valid-feedback" role="alert">
                        <strong>Reset password link was sent to your email.</strong>
                    </span>
                </div>
                <button type="submit" class="btn-submit">Send Password Reset Link</button>
                <div class="form-footer">
                    <a href="<?= site_url('auth/login'); ?>">Back to Login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
