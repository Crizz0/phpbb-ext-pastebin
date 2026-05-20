<?php

/**
 *
 */

namespace phpbbde\pastebin\acp;

class acp_pastebin_info
{
    function module()
    {
        return [
            'filename'	=> 'phpbbde\pastebin\acp\acp_pastebin_module_info',
            'title'		=> 'PASTEBIN_NAV_TITLE',
            'modes'     => [
                'settings' => [
                    'title'     => 'PASTEBIN_NAV_CONFIG',
                    'auth'      => 'ext_phpbbde/pastebin && acl_a_board',
                    'cat'       => ['ACP_PASTEBIN_TITLE']
                ],
            ],
        ];
    }
}
