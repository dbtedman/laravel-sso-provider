<?php
require __DIR__ . '/../vendor/autoload.php';

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

function getPSLogoutByEnv()
{
  return "https://localhost:8443/login.php";
}
