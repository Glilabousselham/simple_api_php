<?php

namespace App\Models;


class Etudiant{

    public function __construct($prenom='', $nom='', $date_naiss='', $note='', $filiere='') {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naiss = $date_naiss;
        $this->note = $note;
        $this->filiere = $filiere;
    }

    private function getfilename()
    {

        $filename = $_SERVER['DOCUMENT_ROOT'] . str_replace("index.php", "", dirname($_SERVER['PHP_SELF']));


        $filename .= "../database/Etudiants.csv";

        return $filename;
    }

    public static function getAll(){

        try {
            $filename = (new self)->getfilename();


            if (filesize($filename) == 0) {
                return [];
            }

            $f = fopen($filename, "r");

            $keys = $row = fgetcsv($f);

            $etudiants = [];

            while ($row = fgetcsv($f)) {
                $e = [];

                for ($i = 0; $i < count($keys); $i++) {
                    $e[$keys[$i]] = $row[$i];
                }

                array_push($etudiants, $e);
            }

            return $etudiants;
        } catch (\Throwable $th) {
            //throw $th;
            return [];
        }
    }
    public function create(){

        try{
            $filename = $this->getfilename();

            $row = [$this->prenom, $this->nom, $this->date_naiss, $this->note, $this->filiere];

            $f = fopen($filename, "a");

            if (filesize($filename) == 0) {
                $header = ["nom", "prenom", "date_naiss", "note", "filiere"];
                fputcsv($f, $header);
            }

            fputcsv($f, $row);

            fclose($f);

            return true;
        }catch(\Throwable $t){
            return false;
        }
    }


}