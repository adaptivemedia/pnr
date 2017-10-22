<?php


namespace Adaptivemedia\Pnr\Formatters;

use Adaptivemedia\Pnr\SwedishPersonalNumberException;

class ShortLengthFormatter implements SwedishPersonalNumberFormatterInterface
{
    public function format(string $personalNumber) : string
    {
        $length = strlen($personalNumber);
        if ($length === 12) {
            // With century: 198306030217
            return substr($personalNumber, 2, 6) . '-' . substr($personalNumber, 8, 4);
        } elseif ($length === 10) {
            // Without century: 8306030217
            return substr($personalNumber, 0, 6) . '-' . substr($personalNumber, 6, 4);
        }

        throw new SwedishPersonalNumberException('Invalid personal number');
    }
}
