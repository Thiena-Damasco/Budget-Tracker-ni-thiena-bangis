<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- toastr.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
            width: 1000px; /* Fixed width for laptop view */
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

        .btn-register {
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

        .btn-register:hover {
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
            <h2>Welcome to!</h2>
            <p>Efficient Financial Tracking System.</p>
        </div>

        <div class="right-section">
            <h2 class="form-title">Register</h2>
            <form id="regForm" method="POST" action="<?= site_url('auth/register'); ?>">
                <?php csrf_field(); ?>
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn-register">Register</button>
                <div class="form-footer">
                    Already have an account? <a href="<?= site_url('auth/login'); ?>">Login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var regForm = $("#regForm")
            if (regForm.length) {
                regForm.validate({
                    rules: {
                        email: {
                            required: true,
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        password_confirmation: {
                            required: true,
                            minlength: 8
                        },
                        firstname: {
                            required: true,
                        },
                        lastname: {
                            required: true,
                        },
                        gender: {
                            required: true,
                        }
                    },
                    messages: {
                        email: {
                            required: "Please input your email address.",
                        },
                        password: {
                            required: "Please input your password",
                            minlength: jQuery.validator.format("Password must be at least {0} characters.")
                        },
                        password_confirmation: {
                            required: "Please confirm your password",
                            minlength: jQuery.validator.format("Password confirmation must be at least {0} characters.")
                        },
                        firstname: {
                            required: "Please input your first name.",
                        },
                        lastname: {
                            required: "Please input your last name.",
                        },
                        gender: {
                            required: "Please select your gender.",
                        }
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });

                // Custom toastr error messages
                $("#regForm").submit(function(event) {
                    if (!$(this).valid()) {
                        var messages = $('#regForm').validate().errorList;
                        messages.forEach(function(msg) {
                            toastr.error(msg.message);
                        });
                        event.preventDefault();
                    }
                });
            }
        })
    </script>
</body>

</html>
