<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function Hildek(): string
    {
        return view('Hildek');
    }
    public function contatos(): string
    {
        return view('contatos');
    }
}
