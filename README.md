
# Laravel SSO Provider

[![Build Status](https://travis-ci.org/dbtedman/laravel-sso-provider.svg?branch=master)](https://travis-ci.org/dbtedman/laravel-sso-provider) [![Packagist](https://img.shields.io/packagist/v/dbtedman/laravel-sso-provider.svg)](https://packagist.org/packages/dbtedman/laravel-sso-provider) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE.md)

Provides custom SSO integration to [Laravel 5](https://laravel.com) applications.

## Where do I start?

1\. Require the `dbtedman/laravel-sso-provider` package.

```bash
composer require dbtedman/laravel-sso-provider
```

2\. Use the library in your authentication controller.

```php
use DBTedman\SSOProvider\Helpers\SSOHelper;

$sso = SSOHelper::login();

if ($sso->valid() && $sso->isStaffMember) {
  // Assumes you have a method defined elsewhere which returns an existing User object.
  $thisUser = findUserByStaffNumber($sso->staffNumber);
    
  if ($thisUser == null) {
    // We could not find user so lets create them.
    $thisUser = new User;
    $thisUser->staff_number = $sso->staffNumber;
  }

  // Keep name and email up to date with SSO data for new and existing users.
  $thisUser->full_name = $sso->fullName;
  $thisUser->email = $sso->email;

  // Save any changes made to the user. 
  $thisUser->save();

  if ($thisUser != null) {
    // Finish the login using Laravel's Auth facade.
    Auth::login($thisUser, false);
  }
}
```

## Testing

See [https://travis-ci.org/dbtedman/laravel-sso-provider](https://travis-ci.org/dbtedman/laravel-sso-provider) for CI results, run on each commit.

### Unit Testing

```bash
composer run test
```

## Releasing

Releases are automatically deployed to [Packagist](https://packagist.org/packages/dbtedman/laravel-sso-provider) from [Github](https://github.com/dbtedman/laravel-sso-provider).

---

Created [Down Under](https://en.wikipedia.org/wiki/Australia) by [Daniel Tedman](https://danieltedman.com).

[![Australia](https://danieltedman.com/images/Australia.png)](https://en.wikipedia.org/wiki/Australia)
