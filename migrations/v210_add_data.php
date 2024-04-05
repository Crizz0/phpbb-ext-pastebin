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

class v210_add_data extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return array(
			'\phpbbde\pastebin\migrations\v210',
		);
	}

	public function update_data()
	{
		$data = [
			// Update version
			array('config.update', array('pastebin_version', '2.1.0')),
			// Add ACP module
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_PASTEBIN_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_PASTEBIN_TITLE',
				array(
					'module_basename'	=> '\phpbbde\pastebin\acp\pastebin_module',
					'modes'				=> array('pastebin_settings'),
				),
			)),
			array('module.add', array(
				'acp',
				'ACP_PASTEBIN_TITLE',
				array(
					'module_basename'	=> '\phpbbde\pastebin\acp\pastebin_module',
					'modes'				=> array('pastebin_languages'),
				),
			)),
			// Insert first data into new table pastebin_langs
			array('custom', array(array($this, 'insert_init_lang_data'))),
		];
		return $data;
	}

	public function insert_init_lang_data()
	{
		$init_lang_data = [
			[
				'lang_file_ext'	=> '',
				'lang_name'			=> 'Base',
				'lang_active'		=> 1,
			],
			[
				'lang_file_ext'	=> '',
				'lang_name'			=> 'Blade',
				'lang_active'		=> 1,
			],
			[
				'lang_file_ext'	=> 'css',
				'lang_name'			=> 'CSS',
				'lang_active'		=> 1,
			],
			[
				'lang_file_ext'	=> '',
				'lang_name'			=> 'DocComment',
				'lang_active'		=> 0,
			],
			[
				'lang_file_ext'	=> '',
				'lang_name'			=> 'GDScript',
				'lang_active'		=> 0,
			],
			[
				'lang_file_ext'	=> 'html,htm',
				'lang_name'			=> 'HTML',
				'lang_active'		=> 1,
			],
			[
				'lang_file_ext'	=> 'js',
				'lang_name'			=> 'JavaScript',
				'lang_active'		=> 1,
			],
			[
				'lang_file_ext'	=> 'json',
				'lang_name'			=> 'Json',
				'lang_active'		=> 1,
			],
			[
				'lang_file_ext'	=> 'php',
				'lang_name'			=> 'PHP',
				'lang_active'		=> 1,
			],
			[
				'lang_file_ext'	=> 'sql',
				'lang_name'			=> 'SQL',
				'lang_active'		=> 1,
			],
			[
				'lang_file_ext'	=> '',
				'lang_name'			=> 'Twig',
				'lang_active'		=> 0,
			],
			[
				'lang_file_ext'	=> 'xml',
				'lang_name'			=> 'XML',
				'lang_active'		=> 0,
			],
			[
				'lang_file_ext'	=> 'yaml,yml',
				'lang_name'			=> 'YAML',
				'lang_active'		=> 1,
			],
		];
		// Insert sample rule data
		$this->db->sql_multi_insert($this->table_prefix . 'pastebin_langs', $init_lang_data);
	}
}
