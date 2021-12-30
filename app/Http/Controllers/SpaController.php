<?php

namespace App\Http\Controllers;

class SpaController extends Controller
{
    /**
     * Show SPA client
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }
}