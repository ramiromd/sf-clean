<?php

namespace Ramiromd\Sfclean\Test\Unit;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class DummyTest extends TestCase
{
    #[Test]
    #[TestDox("It can assert equals")]
    public function it_can_assert_equals() : void
    {
        $aNumber = 1;
        $anotherNumber = 1;
        $this->assertEquals($aNumber, $anotherNumber, "Value miss match.");
    }
}