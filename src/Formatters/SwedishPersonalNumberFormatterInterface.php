<?php


namespace Adaptivemedia\Pnr\Formatters;

interface SwedishPersonalNumberFormatterInterface
{
    public function format(string $personalNumber) : string;
}
