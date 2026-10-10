<?php
/**
* @package pastebin
* @version 0.2.0
* @copyright (c) 2009 3Di (2007 eviL3), 2015 gn#36
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

namespace phpbbde\pastebin\functions;

class utility
{


	/**
	 * Constructor
	 * @param string $php_ext
	 * @param \phpbb\language\language	$language
	 * @param $pastebin_langs_table
	 */
	function __construct(
		protected $php_ext,
		protected \phpbb\language\language $language,
		protected \phpbb\db\driver\driver_interface $db,
		protected $pastebin_langs_table)
	{

	}

	/**
	 * Returns all file extensions from active languages (for uploading)
	 */
	public function get_allowed_extensions(): array
	{
		$exts = [];

		$sql = 'SELECT lang_file_extension
		FROM ' . $this->pastebin_langs_table . '
		WHERE lang_active = 1';
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			if (!empty($row['lang_file_extension']))
			{
				$exts[] = strtolower(ltrim($row['lang_file_extension'], '.'));
			}
		}
		$this->db->sql_freeresult($result);

		return array_values(array_unique($exts)) ?: ['txt'];
	}
}
