# codebeast
## Purpose
Package is used to automate code quality control during the development process and git workflow. 
It installs dependencies such as: phpcs, phpcbf, phpmd and configures pre-commit git hook according to user preferences. Pre-commit git hook is executed right before the commit is created, thus the code, added to commit is checked against syntax errors, violation of code standards and violation of some structural standards (phpmd).

## Usage
To configure git hook and generate settings file, use following command:
```
vendor/bin/codebeast configure
```
Configure command generates pre-commit.settings file, which can be added to the repository, so every team member have the same settings within the project. Configure command also suggest to install the hook.

To install the hook follow the wizard of 'configure' command or run following:
```
vendor/bin/codebeast install
```
Install command sets the path (absolute) to your vendor folder and creates pre-commit hook file in target .git directory.

## Configuration
Package is shipped with phpmd configuration in [minimal.xml](https://github.com/colours/codebeast/blob/master/src/Tools/MD/Config/minimal.xml) file. You can use your own phpmd config, by creating settings file according to [documentation](https://phpmd.org/documentation/creating-a-ruleset.html).
