<?php

namespace Adaptivemedia\Pnr\Formatters;

class ShortLengthNoDashFormatter implements SwedishPersonalNumberFormatterInterface
{
    public function format(string $personalNumber) : string
    {
        $shortFormat = (new ShortLengthFormatter())->format($personalNumber);

        return preg_replace('/\D/', '', $shortFormat);
    }
}
