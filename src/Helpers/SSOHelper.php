<?php
namespace Helpers;

/**
 * Handles direct interaction with server side SSO functionality.
 */
class SSOHelper
{
  /**
   * @var string Expected membership string for Staff.
   */
  private static $STAFF_MEMBERSHIP = "General Staff (All)";

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

    list($ok, $result) = singleSignon(1, true); // Defined in external .pingsinglesignon.php file.

    $sso->ok = $ok;

    if ($sso->ok) {
      $sso->result = $result;

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
    if (in_array(self::$STAFF_MEMBERSHIP, $this->memberships)) {
      $this->isStaffMember = true;
    }
  }
}
