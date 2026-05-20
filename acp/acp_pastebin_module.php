<?php

/**
 *
 */

namespace phpbbde\pastebin\acp;

class acp_pastebin_module
{
    public $page_title;
    public $tpl_name;
    public $u_action;

    public function main()
    {
        $language = $phpbb_container->get('language');
        $this->tpl_name = 'acp_pastebin_settings';
        $this->page_title = $language->lang('PASTEBIN_NAV_TITLE') . ' - ' . $language->lang('PASTEBIN_NAV_CONFIG');

        $acp_controller = $phpbb_container->get('phpbbde.pastebin.controller.acp');
        $acp_controller->set_page_url($this->u_action);
        $acp_controller->module_settings();
    }
}
