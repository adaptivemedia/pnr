<?php

namespace Adaptivemedia\tests;

use Adaptivemedia\Pnr\SwedishPersonalNumber;

class SwedishPersonalNumberTest extends \PHPUnit\Framework\TestCase
{
    protected $personalNumbers = [
        '830603-0217' => '19830603-0217',
        '100603-0217' => '20100603-0217',
        '150603-0217' => '19150603-0217',
        '010603-0218' => '20010603-0218',
    ];

    /** @test */
    public function converts_any_type_of_personal_number_to_a_long_format()
    {
        $formatter = SwedishPersonalNumber::FORMAT_LONG;

        foreach ($this->personalNumbers as $short => $long) {
            $pnrService = new SwedishPersonalNumber($short, new $formatter);
            $this->assertEquals($long, $pnrService->format());

            $pnrService = new SwedishPersonalNumber($long, new $formatter);
            $this->assertEquals($long, $pnrService->format());
        }
    }

    /** @test */
    public function converts_any_type_of_personal_number_to_a_long_format_without_dash()
    {
        $formatter = SwedishPersonalNumber::FORMAT_LONG_NO_DASH;

        foreach ($this->personalNumbers as $short => $long) {
            $longWithoutDash = str_replace('-', '', $long);

            $pnrService = new SwedishPersonalNumber($short, new $formatter);
            $this->assertEquals($longWithoutDash, $pnrService->format());

            $pnrService = new SwedishPersonalNumber($long, new $formatter);
            $this->assertEquals($longWithoutDash, $pnrService->format());
        }
    }

    /** @test */
    public function converts_any_type_of_personal_number_to_a_short_format()
    {
        $formatter = SwedishPersonalNumber::FORMAT_SHORT;

        foreach ($this->personalNumbers as $short => $long) {
            $pnrService = new SwedishPersonalNumber($short, new $formatter);
            $this->assertEquals($short, $pnrService->format());

            $pnrService = new SwedishPersonalNumber($long, new $formatter);
            $this->assertEquals($short, $pnrService->format());
        }
    }

    /** @test */
    public function converts_any_type_of_personal_number_to_a_short_format_without_dash()
    {
        $formatter = SwedishPersonalNumber::FORMAT_SHORT_NO_DASH;

        foreach ($this->personalNumbers as $short => $long) {
            $shortWithoutDash = str_replace('-', '', $short);

            $pnrService = new SwedishPersonalNumber($short, new $formatter);
            $this->assertEquals($shortWithoutDash, $pnrService->format());

            $pnrService = new SwedishPersonalNumber($long, new $formatter);
            $this->assertEquals($shortWithoutDash, $pnrService->format());
        }
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
