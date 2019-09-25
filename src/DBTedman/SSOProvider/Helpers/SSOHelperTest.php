<?php
declare(strict_types=1);

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

    protected function setUp(): void
    {
        $this->sso = SSOHelper::login();
    }

    public function testLoginMethod(): void
    {
        $this->assertTrue(
            method_exists(new SSOHelper(), "login")
        );
        $this->assertTrue(
            $this->sso instanceof SSOHelper,
            "SSOHelper::login() should return an instance of SSOHelper."
        );
    }

    public function testResult(): void
    {
        $this->assertTrue(
            property_exists($this->sso, "result"),
            "SSOHelper->result should exist."
        );
        $this->assertTrue(
            is_array($this->sso->result),
            "SSOHelper->result should be an array."
        );
    }

    public function testOk(): void
    {
        $this->assertTrue(
            property_exists($this->sso, "ok"),
            "SSOHelper->ok should exist."
        );
        $this->assertTrue(
            is_bool($this->sso->ok),
            "SSOHelper->ok should be a bool."
        );
    }

    public function testStaffNumber(): void
    {
        $this->assertTrue(
            property_exists($this->sso, "staffNumber"),
            "SSOHelper->staffNumber should exist."
        );
    }

    public function testEmail(): void
    {
        $this->assertTrue(
            property_exists($this->sso, "email"),
            "SSOHelper->email should exist."
        );
    }

    public function testFullName(): void
    {
        $this->assertTrue(
            property_exists($this->sso, "fullName"),
            "SSOHelper->fullName should exist."
        );
    }

    public function testMemberships(): void
    {
        $this->assertTrue(
            property_exists($this->sso, "memberships"),
            "SSOHelper->memberships should exist."
        );
        $this->assertTrue(
            is_array($this->sso->memberships),
            "SSOHelper->memberships should be an array."
        );
    }

    public function testIsStaffNumber(): void
    {
        $this->assertTrue(
            property_exists($this->sso, "isStaffMember"),
            "SSOHelper->isStaffMember should exist."
        );
        $this->assertTrue(
            is_bool($this->sso->isStaffMember),
            "SSOHelper->isStaffMember should be a bool."
        );
    }

    public function testValidMethod(): void
    {
        $this->assertTrue(
            method_exists(new SSOHelper(), "valid")
        );
        $this->assertTrue(
            is_bool($this->sso->valid()),
            "SSOHelper::valid() should return a boolean value."
        );
    }

    public function testLogoutMethod(): void
    {
        $this->assertTrue(
            method_exists(new SSOHelper(), "logout")
        );
        $this->assertRegExp(
            self::$LOGOUT_URL_MATCH,
            SSOHelper::logout()
        );
    }
}
