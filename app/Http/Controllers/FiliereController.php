<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filiere;
class FiliereController extends Controller
{
    public function affiche(){
        $filieres = Filiere::all();
        return $filieres->toJson();
    }
}
