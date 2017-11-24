<?php

namespace Adaptivemedia\Pnr\Formatters;

class LongLengthNoDashFormatter implements SwedishPersonalNumberFormatterInterface
{
    public function format(string $personalNumber) : string
    {
        $longFormat = (new LongLengthFormatter())->format($personalNumber);

        return preg_replace('/\D/', '', $longFormat);
    }
}
