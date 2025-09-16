<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        // Add authentication logic here
        if ($username === 'admin' && $password === 'password') {
            return redirect()->to('/dashboard');
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }
}