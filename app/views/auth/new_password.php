<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Password</title>
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
            <p>Please enter your new password.</p>
        </div>

        <div class="right-section">
            <h2 class="form-title">New Password</h2>
            <form id="passwordForm" action="<?=site_url('auth/set-new-password');?>" method="post">
                <input type="hidden" name="token" value="<?php !empty($_GET['token']) && print $_GET['token'];?>">
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="re_password">Confirm New Password</label>
                    <input type="password" class="form-control" id="re_password" name="re_password" required>
                </div>
                <div class="valid-feedback">
                    <strong>Note: Password must be at least 8 characters and contain one special character, a number, and both uppercase and lowercase letters.</strong>
                </div>
                <button type="submit" class="btn-submit">Proceed</button>
                <div class="form-footer">
                    <a href="<?=site_url();?>">Back to Home</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var passwordForm = $("#passwordForm")
            if(passwordForm.length) {
                passwordForm.validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 8
                        },
                        re_password: {
                            required: true,
                            minlength: 8
                        }
                    },
                    messages: {
                        password: {
                            required: "Please input your new password",
                            minlength: jQuery.validator.format("Password must be at least {0} characters.")
                        },
                        re_password: {
                            required: "Please confirm your password",
                            minlength: jQuery.validator.format("Password must be at least {0} characters.")
                        }
                    },
                })
            }
        })
    </script>
</body>

</html>
