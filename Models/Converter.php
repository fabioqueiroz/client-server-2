<?php
class Converter {
    /*
     * Class for converting miles to kilometers and vice versa
     */
    public $number = 0;
    public $unit = '';

    /*
     * The constructor takes the number and unit and assigns
     * them to the corresponding properties.
     * @param int $number The number to be converted
     * @param string The conversion unit
     */
    public function __construct($number, $unit) {
        $this->number = trim($number);
        $this->unit = $unit;
    }
    /*
     * Converts the number and return the result
     * @return string The result of the conversion
     */
    public function convert() {

        if (is_numeric($this->number)) {

            if ($this->unit == 'miles to km') {
                $result = $this->number * 1.609;
            }
            elseif ($this->unit == 'km to miles') {
                $result = $this->number * 0.621;
            }
            else {
                $result = 'error';
            }
        }
        else {
            $result = 'not valid';
        }
        return $result;
    }
}