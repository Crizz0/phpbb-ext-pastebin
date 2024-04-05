<?php
/**
 *
 * Pastebin extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2024 Crizzo <https://www.phpBB.de>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbde\pastebin\acp;

class pastebin_info
{
	function module()
	{
		return array(
			'filename'	=> '\phpbbde\pastebin\acp\pastebin_info',
			'title'		=> 'ACP_PASTEBIN_TITLE',
			'modes'		=> array(
				'pastebin_settings'	=> array(
					'title' => 'ACP_PASTEBIN_SETTINGS',
					'auth' => 'ext_phpbbde/pastebin && acl_a_board',
					'cat' => array('ACP_PASTEBIN_TITLE')
				),
			),
		);
	}
}
