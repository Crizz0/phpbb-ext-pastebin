<?php

/**
 *
 */

namespace phpbbde\pastebin\controller;

class acp_pastebin_settings
{
	protected string $u_action;

    public function __construct(
		protected \phpbb\auth\auth $auth,
		protected \phpbb\config\config $config,
		protected \phpbb\db\driver\driver_interface $db,
		protected \phpbb\language\language $language,
		protected \phpbb\request\request_interface $request,
		protected \phpbb\template\template $template,
    )
    {

    }
    public function module_settings(): void
    {

		$form_name = 'acp_pastebin_settings';
		add_form_key($form_name);
		$error = '';

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_name))
			{
				$error = $this->language->lang('FORM_INVALID');
			}

			if (empty($error) && $this->request->is_set_post('submit'))
			{
				$this->config->set('pastebin_allow_secret_snippets', $this->request->variable('pastebin_allow_secret_snippets', false));
				$this->config->set('pastebin_default_prune_months', $this->request->variable('pastebin_default_prune_months', 0));

				trigger_error($this->language->lang('PASTEBIN_UPDATED') . adm_back_link($this->u_action));
			}
		}

		$this->template->assign_vars(array(
			'ERRORS'								=> $error,
			'U_ACTION'								=> $this->u_action,

			'PASTEBIN_ALLOWED_SECRET'						=> $this->config['pastebin_allow_secret_snippets'],
			'PASTEBIN_DEFAULT_PRUNE_MONTHS_VALUE'			=> $this->config['pastebin_default_prune_months'],
		));

    }
}
