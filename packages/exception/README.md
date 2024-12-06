# SSC - Exception

When an error occurs, one of the following exception has to be thrown:

* **400** `ClientErrorException`: request with malformed syntax (example: invalid JSON)
* **401** `UnauthorizedException`: an authentication error (missing or invalid credentials)
* **403** `ForbiddenException`: an authorization error (credentials found and valid, but not allowed for this resource)
* **404** `NotFoundException`: an error when trying to locate a resource (doesn't exist or has been removed)
* **422** `ValidationFailedException`: an error when trying to validate a resource
* **500** `ServerErrorException`: application crashed

All of those exceptions are a subtype of `SscException` which provides
the possibility to add an error code:

```php
throw NotFoundException::make('No Product found for ID 42')
    ->withCode(4423)
;
```

## Want to know more?

* [copyright and MIT license](LICENSE)

You can find more information in the monorepo that groups all SSC libraries:
[ssc/lib](https://github.com/gnugat/ssc-lib/releases)

> _Note_: No contributions accepted in the libraries' individual repositories,
> Pull Requests and Issues should be submitted to the monorepo linked above instead.
