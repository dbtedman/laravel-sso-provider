# [Laravel SSO Provider](./README.md) / Contributing

## Testing

See [https://travis-ci.org/dbtedman/laravel-sso-provider](https://travis-ci.org/dbtedman/laravel-sso-provider) for CI results, run on each commit.

### Unit Testing

```bash
composer run test:cover
```

or

```bash
# Build custom php+composer+xdebug.
docker build -t composer-xdebug:latest .

# Use custom built image to run test suite with coverage.
docker run -it -v "$PWD":/app -w /app --user www-data --rm composer-xdebug:latest composer run test:cover
```

## Releasing

Releases are automatically deployed to [Packagist](https://packagist.org/packages/dbtedman/laravel-sso-provider) from [Github](https://github.com/dbtedman/laravel-sso-provider).
