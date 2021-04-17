<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classe;
use App\Filiere;
class ClasseController extends Controller
{
    public function stats(){
        $number = array();
        $filierenom = array();
        foreach(Classe::all()->groupBy('id_filiere') as $classes => $values){

            $count = 0;
            foreach($values as $val){
                $count += 1;
                $filiere = Filiere::find($val->id_filiere);
            }

            array_push($filierenom, $filiere->code);
            array_push($number, $count);

        }
        $result = array(
            "filiere" => $filierenom,
            "nombre" => $number
        );
        return json_encode($result);
    }

    public function affiche(){
        $result = array();
        foreach(Classe::all() as $classe){
            $filiere = Filiere::find($classe->id_filiere);

            $temp = array(
                "id" => $classe->id,
                "code" => $classe->code,
                "id_filiere" => $filiere->id,
                "codef" => $filiere->code,
                "libelle" => $filiere->libelle
                
            );

            array_push($result, $temp);
        }
        return json_encode($result);
    }
    public function search(Request $request){
        $result = array();
        if($request->ajax()){
            $classes = Classe::all()->where('id_filiere', '=', $request->input('id'));
            foreach($classes as $classe){
                $temp = array(
                    "id" => $classe->id,
                    "code" => $classe->code,
                    "id_filiere" => Filiere::find($classe->id_filiere)->id,
                    "codef" => Filiere::find($classe->id_filiere)->code,
                    "libelle" => Filiere::find($classe->id_filiere)->libelle
                );
                array_push($result, $temp);
            }

            return json_encode($result);
        }
    }

    public function delete(Request $request){
        if($request->ajax()){

            $classe = Classe::find($request->input('id'));
            $classe->delete();

            $result = array();

            $classes = Classe::all();
            foreach($classes as $classe){
                $temp = array(
                    "id" => $classe->id,
                    "code" => $classe->code,
                    "id_filiere" => Filiere::find($classe->id_filiere)->id,
                    "codef" => Filiere::find($classe->id_filiere)->code,
                    "libelle" => Filiere::find($classe->id_filiere)->libelle
                );
                array_push($result, $temp);
            }

            return json_encode($result);
        }
    }
    public function update(Request $request){
        if($request->ajax()){

            $classe = Classe::find($request->input('id'));
            $classe->code = $request->input('code');
            $classe->id_filiere = $request->input('id_filiere');
            $classe->save();

            $result = array();

            $classes = Classe::all();
            foreach($classes as $classe){
                $temp = array(
                    "id" => $classe->id,
                    "code" => $classe->code,
                    "id_filiere" => Filiere::find($classe->id_filiere)->id,
                    "codef" => Filiere::find($classe->id_filiere)->code,
                    "libelle" => Filiere::find($classe->id_filiere)->libelle
                );
                array_push($result, $temp);
            }

            return json_encode($result);
        }
    }
}
