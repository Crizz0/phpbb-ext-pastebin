<?php
/**
 *
 * Pastebin extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 Crizzo <https://www.phpBB.de>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbde\pastebin\migrations;

class v300_salt extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['pastebin_salt']);
	}

	public static function depends_on()
	{
		return [
			'\phpbbde\pastebin\migrations\v300',
		];
	}

	public function update_data()
	{
		return [
			['config.add', ['pastebin_salt', $this->generate_salt(8), false]],
		];
	}

	protected function generate_salt($length = 8) : string
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$max = strlen($chars) - 1;
		$salt = '';

		for ($i = 0; $i < $length; $i++)
		{
			$salt .= $chars[random_int(0, $max)];
		}

		return $salt;
	}
}
