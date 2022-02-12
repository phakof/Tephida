<?php
/*
 *   (c) Semen Alekseev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */
if (!defined('MOZG'))
    die('Hacking attempt!');

NoAjaxQuery();

if ($logged) {
    $alt_name = $db->safesql(to_translit($_GET['page']));
    $row = $db->super_query("SELECT title, text FROM `static` WHERE alt_name = '" . $alt_name . "'");
    if ($row) {
        $tpl->load_template('static.tpl');
        $tpl->set('{alt_name}', $alt_name);
        $tpl->set('{title}', stripslashes($row['title']));
        $tpl->set('{text}', stripslashes($row['text']));
        $tpl->compile('content');
    } else
        msgbox('', 'Страница не найдена.', 'info_2');

    $tpl->clear();
    $db->free();
} else {
    $user_speedbar = $lang['no_infooo'];
    msgbox('', $lang['not_logged'], 'info');
}
?>