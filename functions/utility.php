<?php
/**
* @package pastebin
* @copyright (c) 2024 Crizzo
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

namespace phpbbde\pastebin\functions;

class utility
{
    /** @var string */
	protected $php_ext;

	/* @var \phpbb\language\language */
	protected $language;

    /* @var */
    protected $highlight_lang_dir;

	/**
	 * Constructor
	 * @param string $php_ext
	 * @param \phpbb\language\language	$language
	 */
	function __construct(
		$php_ext,
		\phpbb\language\language $language,
        $highlight_lang_dir
    )
	{
		$this->php_ext 		        = $php_ext;
		$this->language		        = $language;
        $this->highlight_lang_dir   = $highlight_lang_dir;
	}

	/**
	 * List of all available highlight languages
     * Scan languages dir: \pastebin\vendor\tempest\highlight\src\Languages
     * Each supported language has an own directory
	 */
	function highlight_list_avail_langs()
	{
        // Scan the directory of the highlight languages
       return array_diff(scandir($this->highlight_lang_dir), array('.', '..'));
       /* TODO filter result via ACP option, to only display activated languages,
        * in case this list will get really long in the future */
    }

	/**
	 * Highlight select box
	 */
	function highlight_select($default = 'text')
	{
		/** Create option menu for available languages
		 * Add them to the array $programming_langs
		 */
        $programming_langs = $this->highlight_list_avail_langs();

		$output = '';
		$lang_prefix = 'PASTEBIN_LANGS_';

		foreach ($programming_langs as $code)
		{
            $output .= '<option' . (($default == $code) ? ' selected ' : '') . ' value="' . htmlentities($code, ENT_QUOTES) . '">' . $this->language->lang($lang_prefix . strtoupper($code)) . '</option>';
        }

		return $output;
	}
}
