<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        $session = session(); // Start sesh for CI
        
        // Validate input
        $validate = \Config\Services::validation();
        $validate->setRules([
            'email' => [
                'rules' => 'required|valid_email|max_length[255]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please provide a valid email address',
                    'max_length' => 'Email must not exceed 255 characters'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[255]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 8 characters',
                    'max_length' => 'Password must not exceed 255 characters'
                ]
            ]
        ]);

        if (!$validate->withRequest($this->request)->run()) {
            // Validation failed
            $errors = $validate->getErrors();
            $errorMessage = implode(' ', $errors);
            $session->setFlashdata('error', $errorMessage);
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel(); // Create ng model instance, para connected kay DB

        $email = trim($this->request->getPost(index: 'email')); // Kunin sa login form yung email and pass
        $password = (string)$this->request->getPost('password');

        $user = $userModel->where('email', $email)->first(); // Hanapin sa db yung user through email

        if ($user && password_verify($password, $user['password_hash'])) { // If existing user, proceed sa verification ng password, through password_verify
            $session->set([ // Save user info sa session
                'user_id'   => $user['id'],
                'email'     => $user['email'],
                'full_name' => $user['first_name'] . ' ' . $user['last_name'],
                'is_logged_in' => true,
            ]);
            return redirect()->to('/dashboard'); // Redirect sa dashboard
        } else {
            // Fail
            $session->setFlashdata('error', 'Invalid email or password');
            return redirect()->back()->withInput(); // Back to login form, with inputs still populated, maliban sa password, for security
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/'); // balik sa index(login)
    }
}