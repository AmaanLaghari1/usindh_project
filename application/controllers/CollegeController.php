<?php

namespace App\Controllers;

use App\Models\Colleges_model;
use CodeIgniter\Controller;

class CollegeController extends Controller
{
    public function index()
    {
        $college = new Colleges_model();

        $data['affiliation_college'] = $college->findAll();

        return view('colleges', $data);
    }
}
