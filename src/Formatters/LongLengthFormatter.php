<?php

namespace Adaptivemedia\Pnr\Formatters;

class LongLengthFormatter implements SwedishPersonalNumberFormatterInterface
{
    public function format(string $personalNumber) : string
    {
        $length = strlen($personalNumber);
        if ($length === 10) {
            $century = $this->guessBirthYear($personalNumber);
            $personalNumber = $century .= $personalNumber;
            $length = strlen($personalNumber);
        }

        if ($length == 12) {
            // With century: 198306030217
            return substr($personalNumber, 0, 8) . '-' . substr($personalNumber, 8, 4);
        }

        return $personalNumber;
    }

    private function guessBirthYear($personalNumber)
    {
        $nowYear = (int)date('Y'); // eg. 2015
        $controlYear = (int)substr($nowYear - 105, 2, 2); // eg. 2015-105 = 1910 => 10
        $birthYear = (int)substr($personalNumber, 0, 2); // eg 83, 05, 01, 10, 35, 66
        return $birthYear >= $controlYear ? '19' : '20'; // 10 means; > 1910 = old, <= 2010 = young
    }
}
