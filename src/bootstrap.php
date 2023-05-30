<?php

/**
 * This file is called at a higher priority and define critical settings.
 * It's done in composer.json in "include_files" key.
 * @see https://github.com/funkjedi/composer-include-files
 */

declare(strict_types=1);

/**
 * They don't use `functions_exists()` knowingly, to simplify the use of the CMS. The problem is
 * that when using other libraries like PHPUnit or Ray, Kirby's code is not necessarily loaded
 * first and this creates "Cannot redeclare" PHP errors. It is therefore mandatory to define the
 * constants in a file that is loaded first,like this one.
 *
 * @see https://github.com/getkirby/kirby/issues/4462
 * @see https://getkirby.com/docs/guide/troubleshooting/installation#php-cannot-redeclare-error
 * @see https://getkirby.com/docs/reference/objects/cms/helpers/has-override
 * @see https://getkirby.com/docs/reference/templates/helpers
 */
define('KIRBY_HELPER_DUMP', false);
