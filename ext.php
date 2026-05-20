<?php

/**
 *
 * @package phpBB.de pastebin
 * @copyright (c) 2026 phpBB.de, Crizzo
 * @license https://opensource.org/license/gpl-2.0 GNU General Public License v2
 *
 */

namespace phpbbde\pastebin;

class ext extends \phpbb\extension\base
{
    public function is_enableable()
    {
        $valid_phpbb = phpbb_version_compare(PHPBB_VERSION, '3.3.16', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.4.0-dev', '<');
        $valid_php = phpbb_version_compare(PHP_VERSION, '8.4.0', '>=');

        return $valid_phpbb && $valid_php;
    }
}
