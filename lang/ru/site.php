<?php

@setlocale(LC_ALL, 'ru');

return [
    'lang' => 'Русский',
    'main_tpl_people' => 'люди',
    'main_tpl_lang_1' => 'сообщества',
    'main_music' => 'музыка',
    'main_support' => 'Помощь',
    'main_logout' => 'выйти',
    'main_signup' => 'регистрация',
    'lang_toltip' => 'Выбор используемого языка на сайте',

    'welcome' => 'Добро пожаловать',
    'meta_tegtitle' => 'Регистрация',
    'code_none' => '<li><span>Код безопасности не соответствует отображённому</span></li>',
    'nosymbol' => 'Специальные символы в поле "Имя" запрещены',
    'nosymbol_lastname' => 'Специальные символы в поле "Фамилия" запрещены',
    'nosymbol_email' => 'Неправильный формат электронного адреса',
    'noempty' => 'Укажите Ваше имя',
    'noempty_lastname' => 'Укажите Вашу фамилию',
    'noempty_email' => 'Укажите Ваш электронный адрес',
    'smallsymbol' => 'Имя должно быть не менее 2 символов',
    'smallsymbol_lastname' => 'Фамилия должна быть не менее 2 символов',
    'smallsymbol_pass' => 'Пароль должен быть не менее 6 символов',
    'no_pass_check' => 'Оба введенных пароля должны совпадать',
    'error' => 'Ошибка',
    'not_loggin' => 'Внимание, вход на сайт не был произведен. Возможно, Вы ввели неверный логин или пароль.',
    'not_logged' => 'Чтобы просматривать эту страницу, нужно зайти на сайт.',
    'no_str_bar' => 'Неизвестная ошибка',

    'thanks_reg' => 'Благодарим Вас за регистрацию',

    'no_infooo' => 'Информация',

    'title_albums' => 'Альбомы',
    'my_albums' => 'Мои Альбомы',
    'add_photo' => 'Добавление фотографий',
    'add_photo_2' => 'Добавление фотографий в альбом ',
    'all_photos' => 'Фотографии',
    'online' => 'Online',
    'comm_form_album' => 'Комментарии к альбому',
    'comm_form_album_all' => 'Комментарии к альбомам',
    'no_comments' => '<br /><br />Комментариев пока нет.<br /><br /><br />',
    'no_photos' => 'Нет фотографий.',
    'editphotos' => 'Изменение порядка фотографий',
    'no_photo_alnumx' => '<div align="center" style="padding-top:10px;color:#777;font-size:13px;">В альбоме нет фотографий.</div>',

    'hacking' => 'Попытка взлома!',

//Альбомы
    'no_albums' => '<br /><br />Пока нет ни одного фотоальбома.<br /><br /><br />',

// Редактирование страницы
    'editmyprofile' => 'Редактирование моей страницы',
    'editmyprofile_genereal' => 'Основное',
    'editmyprofile_contact' => 'Контакты',
    'editmyprofile_interests' => 'Интересы',

// Друзья
    'friends' => 'Друзья',
    'no_requests' => 'Ни одного друга не найдено.',
    'no_requests_online' => 'Ни одного друга на сайте не найдено.',

// Профиль
    'no_upage' => 'Страница удалена, либо еще не создана.',

// Закладки
    'fave' => 'Закладки',
    'no_fave' => 'Вы можете добавлять сюда страницы интересных Вам людей.<br />Из этого раздела у Вас всегда будет быстрый доступ к ним.',

// Сообщения
    'no_msg' => '<br /><br />У Вас нет ни одного сообщения..<br /><br /><br />',
    'no_outbox_msg' => '<br /><br />Вы не отправили ни одного сообщения..<br /><br /><br />',
    'none_msg' => 'Сообщение не найдено.',
    'msg_inbox' => 'Полученные сообщения',
    'msg_outbox' => 'Отправленные сообщения',
    'msg_view' => 'Просмотр сообщения',

// Замтетки
    'no_notes' => 'Ошибка доступа.',
    'title_notes' => 'Заметки',
    'notes_my' => 'Мои заметки',
    'notes_view' => 'Просмотр заметки',
    'add_new_note' => 'Создание новой заметки',
    'note_no_comments' => 'Нет комментариев',
    'note_edit' => 'Редактирование записи',
    'note_no' => 'Не найдено ни одной заметки.',
    'note_no_user' => 'С помощью заметок Вы можете делиться событиями из жизни с друзьями, а также быть в курсе того, что нового происходит у них.<br /><br /><a href="/notes/add" onClick="Page.Go(this.href); return false;">Создать заметку</a>',

//Видео
    'videos' => 'Видеозаписи',
    'videos_none' => 'еще не загрузил ни одной видеозаписи.',
    'videos_none_page' => 'Ни одной видеозаписи на сайте не найдено.',
    'videos_nones_videos_user' => 'Вы можете хранить неограниченное количество видеофайлов.<br /><br />Для того, чтобы добавить Ваш первый видеоматериал, <a href="/" onClick="videos.add(); return false">нажмите сюда.</a>',
    'videos_box_none' => '<div align="center" style="padding-top:10px;color:#777;font-size:13px;">У вас нет ни одной видеозаписи.</div>',

//Поиск
    'search' => 'Результаты поиска',
    'search_none' => 'Ваш запрос не дал результатов.',

//Настройки
    'settings' => 'Настройки',
    'settings_nobaduser' => '<br /><br /><br /><br />В Вашем черном списке еще нет пользователей.<br /><br />Вы можете добавить любого человека, чтобы он не мог просматривать Вашу страницу, а также оставлять комментарии к Вашим материалам и отправлять Вам личные сообщения.<br /><br /><br /><br />',

//Новости
    'news_title' => 'Новости',
    'news_updates' => 'Обновления',
    'news_photos' => 'Фотографии',
    'news_notifications' => 'Ответы',
    'news_videos' => 'Видеозаписи',
    'news_speedbar' => 'Показаны последние новости',
    'news_speedbar_notifications' => 'Показаны последние ответы',
    'news_speedbar_photos' => 'Показаны последние фотографии',
    'news_speedbar_videos' => 'Показаны последние видеозаписи',
    'news_none' => 'Здесь Вы будете видеть новостную ленту своих друзей.',
    'news_none_notifica' => 'Здесь Вы будете видеть упоминания, новые комментарии и отметки «Мне нравится».',
    'news_none_photos' => 'Ни одной свежей фотографии не найдено.',
    'news_none_videos' => 'Ни одной свежей видеозаписи не найдено.',
    'news_none_updates' => 'Нет ни одного обновления.',

//Стена
    'wall_no_rec' => '<br /><br />На стене пока нет ни одной записи.<br /><br /><br />',
    'wall_no_rec_2' => '<br /><br />Запись не найдена<br /><br /><br />',
    'wall_title' => 'Стена',

//Помощь
    'support_title' => 'Помощь по сайту',
    'support_no_quest' => 'Вопрос не найден.',
    'support_no_quest2' => '<br /><br />Вы пока что не задавали вопросов.<br /><br /><br />',
    'support_no_quest3' => '<br /><br />Пока что никто не задавал вопросов.<br /><br /><br />',

//Восстановление доступа к странице
    'restore_title' => 'Восстановление доступа к странице',
    'restore_badlink' => 'Эта ссылка на восстановление пароля устарела.',
    'lost_subj' => 'Восстановление доступа к странице',

//Блог сайта
    'blog_title' => 'Блог',
    'blog_descr' => 'Новости сайта',

//Баланс
    'balance' => 'Личный счёт',

//Подарки
    'gifts' => 'Подарки',

//Сообщества
    'communities' => 'Сообщества',
    'public_spbar' => 'Страница',

//Музыка
    'audio' => 'Аудиозаписи',
    'audio_none' => 'У Вас еще нет аудиозаписей',
    'audio_box_none' => '<div align="center" style="padding-top:10px;color:#777;font-size:13px;">У Вас еще нет аудиозаписей.</div>',

    'up' => 'Наверх',
    'site_desc' => 'Универсальное средство для общения и поиска людей.',
    'login' => 'Войти',
    'by_people' => 'по людям',

];