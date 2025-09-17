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
        $validate = \Config\Services::validation();
        $validate->setRules([
            'first_name' => 'required|min_length[2]',
            'last_name' => 'required|min_length[2]',
            'email' => 'required|valid_email|is_unique[User.email]',
            'password' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]).{8,}$/]',
            'terms' => 'required'
        ]);

        if (!$validate->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validate->getErrors());
        }

        $first_name = $this->request->getPost('first_name');
        $last_name = $this->request->getPost('last_name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $agree = $this->request->getPost('terms');

        if (!$agree) {
            return redirect()->back()->with('error', 'You must agree to the privacy policy');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $db = \Config\Database::connect();
            $db->table('User')->insert([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password_hash' => $hashedPassword
            ]);

            return redirect()->to('/')->with('success', 'Registration successful');
        } catch (DatabaseException $e) {
            log_message('error', 'Registration Failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        } catch (\Exception $e) {
            log_message('error', 'Unexpected error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }
}
