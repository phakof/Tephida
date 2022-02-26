<?php
/*
 *   (c) Semen Alekseev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

namespace Mozg\classes;

use JsonException;

class TplCp extends Templates
{
    public array $meta_tags = array(
        'title' => 'Панель управления',
    );

    public function __construct(string $dir = '.', array $meta_tags = array())
    {
        $this->dir = $dir;
        if (!empty($meta_tags['title'])) {
            $this->meta_tags['title'] = $meta_tags['title'];
        }
        define('TEMPLATE_DIR', $dir);
    }

    /**
     * @throws \ErrorException|JsonException
     */
    final public function render(): int
    {
        $this->load_template('main.tpl');
        $config = settings_load();
        $admin_link = $config['home_url'] . $config['admin_index'];
        if (Registry::get('logged')) {
            $stat_lnk = "<a href=\"{$admin_link}?mod=stats\" onclick=\"Page.Go(this.href); return false;\" style=\"margin-right:10px\">статистика</a>";
            $exit_lnk = "<a href=\"{$admin_link}?act=logout\" onclick=\"Page.Go(this.href); return false;\">выйти</a>";
        } else {
            $stat_lnk = '';
            $exit_lnk = '';
        }
        $box_width = 800;
        $this->set('{admin_link}', $admin_link);
        $this->set('{box_width}', $box_width);
        $this->set('{stat_lnk}', $stat_lnk);
        $this->set('{exit_lnk}', $exit_lnk);
        $this->set('{content}', $this->result['content']);
        $this->compile('main');
        if (requestFilter('ajax') === 'yes') {
            return $this->compileAjax();
        }
        return $this->compileNoAjax();
    }

    /**
     * @throws JsonException
     */
    private function compileAjax(): int
    {
        $title = $this->meta_tags['title'];
        $result_ajax = array(
            'title' => $title,
            'content' => $this->result['info'] . $this->result['content']
        );
        return print(_e_json($result_ajax));
    }

    private function compileNoAjax(): string
    {
        return print($this->result['main']);
    }

}