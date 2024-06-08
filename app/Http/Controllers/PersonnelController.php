<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function especePerso()
    {
        return view('personnels/espacePerso');
    }
}
