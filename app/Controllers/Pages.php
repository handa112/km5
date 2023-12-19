<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Pages extends Controller
{
    public function index()
    {
        return view('welcome_message');
    }

    public function view($page = 'home')
    {
        if (!is_file(APPPATH.'/Views/pages/'.$page.'.php')){
            throw new \CodeIgniter\Exceptions\PageNotFoundExceptions($page);
        }
        $data['title'] = ucfirst($page);
        echo view('templates/top', $data);
        echo view('templates/header', $data);
        echo view('templates/heroCarousel', $data);
        echo view('pages/'.$page, $data);
        echo view('templates/footer', $data);
        echo view('templates/bottom', $data);
    }
}