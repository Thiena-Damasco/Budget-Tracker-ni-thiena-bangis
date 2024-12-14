<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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

        .btn-login {
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

        .btn-login:hover {
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
            <h2 class="form-title">Login</h2>
            <form id="logForm" method="POST" action="<?=site_url('auth/login');?>">
                <div class="form-group">
                    <label for="email">E-mail Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <a href="<?=site_url('auth/password-reset');?>">Forgot Your Password?</a>
                </div>
                <button type="submit" class="btn-login">Login</button>
                <div class="form-footer">
                    Don't have an account? <a href="<?= site_url('auth/register'); ?>">Sign In</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var logForm = $("#logForm")
                if(logForm.length) {
                    logForm.validate({
                        rules: {
                            email: {
                                required: true,
                            },
                            password: {
                                required: true,
                            }
                        },
                        messages: {
                            email: {
                                required: "Please input your email address.",                            
                            },
                            password: {
                                required: "Please input your password.",  
                            }
                        },
                    })
                }
        })
    </script>
</body>
</html>


