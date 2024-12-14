# How to contribute

Everybody should be able to help. Here's how you can make this project more
awesome:

1. [Fork it](https://github.com/gnugat/ssc-lib/fork_select)
2. improve it
3. submit a [pull request](https://help.github.com/articles/creating-a-pull-request)

Your work will then be reviewed as soon as possible (suggestions about some
changes, improvements or alternatives may be given).

Here's some tips to make you the best contributor ever:

* [Tests](#tests)
* [Keeping your fork up-to-date](#keeping-your-fork-up-to-date)
* [Monorepo Maintenance](#monorepo-maintainance)
* [Add a new Package](#add-a-new-package)

## Tests

Tests can be run using the following script:

```console
./bin/test.sh
```

It simply updates composer dependencies (with an optimized autoloading) and then
run the PHPUnit test suite.

## Keeping your fork up-to-date

To keep your fork up-to-date, you should track the upstream (original) one
using the following command:

```console
git remote add upstream https://github.com/gnugat/ssc-lib.git
```

Then get the upstream changes:

```console
git checkout main
git pull --rebase origin main
git pull --rebase upstream main
git checkout <your-branch>
git rebase main
```

Finally, publish your changes:

```console
git push -f origin <your-branch>
```

Your pull request will be automatically updated.

## Monorepo Maintenance

Instead of managing X packages each in their own repo, they're all being managed in `ssc/lib`, as a monorepo.

To help maintain the monorepo, we use the tool [monorepo-builder](https://github.com/symplify/monorepo-builder).

### bump-interdependency

When releasing a version for the monorepo (eg `4.0`), and we need to bump the packages that depend on it to version `^4.0`:

```console
vendor/bin/monorepo-builder bump-interdependency "^4.0"
```

### validate

Will check each packages, and make sure for those who depend on the same package that they also depend on the same version:

```console
vendor/bin/monorepo-builder validate
```

### split

This is done via Github Actions (and [claudiodekker/splitsh-action](https://github.com/claudiodekker/splitsh-action).

Check configuration at `.github/workflows/split_monorepo.yaml`.

### release

Will:

* create a new git tag
* push the new git tag

```console
vendor/bin/monorepo-builder release v7.0
```

Alternatively use `major`, `minor`, `patch` instead of the version number:

```console
vendor/bin/monorepo-builder release patch # if last version was `v7.0.1`, will release `v7.0.2`
```

## Add a new Package

### Libraries

To add a new library, first pick a name for it (ideally short, maybe one word).

Example:

* name: `Exception` (snake case: `exception`)
* composer package name: `ssc/exception`
* PHP namespace: `Ssc\Exception`

Next, create a new folder in `./packages` with the following tree structure:

```
./packages/exception/
├── .gitignore
├── .php-cs-fixer.dist.php
├── composer.json
├── phpspec.yml.dist
├── LICENSE
├── README.md
├── bin/test.sh
├── spec/
└── src/
```

Then, add a section in the root `phpspec.yml.dist`:

```yaml
suites:
    exception:
        src_path: packages/exception/src
        spec_path: packages/exception
```

After that, add a new line in the root `README.md`:

```
[...]

## Libraries

* [exception](./packages/exception/README.md)

[...]
```
Finally, require it in the root `composer.json`, using `*@dev` as a version:

```json
{
    "require": {
        "php": "^8.3",
        "ssc/exception": "*@dev"
    }
}
```

Don't forget to also add a line in the root `CHANGELOG.md`:

```
# CHANGELOG

## {{ new_version }}: Created `scc/exception`

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

[...]
```

Almost done, make sure to update couscous:

```yaml
menu:
    items:
        home:
            text: Home
            relativeUrl:
        exception:
            text: exception
            relativeUrl: packages/exception/README.html
``

Finally, add library to `.github/workflows/split_monorepo.yaml`:

```yaml
jobs:
    split_monorepo:            
        runs-on: ubuntu-latest 

        strategy:
            fail-fast: false
            matrix:
                package:
                    - exception
```
