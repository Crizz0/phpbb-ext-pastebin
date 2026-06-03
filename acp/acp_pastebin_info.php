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
			'filename' => 'phpbbde\pastebin\acp\acp_pastebin_module',
			'title' => 'PASTEBIN_NAV_TITLE',
			'modes' => [
				'settings' => [
					'title' => 'PASTEBIN_NAV_CONFIG',
					'auth' => 'ext_phpbbde/pastebin && acl_a_pastebin',
					'cat' => ['ACP_PASTEBIN_TITLE']
				],
				'languages' => [
					'title' => 'PASTEBIN_NAV_LANGS',
					'auth' => 'ext_phpbbde/pastebin && acl_a_pastebin',
					'cat' => ['ACP_PASTEBIN_TITLE']
				],
			],
		];
	}
}
