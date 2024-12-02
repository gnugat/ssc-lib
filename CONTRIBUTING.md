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

## Monorepo Maintainance

Instead of managing X packages each in their own repo, they're all being managed in `ssc/lib`, as a monorepo.

To help maintain the monorepo, we use the tool [monorepo-builder](https://github.com/symplify/monorepo-builder).

### bump-interdependency

When releasing a version for the monorepo (eg `4.0`), and we need tu bump the packages that depend on it to version `^4.0`:

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
