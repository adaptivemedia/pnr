<?php

namespace Adaptivemedia\Pnr;

class Pnr
{
    private $pnr;
    private $length;

    /**
     * Pnr constructor.
     *
     * @param string  $pnr
     */
    public function __construct($pnr)
    {
        if ( ! is_string($pnr) && ! is_numeric($pnr)) {
            throw new PnrException("Pnr is not a string/numeric!");
        }

        $pnr = str_replace([' ', '-'], '', $pnr);
        $length = strlen($pnr);

        // Make sure we have an ok pnr
        if ($length < 10) {
            // Eg: 830603021
            throw new PnrException("Pnr $pnr is too short!");
        } elseif ($length > 12) {
            // Eg: 1983060302177
            throw new PnrException("Pnr $pnr is too long!");
        }

        $this->pnr = $pnr;
        $this->length = $length;
    }

    /**
     * Format pnr with 8 digits with a hyphen, eg. 830603-0217
     *
     * @return string
     */
    public function get8WithHyphen()
    {
        if ($this->length() == 12) {
            // With year!
            // 198306030217
            return substr($this->pnr, 2, 6) . '-' . substr($this->pnr, 8, 4);
        } elseif ($this->length() == 10) {
            // Without year
            // 8306030217
            return substr($this->pnr, 0, 6) . '-' . substr($this->pnr, 6, 4);
        }

        return $this->pnr; // fallback so we at least don't return empty string for bad pnrs
    }

    /**
     * Format pnr with 10 digits with a hyphen, eg. 19830603-0217
     *
     * @return string
     */
    public function get10WithHyphen()
    {
        if ($this->length() == 12) {
            // With year!
            // 198306030217
            return substr($this->pnr, 0, 8) . '-' . substr($this->pnr, 8, 4);
        } elseif ($this->length() == 10) {
            // Without year
            // 8306030217

            // We dont know the year, but we will assume user is under 118 years of age
            $first2InYearBorn = $this->year();

            return $first2InYearBorn . substr($this->pnr, 0, 6) . '-' . substr($this->pnr, 6, 4);
        }
    }

    /**
     * @return int
     */
    private function length()
    {
        return strlen($this->pnr);
    }

    /**
     * @return string
     */
    private function year()
    {
        $nowYear = (int)date('Y'); // eg. 2015
        $okYear = (int)substr($nowYear - 105, 2, 2); // eg. 2015-105 = 1910 => 10
        $year = (int)substr($this->pnr, 0, 2); // eg 83, 05, 01, 10, 35, 66
        return $year >= $okYear ? '19' : '20'; // 10 means; > 1910 = old, <= 2010 = young
    }
}