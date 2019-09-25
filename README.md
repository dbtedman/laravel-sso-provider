# [Laravel SSO Provider](https://github.com/dbtedman/laravel-sso-provider)

[![Build Status](https://travis-ci.org/dbtedman/laravel-sso-provider.svg?branch=master)](https://travis-ci.org/dbtedman/laravel-sso-provider)
[![Packagist](https://img.shields.io/packagist/v/dbtedman/laravel-sso-provider.svg)](https://packagist.org/packages/dbtedman/laravel-sso-provider)

Provides custom SSO integration to [Laravel 5](https://laravel.com) applications.

## Where do I start?

### Require

Require the `dbtedman/laravel-sso-provider` package.

```bash
composer require dbtedman/laravel-sso-provider
```

### Use

Use the library in your authentication controller.

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

## Want to lean more?

-   See our [Contributing Guide](CONTRIBUTING.md) for details on how this
    repository is developed.
-   See our [Changelog](CHANGELOG.md) for details on which features,
    improvements, and bug fixes have been implemented
-   See our [License](LICENSE.md) for details on how you can use the code in
    this repository.
-   See our [Security Guide](SECURITY.md) for details on how security is
    considered.
