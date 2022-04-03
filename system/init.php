<?php

/*
 *   (c) Semen Alekseev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

use FluffyDollop\Support\{Registry, Router, Templates};
use Mozg\modules\Lang;

$db = require ENGINE_DIR . '/data/db.php';
Registry::set('db', $db);

$config = settings_get();

//lang
$checkLang = Lang::getLang();

$lang = include ROOT_DIR . '/lang/' . $checkLang . '/site.php';
Registry::set('lang', $lang);

$register = new \FluffyDollop\Registry\Registry();
$register->set('lang', function () {
    return include ROOT_DIR . '/lang/' . Lang::getLang() . '/site.php';
});

$langdate = include ROOT_DIR . '/lang/' . $checkLang . '/date.php';

$tpl = new Templates();
$tpl->dir = ROOT_DIR . '/templates/' . $config['temp'];
define('TEMPLATE_DIR', $tpl->dir);

Registry::set('server_time', time());

include_once ENGINE_DIR . '/login.php';

if ($config['offline'] === 'yes') {
    include ENGINE_DIR . '/modules/offline.php';
}
/** @var array $user_info */
$user_info = $user_info ?? Registry::get('user_info');

if ($user_info['user_delet'] > 0) {
    include_once ENGINE_DIR . '/modules/profile_delet.php';
}
if ($user_info['user_ban_date'] >= Registry::get('server_time') || ($user_info['user_ban_date'] === '0')) {
    include_once ENGINE_DIR . '/modules/profile_ban.php';
}
//Если юзер авторизован, то обновляем последнюю дату посещения в таблице друзей и на личной стр
if (Registry::get('logged')) {
    //Начисления 1 убм.
    if (empty($user_info['user_lastupdate'])) {
        $user_info['user_lastupdate'] = 1;
    }
    $server_time = Registry::get('server_time');
    if (date('Y-m-d', $user_info['user_lastupdate']) < date('Y-m-d', $server_time)) {
        $sql_balance = ", user_balance = user_balance+1, user_lastupdate = '{$server_time}'";
    } else {
        $sql_balance = '';
    }
    //Определяем устройство
    $device_user = isset($check_smartphone) ? 1 : 0;
    if (empty($user_info['user_last_visit'])) {
        $user_info['user_last_visit'] = $server_time;
    }

    if (($user_info['user_last_visit'] + 60) <= $server_time) {
        $db->query("UPDATE LOW_PRIORITY `users` SET user_logged_mobile = '{$device_user}',
            user_last_visit = '{$server_time}' {$sql_balance} 
            WHERE user_id = '{$user_info['user_id']}'");
    }
}

//Время онлайн
$online_time = Registry::get('server_time') - $config['online_time'];

$router = Router::fromGlobals();
$params = [];
$routers = [
    '/' => 'Register@main',

    '/register/send' => 'Register@send',
    '/register/rules' => 'Register@rules',
    '/register/step2' => 'Register@step2',
    '/register/step3' => 'Register@step3',
    '/register/activate' => 'Register@activate',
    '/register/finish' => 'Register@finish',
    '/login' => 'Register@login',

    '/u:num' => 'Profile@main',
    '/u:numafter' => 'Profile@main',
    '/public:num' => 'Communities@main',
    //restore
    '/restore' => 'Restore@main',
    '/restore/next' => 'Restore@next',
    '/restore/next/' => 'Restore@next',
    '/restore/send' => 'Restore@send',
    '/restore/prefinish' => 'Restore@preFinish',

    '/wall:num' => 'WallPage@main',
    '/wall:num_:num' => 'WallPage@main',

    '/security/img' => 'Captcha@captcha',
    '/security/code' => 'Captcha@code',

    '/langs/box' => 'Lang@main',
    '/langs/change' => 'Lang@change',
    '/balance' => 'Balance@main',

    '/balance/payment_2' => 'Balance@payment_2',
    '/balance/ok_payment' => 'Balance@ok_payment',

    '/balance/payment' => 'Balance@createOrderBox',//1
    '/pay/test/create/' => 'Balance@payCreateTest',//2
    '/pay/fkw/create/' => 'Balance@payCreateFkw',//2
    '/pay/test/' => 'Balance@payMain',//3
    '/pay/test/success/' => 'Balance@payTestSuccess',//4

    '/pay/fw/check/' => 'Balance@checkFWKassa',

    '/pay/fw/success/' => 'Balance@main',//4
    '/pay/fkw/success/' => 'Balance@main',//4
    '/pay/fw/bad/' => 'Balance@main',//4
    '/pay/fkw/bad/' => 'Balance@main',//4
];
$router->add($routers);
try {
    if ($router->isFound()) {
        $router->executeHandler($router::getRequestHandler(), $params);
    } else {
        //todo update
        $module = isset($_GET['go']) ?
            htmlspecialchars(strip_tags(stripslashes(trim(urldecode($_GET['go']))))) : 'main';
        $action = requestFilter('act');
        $class = ucfirst($module);
        if (!class_exists($class) || $action === '' || $class === 'Wall') {
            include_once ENGINE_DIR . '/mod.php';
        } else {
            $controller = new $class();
            $params['params'] = '';
            $params = [$params];
            try {
                return call_user_func_array([$controller, $action], $params);
            } catch (Error $error) {
                var_dump($error);
            }
        }
    }
} catch (Error $error) {
    if ($user_info['user_group'] === 1) {
        var_dump($error);
        exit();
    }
    include_once ENGINE_DIR . '/mod.php';
}
