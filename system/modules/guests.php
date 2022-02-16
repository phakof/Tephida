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

if (Registry::get('logged')) {
    $user_info = $user_info ?? Registry::get('user_info');
    $user_id = $user_info['user_id'];
    $db = Registry::get('db');
    $metatags['title'] = 'Гости';
    $user_speedbar = 'Гости';

    $page = intFilter('page', 1);

    $gcount = 1;
    $limit_page = ($page - 1) * $gcount;

    $sql_ = $db->super_query("SELECT SQL_CALC_FOUND_ROWS tb1.guid, gdate, new, tb2.user_search_pref, user_photo FROM `guests` tb1, `users` tb2 WHERE tb1.guid = tb2.user_id AND tb1.ouid = '{$user_id}' ORDER by `gdate` DESC LIMIT {$limit_page}, {$gcount}", true);

    if ($sql_) {

        $num = $db->super_query("SELECT COUNT(*) AS cnt FROM `guests` WHERE ouid = '{$user_id}'");

        $tpl->load_template('guests/user.tpl');

        foreach ($sql_ as $row) {

            $tpl->set('{name}', $row['user_search_pref']);
            $tpl->set('{user-id}', $row['guid']);

            if ($row['new'])
                $tpl->set('{color}', 'style="color:#222"');
            else
                $tpl->set('{color}', '');

            $date_str = megaDate($row['gdate']);
            $tpl->set('{date}', $date_str);
            if ($row['user_photo'])
                $tpl->set('{ava}', "/uploads/users/{$row['guid']}/100_{$row['user_photo']}");
            else
                $tpl->set('{ava}', "{theme}/images/100_no_ava.png");

            $tpl->compile('content');

        }

        navigation($gcount, $num['cnt'], $config['home_url'] . '?go=guests&page=');

        //Убираем новых гостей
//		$db->query("UPDATE `".PREFIX."_guests` SET new = '0' WHERE ouid = '{$user_id}' AND new = '1'");

//		$db->super_query("UPDATE `".PREFIX."_users` SET guests = '0' WHERE user_id = '{$user_id}'");

    } else
        msgbox('', '<br /><br />К Вам пока что никто не заходил.<br /><br /><br />', 'info_2');

    $tpl->clear();
    $db->free();

} else {

    $user_speedbar = $lang['no_infooo'];
    msgbox('', $lang['not_logged'], 'info');

}