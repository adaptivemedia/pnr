<?php

namespace Adaptivemedia\Pnr;

use Adaptivemedia\Pnr\Formatters\LongLengthFormatter;
use Adaptivemedia\Pnr\Formatters\ShortLengthFormatter;
use Adaptivemedia\Pnr\Formatters\SwedishPersonalNumberFormatterInterface as FormatterInterface;

class SwedishPersonalNumber
{
    public const FORMAT_SHORT= ShortLengthFormatter::class;
    public const FORMAT_LONG = LongLengthFormatter::class;

    private $personalNumber;
    private $formatter = self::FORMAT_SHORT;

    /**
     * @param $personalNumber
     * @param FormatterInterface $formatter
     * @throws SwedishPersonalNumberException
     */
    public function __construct($personalNumber, FormatterInterface $formatter = null)
    {
        $this->setPersonalNumber((string)$personalNumber);
        $this->formatter = $formatter ?: new ShortLengthFormatter;
    }

    /**
     * @param int|string $personalNumber
     * @throws SwedishPersonalNumberException
     */
    public function setPersonalNumber($personalNumber): void
    {
        $personalNumber = $this->normalizePersonalNumber($personalNumber);
        $length = strlen($personalNumber);

        $minimumLength = 10;
        $maximumLength = 12;

        if ($length < $minimumLength || $length > $maximumLength) {
            // Eg: 830603021 or 1983060302177
            throw new SwedishPersonalNumberException(
                "personalNumber $personalNumber is of an illegal length!"
            );
        }

        $this->personalNumber = $personalNumber;
    }

    public function format(): string
    {
        return $this->formatter->format($this->personalNumber);
    }

    /**
     * @param string|int $personalNumber
     * @return string
     */
    private function normalizePersonalNumber($personalNumber): string
    {
        if (! is_string($personalNumber) && ! is_int($personalNumber)) {
            throw new \InvalidArgumentException(
                "personalNumber not of type string/numeric!"
            );
        }

        return preg_replace('/[^0-9]/', '', $personalNumber);
    }
}
