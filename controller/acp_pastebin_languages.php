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
		$sql = 'SELECT lang_id, lang_name, lang_name_clean, Lang_active, lang_file_extension FROM ' . $this->pastebin_lang_tables . "
					ORDER BY lang_id ASC";

		$result = $this->db->sql_query($sql);

		$this->db->sql_freeresult($result);

		while ($rows = $this->db->sql_fetchrow($result))
		{
			$template->assign_block_vars('loopname', [
				'FOO' => $row['foo'],
				'BAR' => $row['bar']
			]);
		};



		$this->template->assign_vars([

		]);

	}
}
