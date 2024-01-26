<?php
class Student {
    public $name;
    private $arrivalTime;
    private $wasLate;
    public $arrivalCounter;

    public function __construct() {
        $this->name = "";
        $this->arrivalTime = null;
        $this->wasLate = null;
        $this->arrivalCounter = 0;
    }

    public function getArrivalTime() {
        return $this->arrivalTime;
    }

    public function getWasLate() {
        return $this->wasLate;
    }

    public function getArrivalCounter() {
        return $this->arrivalCounter;
    }

    public function setArrivalTime($arrivalTime) {
        $this->arrivalTime = $arrivalTime;
    }

    public function setWasLate($wasLate) {
        $this->wasLate = $wasLate;
    }

    public function addArrival() {
        $this->arrivalCounter += 1;
    }
}