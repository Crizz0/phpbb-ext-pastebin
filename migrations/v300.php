<?php
/**
 *
 * Pastebin extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 Crizzo <https://www.phpBB.de>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbde\pastebin\migrations;

class v300 extends \phpbb\db\migration\migration
{
    public static function depends_on()
    {
        return array(
            '\phpbbde\pastebin\migrations\v206',
        );
    }

    public function update_schema()
    {
        return [
            'add_columns' => [
                $this->table_prefix . 'pastebin' => [
                    'snippet_private'   => ['BOOL', false],
                    'snippet_hash'      => ['VCHAR:64', ''],
                ]
            ]
        ];
    }

    public function update_data()
    {
        $data = array(
            // Update version
            array('config.update', array('pastebin_version', '3.0.0')),
        );
        return $data;
    }
}
