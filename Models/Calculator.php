<?php

class Calculator
{
    private $numberOne = 0;
    private $numberOTwo = 0;
    public $operation = '';


    public function __construct($numberOne, $numberOTwo, $operation) {
        $this->numberOne = trim($numberOne);
        $this->numberOTwo = trim($numberOTwo);
        $this->operation = $operation;
    }

    public function calculate() {

        if ($this->operation == 'add') {
            return $this->add();
        }

        elseif ($this->operation == 'subtract') {
            return $this->subtract();
        }

        elseif ($this->operation == 'multiply') {
            return $this->multiply();
        }

        elseif ($this->operation == 'divide') {
            return $this->divide();
        }
    }



    public function add() {

        return $this->numberOne + $this->numberOTwo;
    }

    public function subtract() {

        return $this->numberOne - $this->numberOTwo;
    }

    public function multiply() {

        return $this->numberOne * $this->numberOTwo;
    }

    public function divide() {

        return $this->numberOne / $this->numberOTwo;
    }

}