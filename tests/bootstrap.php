<?php
require __DIR__ . '/../vendor/autoload.php';

// Simulate data that would normally be available.
$_SERVER["HTTP_HOST"] = "localhost";
$_SERVER["SERVER_PORT"] = "8443";
$_SERVER["REQUEST_URI"] = "/login.php";

function singleSignon($version, $something)
{
  return array(true, array(
    "userid" => "s1234567",
    "name" => "John Doe",
    "raw" => array(
      "mail" => "d.goe@example.com",
      "groupMembership" => [
        "General Staff (All)"
      ],
    )
  ));
}

function singleSignonRedirect($version = 1, $returnTo = "", $appName = "")
{
}

function getPSLogoutByEnv()
{
  return "https://localhost:8443/login.php";
}
