<?php
/**
 *
 * Pastebin extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2024 Crizzo <https://www.phpBB.de>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbde\pastebin\migrations;

class v210 extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return array(
			'\phpbbde\pastebin\migrations\v206',
		);
	}
	/**
	 * Add the pastebin lang schema to the database:
	 *    pastebin_langs:
	 *        lang_id
	 *        file_extension
	 *        lang_name
	 *        lang_active
	 *
	 * @return array Array of table schema
	 * @access public
	 */
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'pastebin_langs'	=> array(
					'COLUMNS'	=> array(
						'lang_id'			=> array('UINT', null, 'auto_increment'),
						'lang_file_ext'		=> array('VCHAR:100', ''),
						'lang_name'			=> array('VCHAR:100', ''),
						'lang_active'		=> array('BOOL', 0),
					),
					'PRIMARY_KEY'	=> 'lang_id',
				),
			),
		);
	}

	/**
	 * Drop the pastebin_langs table schema from the database
	 *
	 * @return array Array of table schema
	 * @access public
	 */
	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'pastebin_langs',
			),
		);
	}
}
