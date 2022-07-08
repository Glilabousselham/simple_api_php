<?php


namespace App\Controllers;

use App\Models\Etudiant;

class EtudiantController
{


    // get method
    public function getall()
    {
        $data = Etudiant::getAll();

        return $data;
    }

    // post method
    public function create()
    {

        // collect the data
        $prenom = $_REQUEST['prenom'] ?? "";
        $nom = $_REQUEST['nom'] ?? "";
        $date_naiss = $_REQUEST['date_naiss'] ?? "";
        $note = $_REQUEST['note'] ?? "";
        $filiere = $_REQUEST['filiere'] ?? "";



        if (empty($prenom) || empty($nom) || empty($date_naiss) || empty($note) || empty($filiere)) {
            return "data not comlete!";
        }

        $e =new Etudiant($prenom, $nom, $date_naiss, $note, $filiere);

        if ($e->create()) {
            # code...
            return "the etudiant was inserted successfully";
        }
        return "something went wrong!";

    }
}
