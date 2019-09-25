# [Laravel SSO Provider](./README.md) / Contributing

-   [Testing](#testing)
-   [Releasing](#releasing)

## Testing

See [https://travis-ci.org/dbtedman/laravel-sso-provider](https://travis-ci.org/dbtedman/laravel-sso-provider) for CI results, run on each commit.

```bash
composer run test:cover
```

or

```bash
docker run \
    -it \
    -v "$PWD":/app \
    -w /app \
    --user www-data \
    --rm \
    $(docker build --quiet .) \
    composer run test:cover
```

## Releasing

Releases are automatically deployed to [Packagist](https://packagist.org/packages/dbtedman/laravel-sso-provider) from [Github](https://github.com/dbtedman/laravel-sso-provider).
