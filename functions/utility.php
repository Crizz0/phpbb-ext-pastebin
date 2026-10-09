<?php
/**
* @package pastebin
* @version 0.2.0
* @copyright (c) 2009 3Di (2007 eviL3), 2015 gn#36
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

namespace phpbbde\pastebin\functions;
// TODO: this won't be needed any longer
class utility
{
	/** @var string */
	protected $php_ext;

	/* @var \phpbb\language\language */
	protected $language;

	/**
	 * Constructor
	 * @param string $php_ext
	 * @param \phpbb\language\language	$language
	 */
	function __construct(
		$php_ext,
		\phpbb\language\language $language)
	{
		$this->php_ext 		= $php_ext;
		$this->language		= $language;
	}
}
