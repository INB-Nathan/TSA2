<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Register extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function submit()
    {
        $first_name = $this->request->getPost('first_name');
        $last_name = $this->request->getPost('last_name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $agree = $this->request->getPost('terms');

        if (!$agree) {
            return redirect()->back()->with('error', 'You must agree to the privacy policy');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $db = \Config\Database::connect();
        $db->table('User')->insert([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password_hash' => $hashedPassword
        ]);

        return redirect()->to('/')->with('success', 'Registration successful');
    }
}