<?php
class Student {
    private $name;
    private $arrivalCounter;
    private $arrivalTimes;

    public static function getStudentsFromJSON()
    {
        $students = [];
        if (file_exists('studenti.json')) {
            $JSONFile = file_get_contents('studenti.json');
            $students = json_decode($JSONFile);
            print_r($students);
        }
        
        return $students;
    }
}
?>