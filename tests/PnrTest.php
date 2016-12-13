<?php

use Adaptivemedia\Pnr\Pnr;

class PnrTest extends \PHPUnit_Framework_TestCase {

    public function test_formats_pnrs_to_10_with_hyphen()
    {

        $pnrService = new Pnr('830603-0217');
        $this->assertEquals('19830603-0217', $pnrService->get10WithHyphen());

        $pnrService = new Pnr('100603-0217');
        $this->assertEquals('20100603-0217', $pnrService->get10WithHyphen());

        $pnrService = new Pnr('150603-0217');
        $this->assertEquals('19150603-0217', $pnrService->get10WithHyphen());

        $pnrService = new Pnr('010603-0218');
        $this->assertEquals('20010603-0218', $pnrService->get10WithHyphen());
    }

    public function test_formats_pnrs_to_8_with_hyphen()
    {
        $pnrService = new Pnr('198306030217');
        $this->assertEquals('830603-0217', $pnrService->get8WithHyphen());

        $pnrService = new Pnr('19830603-0217');
        $this->assertEquals('830603-0217', $pnrService->get8WithHyphen());

        $pnrService = new Pnr('8306030217');
        $this->assertEquals('830603-0217', $pnrService->get8WithHyphen());

        $pnrService = new Pnr('830603-0217');
        $this->assertEquals('830603-0217', $pnrService->get8WithHyphen());
    }

    /** @expectedException \Adaptivemedia\Pnr\PnrException */
    public function test_throws_exception_too_long()
    {
        new Pnr('1983060302177');
    }

    /** @expectedException \Adaptivemedia\Pnr\PnrException */
    public function test_throws_exception_too_short()
    {
        new Pnr('830603021');
    }

    /** @expectedException \Adaptivemedia\Pnr\PnrException */
    public function test_throws_exception_not_a_string_or_numeric()
    {
        new Pnr(['foo' => 'bar']);
    }
}