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
		// Get content of pastebin_langs to display the table
		$sql = 'SELECT lang_id, lang_name, lang_name_clean, lang_active, lang_file_extension FROM '
			. $this->pastebin_lang_tables .
			' ORDER BY lang_name_clean ASC';

		$result = $this->db->sql_query($sql);

		// Generate content structure for table
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

		// Get form input
		$form_name = 'ACP_PASTEBIN_LANG_SETTINGS';
		add_form_key($form_name);
		$error = '';

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_name))
			{
				$error = $this->language->lang('FORM_INVALID');
			}

			$sql = 'SELECT lang_id FROM ' . $this->pastebin_lang_tables;

			$result = $this->db->sql_query($sql);
			$rows = $this->db->sql_fetchrowset($result);
			$rows = array_column($rows, 'lang_id');

			if (empty($error) && $this->request->is_set_post('submit'))
			{
				// Grab checked checkboxes
				$activated_lang = $this->request->variable('lang_active', ['']);
				// Get not checked checkboxes via array diff
				$deactivated_lang = array_diff($rows, $activated_lang);
				// Make a loop for write lang_active = 1 for checked and 0 for not checked
				foreach ($activated_lang as $activate)
				{
					$this->change_lang_settings($activate, 1);
				}
				foreach ($deactivated_lang as $deactivate)
				{
					$this->change_lang_settings($deactivate, 0);
				}

				trigger_error($this->language->lang('ACP_PASTEBIN_LANGS_UPDATED') . adm_back_link($this->u_action));
			}
		}

		$this->template->assign_vars(array(
			'U_ACTION' => $this->u_action,
		));

		$this->db->sql_freeresult($result);
	}

	public function set_page_url(string $u_action): void
	{
		$this->u_action = $u_action;
	}

	private function change_lang_settings($lang_id, $lang_active): void
	{
		$sql = 'UPDATE ' . $this->pastebin_lang_tables . '
			SET lang_active=' . $lang_active. '
			WHERE lang_id = ' . (int) $lang_id;

		$result = $this->db->sql_query($sql);

		$this->db->sql_freeresult($result);
	}
}
