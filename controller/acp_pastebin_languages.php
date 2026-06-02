<?php

/**
 *
 */

namespace phpbbde\pastebin\controller;

class acp_pastebin_languages
{

	public function __construct(
		protected \phpbb\auth\auth $auth,
		protected \phpbb\db\driver\driver_interface $db,
		protected \phpbb\language\language $language,
		protected \phpbb\request\request_interface $request,
		protected \phpbb\template\template $template,
		protected $pastebin_lang_tables,
	)
	{
	}
	public function module_settings(): void
	{
		$sql = 'SELECT lang_id, lang_name, lang_name_clean, lang_active, lang_file_extension FROM ' . $this->pastebin_lang_tables .
				" ORDER BY lang_name_clean ASC";

		$result = $this->db->sql_query($sql);

		$this->db->sql_freeresult($result);

		while ($rows = $this->db->sql_fetchrow($result))
		{
			$this->template->assign_block_vars('langlist', [
				'LANG_ID' 				=> $rows['lang_id'],
				'LANG_NAME' 			=> $rows['lang_name'],
				'LANG_NAME_CLEAN' 		=> $rows['lang_name_clean'],
				'LANG_ACTIVE'			=> $rows['lang_active'],
				'LANG_FILE_EXTENSION' 	=> $rows['lang_file_extension'],
			]);
		};
	}
}
