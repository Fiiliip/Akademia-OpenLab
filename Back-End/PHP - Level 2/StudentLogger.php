<?php
class StudentLogger {

    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public static function loadArrivalsCounter()
    {
        $arrivalsCounter = [];
        if (file_exists('studenti.json')) {
            $JSONFile = file_get_contents('studenti.json');
            $arrivalsCounter = json_decode($JSONFile, true);
        }
        
        return $arrivalsCounter;
    }

    public static function writeArrivalsCounter($arrivalsCounter) {
        $arrivalsCounterJSON = json_encode($arrivalsCounter, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
        file_put_contents('studenti.json', $arrivalsCounterJSON);
    }

    public function getName() {
        return $this->name;
    }

    private function getArrivalStatus($arrivalTime) {
        $status = "";
        if (date("H", strtotime($arrivalTime)) >= 8) {
            $status = "meškanie";
        } else {
            $status = "včas";
        }
        return $status;
    }

    public function loadArrivals() {
        $arrivals = [];
        if (file_exists('prichody.json')) {
            $JSONFile = file_get_contents('prichody.json');
            $arrivals = json_decode($JSONFile, true);
        }
        
        return $arrivals;
    }

    public function writeArrivals($arrivals) {
        foreach ($arrivals as $arrivalKey => $arrival) {
            foreach ($arrival as $key => $time) {
                $time[key($time)] = $this->getArrivalStatus(key($time));
                $arrival[$key][key($time)] = $time[key($time)];
            }
            $arrivals[$arrivalKey] = $arrival;
        }

        $arrivalsJSON = json_encode($arrivals, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
        file_put_contents('prichody.json', $arrivalsJSON);
    }
}
?>