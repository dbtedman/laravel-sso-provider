<?php

namespace DBTedman\SSOProvider\Helpers;

/**
 * This file is available on all app server environments.
 *
 * We use two methods defined in this file:
 *   singleSignon()
 *   getPSLogoutByEnv()
 *   singleSignonRedirect()
 */
$ssoFunctions = $_SERVER["DOCUMENT_ROOT"] . "/../security key/.pingsinglesignon.php";

// Check file to avoid errors when running cli operations.
if (file_exists($ssoFunctions)) {
  include_once $ssoFunctions;
}

/**
 * Handles direct interaction with server side SSO functionality.
 */
class SSOHelper
{
  /**
   * @var string[] Expected membership string for Staff.
   */
  private static $STAFF_MEMBERSHIP = [
    "Staff (All)",
    "Academic Staff (All)",
    "General Staff (All)"
  ];

  /**
   * @var array Raw SSO provided data.
   */
  public $result;

  /**
   * @var boolean Was the SSO login successful.
   */
  public $ok;

  /**
   * @var string Staff number, starts with "s".
   */
  public $staffNumber;

  /**
   * @var string Staff email address.
   */
  public $email;

  /**
   * @var string This may contain two or more names in the format provided by SSO.
   */
  public $fullName;

  /**
   * @var string[]
   */
  public $memberships = array();

  /**
   * @var bool True if is a Staff member, else false.
   */
  public $isStaffMember = false;

  /**
   * @return bool Additional check to see if SSO was successful.
   */
  public function valid()
  {
    return $this->ok && is_array($this->result) && array_key_exists("userid", $this->result);
  }

  /**
   * @return SSOHelper Perform a SSO Login and return a SSOHelper instance.
   */
  public static function login()
  {
    $sso = new SSOHelper();

    if (isset($_GET["REF"]) && isset($_COOKIE["setSSO"])) {
      list($sso->ok, $sso->result) = singleSignon(1, true);

    } else {
      singleSignonRedirect(1, SSOHelper::getCurrentURL());
    }

    if ($sso->ok) {
      // Extract required properties.
      $sso->staffNumber = $sso->result["userid"];
      $sso->email = $sso->result["raw"]["mail"];
      $sso->fullName = $sso->result["name"];

      $sso->parseMemberships();
    }

    return $sso;
  }

  /**
   * @return string URL to SSO logout page.
   */
  public static function logout()
  {
    return getPSLogoutByEnv(); // Defined in external .pingsinglesignon.php file.
  }

  /**
   * Extract memberships from raw sso data.
   */
  private function parseMemberships()
  {
    $membershipsRaw = $this->result["raw"]["groupMembership"];

    foreach ($membershipsRaw as $membershipRaw) {
      preg_match("/cn=([^,]+),ou=([^,]+),o=(.+)/", $membershipRaw, $matches);

      if (count($matches) == 4) {
        $this->memberships[] = $matches[1];
      }
    }

    // Determine if user is a staff member.
    foreach (self::$STAFF_MEMBERSHIP as $staffMembership) {
      if (in_array($staffMembership, $this->memberships)) {
        $this->isStaffMember = true;
      }
    }
  }

  /**
   * @return string Full current URL path.
   */
  private static function getCurrentURL()
  {
    $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    $currentURL .= $_SERVER["HTTP_HOST"];

    // Now extract just scheme and host, removing port that we will add back selectively after.
    $parts = parse_url($currentURL);
    $currentURL = $parts["scheme"] . "://" . $parts["host"];

    if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
      $currentURL .= ":" . $_SERVER["SERVER_PORT"];
    }
    $currentURL .= $_SERVER["REQUEST_URI"];

    return $currentURL;
  }
}
