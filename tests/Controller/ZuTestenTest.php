<?php


namespace App\Tests\Controller;

use \PHPUnit\Framework\TestCase;
use \App\Controller\ZuTesten;

class ZuTestenTest extends TestCase
{
    public function testZuTesten()
    {
        $calc = new ZuTesten();
        $res = $calc->zuTesten(1, 1);

        $this->assertEquals(2, $res);
    }
}