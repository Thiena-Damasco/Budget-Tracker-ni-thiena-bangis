<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Auth extends Controller {
    protected $mail;

    public function __construct()
    {
        parent::__construct();
        $this->mail = new PHPMailer(true);
        if(segment(2) != 'logout') {
            if(logged_in()) {
                redirect('dashboard');
            }
        }
        $this->call->library('email');
    }
	
    public function index() {
        $this->call->view('auth/login');
    }  

    public function login() {
        if ($this->form_validation->submitted()) {
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $data = $this->lauth->login($email, $password);
    
            if (empty($data)) {
                $this->session->set_flashdata(['is_invalid' => 'is-invalid']);
                $this->session->set_flashdata(['err_message' => 'These credentials do not match our records.']);
            } else {
                $this->lauth->set_logged_in($data);
                if ($email === 'thiena8@gmail.com') {
                    redirect('user/dashboard');
                } else {
                    $this->call->view('user/dashboard');
                }
            }
            redirect('auth/login');
        } else {
            $this->call->view('auth/login');
        }
    }
    

    public function register() {

        if($this->form_validation->submitted()) {
            $firstname = $this->io->post('firstname');
            $lastname = $this->io->post('lastname');
            $gender = $this->io->post('gender');
            $email = $this->io->post('email');
			$email_token = bin2hex(random_bytes(50));

            $this->form_validation

                ->name('firstname')
                    ->required()
                ->name('lastname')
                    ->required()
                ->name('gender')
                    ->required()
                ->name('password')
                    ->required()
                    ->min_length(8, 'Password must not be less than 8 characters.')
                ->name('password_confirmation')
                    ->required()
                    ->min_length(8, 'Password confirmation name must not be less than 8 characters.')
                    ->matches('password', 'Passwords did not match.')
                ->name('email')
                    ->required()
                    ->is_unique('users', 'email', $email, 'Email was already taken.');
                    
                if($this->form_validation->run()) {
                    if($this->lauth->register($firstname, $lastname, $gender, $email, $this->io->post('password'), $email_token)) {
                        $data = $this->lauth->login($email, $this->io->post('password'));
                        $this->lauth->set_logged_in($data);
                        redirect('home');
                    } else {
                        set_flash_alert('danger', config_item('SQLError'));
                    }
                }  else {
                    set_flash_alert('danger', $this->form_validation->errors()); 
                    redirect('auth/register');
                }
        } else {
            $this->call->view('auth/register');
        }
        
    }

    public function send_password_token_to_email($email, $token) {
        try {
            $mail = new PHPMailer(true);
            
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;               // Disable debug output (use DEBUG_SERVER for development)
            $mail->isSMTP();                                  // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';             // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                         // Enable SMTP authentication
            $mail->Username   = 'thiena8@gmail.com';          // SMTP username (use environment variables for better security)
            $mail->Password   = 'fwef ltop rdnm kyrp';        // SMTP password (use environment variables for better security)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Enable implicit TLS encryption
            $mail->Port       = 465;                          // TCP port to connect to
    
            // Recipients
            $mail->setFrom('thiena8@gmail.com', 'LavaLust');  // Sender info
            $mail->addAddress($email);                        // Add recipient
            
            // Content
            $mail->isHTML(true);                              // Set email format to HTML
            $mail->Subject = 'Reset Your LavaLust Password';  // Email subject
            
            // Email Body Design
            $reset_link = base_url() . "/reset-password?token=" . urlencode($token);
            $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f9f9f9;
                            margin: 0;
                            padding: 0;
                        }
                        .email-container {
                            max-width: 600px;
                            margin: 20px auto;
                            background: #ffffff;
                            border-radius: 8px;
                            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                            overflow: hidden;
                        }
                        .header {
                            background-color: #007BFF;
                            color: white;
                            text-align: center;
                            padding: 20px;
                        }
                        .content {
                            padding: 20px;
                            line-height: 1.6;
                            color: #333;
                        }
                        .reset-button {
                            display: inline-block;
                            background-color: #007BFF;
                            color: white;
                            padding: 10px 20px;
                            border-radius: 5px;
                            text-decoration: none;
                            font-weight: bold;
                            margin-top: 20px;
                        }
                        .footer {
                            text-align: center;
                            font-size: 12px;
                            color: #777;
                            padding: 20px;
                        }
                    </style>
                </head>
                <body>
                    <div class="email-container">
                        <div class="header">
                            <h1>Reset Your LavaLust Password</h1>
                        </div>
                        <div class="content">
                            <p>Hello,</p>
                            <p>We received a request to reset your password. Please click the button below to reset your password:</p>
                            <a href="' . $reset_link . '" class="reset-button">Reset Password</a>
                            <p>If you did not request a password reset, please ignore this email.</p>
                        </div>
                        <div class="footer">
                            <p>&copy; 2024 LavaLust. All rights reserved.</p>
                        </div>
                    </div>
                </body>
                </html>
            ';
    
            // AltBody for plain text email clients
            $mail->AltBody = 'We received a request to reset your password. Please visit the following link to reset your password: ' . $reset_link;
            
            // Send email
            $mail->send();
            echo 'Password reset email has been sent.';
            
        } catch (Exception $e) {
            echo "Password reset email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    
    
	public function password_reset() {
		if($this->form_validation->submitted()) {
			$email = $this->io->post('email');
			$this->form_validation
				->name('email')->required()->valid_email();
			if($this->form_validation->run()) {
				if($token = $this->lauth->reset_password($email)) {
					$this->send_password_token_to_email($email, $token);
                    $this->session->set_flashdata(['alert' => 'is-valid']);
				} else {
					$this->session->set_flashdata(['alert' => 'is-invalid']);
				}
			} else {
				set_flash_alert('danger', $this->form_validation->errors());
			}
		}
		$this->call->view('auth/password_reset');
	}

    public function set_new_password() {
        if($this->form_validation->submitted()) {
            $token = $this->io->post('token');
			if(isset($token) && !empty($token)) {
				$password = $this->io->post('password');
				$this->form_validation
					->name('password')
						->required()
						->min_length(8, 'New password must be atleast 8 characters.')
					->name('re_password')
						->required()
						->min_length(8, 'Retype password must be atleast 8 characters.')
						->matches('password', 'Passwords did not matched.');
						if($this->form_validation->run()) {
							if($this->lauth->reset_password_now($token, $password)) {
								set_flash_alert('success', 'Password was successfully updated.');
							} else {
								set_flash_alert('danger', config_item('SQLError'));
							}
						} else {
							set_flash_alert('danger', $this->form_validation->errors());
						}
			} else {
				set_flash_alert('danger', 'Reset token is missing.');
			}
    	redirect('auth/set-new-password/?token='.$token);
        } else {
             $token = $_GET['token'] ?? '';
            if(! $this->lauth->get_reset_password_token($token) && (! empty($token) || ! isset($token))) {
                set_flash_alert('danger', 'Invalid password reset token.');
            }
            $this->call->view('auth/new_password');
        }
		
	}

    public function logout() {
        if($this->lauth->set_logged_out()) {
            redirect('auth/login');
        }
    }

}
?>
