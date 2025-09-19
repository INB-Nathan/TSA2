<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;

class Register extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function submit()
    {
        log_message('info', 'Register submit called');

        $validate = \Config\Services::validation();
        $validate->setRules([
            'first_name' => [
                'rules' => 'required|min_length[2]',
                'errors' => [
                    'required' => 'First name is required',
                    'min_length' => 'First name must be at least 2 characters'
                ]
            ],
            'last_name' => [
                'rules' => 'required|min_length[2]',
                'errors' => [
                    'required' => 'Last name is required',
                    'min_length' => 'Last name must be at least 2 characters'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[User.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Provide a valid email address',
                    'is_unique' => 'This email is already registered'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};"\\|,.<>\/?])(?!.*\s).{8,}$/]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 8 characters',
                    'regex_match' => 'Password must include at least 1 uppercase letter, 1 digit, 1 special character, and no spaces'
                ]
            ],
            'password_confirm' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Confirm Password is required',
                    'matches' => 'Passwords do not match'
                ]
            ],
            'terms' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must agree to the privacy policy'
                ]
            ]
        ]);

        if (!$validate->withRequest($this->request)->run()) {
            log_message('info', 'Validation failed: ' . json_encode($validate->getErrors()));
            return redirect()->back()->withInput()->with('errors', $validate->getErrors());
        }

        log_message('info', 'Validation passed');

    $first_name = trim($this->request->getPost('first_name'));
    $last_name = trim($this->request->getPost('last_name'));
    $email = trim($this->request->getPost('email'));
    $password = (string)$this->request->getPost('password');
    $agree = $this->request->getPost('terms');

        log_message('info', 'Password received: ' . $password);

        if (!$agree) {
            return redirect()->back()->with('error', 'You must agree to the privacy policy');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $db = \Config\Database::connect();
            log_message('info', 'Inserting into database');
            $db->table('User')->insert([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password_hash' => $hashedPassword
            ]);
            log_message('info', 'Insertion successful');
            return redirect()->to('/')->with('success', 'Registration successful');
        } catch (DatabaseException $e) {
            log_message('error', 'Registration Failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Registration Failed, try again.');
        } catch (\Exception $e) {
            log_message('error', 'Unexpected error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }
}
