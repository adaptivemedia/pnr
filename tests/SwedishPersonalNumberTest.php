<?php

namespace Adaptivemedia\tests;

use Adaptivemedia\Pnr\SwedishPersonalNumber;

class SwedishPersonalNumberTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function converts_any_type_of_personal_number_to_a_long_format()
    {
        $formatter = SwedishPersonalNumber::FORMAT_LONG;

        $pnrService = new SwedishPersonalNumber('830603-0217', new $formatter);
        $this->assertEquals('19830603-0217', $pnrService->format());

        $pnrService->setPersonalNumber('100603-0217');
        $this->assertEquals('20100603-0217', $pnrService->format());

        $pnrService->setPersonalNumber('150603-0217');
        $this->assertEquals('19150603-0217', $pnrService->format());

        $pnrService->setPersonalNumber('010603-0218');
        $this->assertEquals('20010603-0218', $pnrService->format());
    }

    /** @test */
    public function converts_any_type_of_personal_number_to_a_short_format()
    {
        $formatter = SwedishPersonalNumber::FORMAT_SHORT;
        $pnrService = new SwedishPersonalNumber('198306030217', new $formatter);
        $this->assertEquals('830603-0217', $pnrService->format());

        $pnrService->setPersonalNumber('19830603-0217');
        $this->assertEquals('830603-0217', $pnrService->format());

        $pnrService->setPersonalNumber('8306030217');
        $this->assertEquals('830603-0217', $pnrService->format());

        $pnrService->setPersonalNumber('830603-0217');
        $this->assertEquals('830603-0217', $pnrService->format());
    }

    /** @test */
    public function defaults_to_short_formatter_if_no_formatter_is_specified()
    {
        $pnrService = new SwedishPersonalNumber('198306030217');
        $this->assertEquals('830603-0217', $pnrService->format());
    }

    /**
     * @test
     * @expectedException \Adaptivemedia\Pnr\SwedishPersonalNumberException
     */
    public function throws_exception_when_personal_number_is_too_long()
    {
        $formatter = SwedishPersonalNumber::FORMAT_SHORT;
        new SwedishPersonalNumber('1983060302177', new $formatter);
    }

    /**
     * @test
     * @expectedException \Adaptivemedia\Pnr\SwedishPersonalNumberException
     */
    public function throws_exception_when_personal_number_is_too_short()
    {
        $formatter = SwedishPersonalNumber::FORMAT_SHORT;
        new SwedishPersonalNumber('830603021', new $formatter);
    }

    /**
     * @test
     * @expectedException \TypeError
     */
    public function throws_exception_when_invalid_type_is_supplied()
    {
        $formatter = SwedishPersonalNumber::FORMAT_SHORT;

        new SwedishPersonalNumber(['foo' => 'bar'], $formatter);
    }
}
