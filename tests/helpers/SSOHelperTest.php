<?php
namespace helpers;

use PHPUnit\Framework\TestCase;


class SSOHelperTest extends TestCase
{
  public function testExists()
  {
    $this->assertNotNull(new SSOHelper());
  }
}
