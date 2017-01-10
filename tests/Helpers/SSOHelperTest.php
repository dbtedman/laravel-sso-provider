<?php
namespace DBTedman\SSOProvider\Helpers;

use PHPUnit\Framework\TestCase;


class SSOHelperTest extends TestCase
{
  /**
   * @var string
   */
  private static $LOGOUT_URL_MATCH = "/^https:\\/\\/.+$/";

  /**
   * @var SSOHelper
   */
  private $sso;

  protected function setUp()
  {
    $this->sso = SSOHelper::login();
  }

  public function testLoginMethod()
  {
    $this->assertTrue(method_exists(new SSOHelper(), "login"));
    $this->assertTrue($this->sso instanceof SSOHelper, "SSOHelper::login() should return an instance of SSOHelper.");
  }

  public function testResult()
  {
    // TODO: Has issues now that we are checking for cookies and GET parameters that will need to be simulated.
//    $this->assertTrue(property_exists($this->sso, "result"), "SSOHelper->result should exist.");
//    $this->assertTrue(is_array($this->sso->result), "SSOHelper->result should be an array.");
  }

  public function testOk()
  {
    // TODO: Has issues now that we are checking for cookies and GET parameters that will need to be simulated.
//    $this->assertTrue(property_exists($this->sso, "ok"), "SSOHelper->ok should exist.");
//    $this->assertTrue(is_bool($this->sso->ok), "SSOHelper->ok should be a bool.");
  }

  public function testStaffNumber()
  {
    $this->assertTrue(property_exists($this->sso, "staffNumber"), "SSOHelper->staffNumber should exist.");
  }

  public function testEmail()
  {
    $this->assertTrue(property_exists($this->sso, "email"), "SSOHelper->email should exist.");
  }

  public function testFullName()
  {
    $this->assertTrue(property_exists($this->sso, "fullName"), "SSOHelper->fullName should exist.");
  }

  public function testMemberships()
  {
    $this->assertTrue(property_exists($this->sso, "memberships"), "SSOHelper->memberships should exist.");
    $this->assertTrue(is_array($this->sso->memberships), "SSOHelper->memberships should be an array.");
  }

  public function testIsStaffNumber()
  {
    $this->assertTrue(property_exists($this->sso, "isStaffMember"), "SSOHelper->isStaffMember should exist.");
    $this->assertTrue(is_bool($this->sso->isStaffMember), "SSOHelper->isStaffMember should be a bool.");
  }

  public function testValidMethod()
  {
    $this->assertTrue(method_exists(new SSOHelper(), "valid"));
    $this->assertTrue(is_bool($this->sso->valid()), "SSOHelper::valid() should return a boolean value.");
  }

  public function testLogoutMethod()
  {
    $this->assertTrue(method_exists(new SSOHelper(), "logout"));
    $this->assertRegExp(self::$LOGOUT_URL_MATCH, SSOHelper::logout());
  }
}
