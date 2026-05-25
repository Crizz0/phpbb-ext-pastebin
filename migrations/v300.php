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

class v300 extends \phpbb\db\migration\migration
{
    public static function depends_on()
    {
        return array(
            '\phpbbde\pastebin\migrations\pastebin',
            '\phpbbde\pastebin\migrations\v206',
        );
    }

    public function update_schema()
    {
        return [
            'add_columns' => [
                $this->table_prefix . 'pastebin' => [
                    'snippet_private'   => ['BOOL', 0],
                    'snippet_hash'      => ['VCHAR:64', ''],
                ]
            ],
            'add_tables'	=> [
                $this->table_prefix . 'pastebin_langs'	=> [
                    'COLUMNS'	=> [
                        'lang_id'						=> ['UINT', null, 'auto_increment'],
                        'lang_name'					    => ['VCHAR:100', ''],
                        'lang_name_clean'				=> ['VCHAR:100', ''],
                        'lang_active'					=> ['BOOL', 0],
                    ],
                    'PRIMARY_KEY'	=> 'lang_id',
                ],
            ],
        ];
    }

    public function update_data()
    {
        return [
            ['custom', [[$this, 'add_langs_for_highligher']]],
            // Add new module to ACP
            ['module.add', [
                'acp',
                'ACP_CAT_DOT_MODS', 'ACP_PASTEBIN_TITLE'],
            ],
            ['module.add', [
                'acp',
                'ACP_PASTEBIN_TITLE', [
                    'module_basename' => '\phpbbde\pastebin\acp\acp_pastebin_module',
                    'modes' => ['settings'],
                ]
            ]],
            // Update version
            ['config.update', ['pastebin_version', '3.0.0']],
        ];
    }

    public function add_langs_for_highligher()
    {
        $data = [
            ['Apache', 'apache', '0'],
            ['BBCode', 'bbcode', '1'],
            ['Base', 'base', '0'],
            ['Bash', 'bash', '1'],
            ['Blade', 'blade', '0'],
            ['CSS', 'css', '1'],
            ['Diff', 'diff', '1'],
            ['DocComment', 'doc', '0'],
            ['DockerFile', 'dockerfile', '0'],
            ['DotEnv', 'dotenv', '0'],
            ['Ellison', 'ellison', '0'],
            ['GDscript', 'gdscript', '0'],
            ['Graphql', 'graphql', '0'],
            ['HTML', 'html', '1'],
            ['Ini', 'ini', '1'],
            ['JavaScript', 'js', '1'],
            ['JSON', 'json', '1'],
            ['Markdown', 'markdown', '1'],
            ['Nginx', 'nginx', '1'],
            ['PHP', 'php', '1'],
            ['Python', 'python', '1'],
            ['SCSS', 'scss', '1'],
            ['SQL', 'sql', '1'],
            ['Svelte', 'svelte', '1'],
            ['Terminal', 'terminal', '1'],
            ['Terraform', 'terraform', '0'],
            ['Text', 'text', '1'],
            ['Twig', 'twig', '1'],
            ['TypeScript', 'ts', '0'],
            ['XML', 'xml', '1'],
            ['YAML', 'yaml', '1'],
        ];

        foreach ($data as $langs)
        {
            $sql_ary[] = [
                'lang_name' 		=> $langs[0],
                'lang_name_clean' 	=> $langs[1],
                'lang_active' 		=> $langs[2],
            ];
        }

        $this->db->sql_multi_insert($this->table_prefix . 'pastebin_langs', $sql_ary);
    }

    public function revert_schema()
    {
        return [
            'drop_tables'        => [
                $this->table_prefix . 'pastebin_langs',
            ],
        ];
    }
}
