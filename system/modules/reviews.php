<?php
/*
 *   (c) Semen Alekseev
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */
if(!defined('MOZG'))
	die('Hacking attempt!');

if(!empty($_POST['ajax']) AND $_POST['ajax'] == 'yes')
	NoAjaxQuery();

$act = $_GET['act'] ?? '';

switch($act){
		
	//################### Добавление отзыва ###################//
	case "send":
		
		NoAjaxQuery();
		
		$text = requestFilter('text');
		
		if(!empty($text) AND $logged){
			
			//Вставляем в базу
			$db->query("INSERT INTO `".PREFIX."_reviews` SET user_id = '{$user_info['user_id']}', text = '{$text}', date = '{$server_time}', approve = 1");
			
		}
		
		exit();
		
	break;
		
		//################### Вывод всех отзывов ###################//
		default:

//            $tpl->load_template('info.tpl');
//            $tpl->compile('content');
//            exit();

			$limit_num = 25;
			if(isset($_POST['page_cnt']) AND $_POST['page_cnt'] > 0)
                $page_cnt = intval($_POST['page_cnt']) * $limit_num;
			else
                $page_cnt = 0;
			
			//Если вызваны пред.
			if($page_cnt){
				NoAjaxQuery();
			}
			
			//Верх
			if( $page_cnt == 0){
				$tpl->load_template('reviews/main.tpl');
				if(isset($logged) AND $logged){
					$tpl->set('[logged]','');
					$tpl->set('[/logged]','');
					$tpl->set_block("'\\[not-logged\\](.*?)\\[/not-logged\\]'si","");
				} else {
					$tpl->set('[not-logged]','');
					$tpl->set('[/not-logged]','');
					$tpl->set_block("'\\[logged\\](.*?)\\[/logged\\]'si","");
				}
				$tpl->compile('content');
			}
			
			//Выводим отзывы
			$sql_ = $db->super_query("SELECT tb1.user_id, text, date, tb2.user_search_pref, user_photo FROM `".PREFIX."_reviews` tb1, `".PREFIX."_users` tb2 WHERE tb1.user_id = tb2.user_id AND approve = '0' ORDER by `date` DESC LIMIT {$page_cnt}, {$limit_num}", 1);

			if($sql_){
				$tpl->load_template('reviews/review.tpl');
				foreach($sql_ as $row){
					$tpl->set('{name}', $row['user_search_pref']);
					$tpl->set('{user_id}', $row['user_id']);
					$tpl->set('{text}', stripslashes($row['text']));
					megaDate($row['date']);
					
					if($row['user_photo'])
						$tpl->set('{ava}', '/uploads/users/'.$row['user_id'].'/50_'.$row['user_photo']);
					else
						$tpl->set('{ava}', '{theme}/images/no_ava_50.png');
					
					$tpl->compile('content');
					
				}
				$num = count($sql_);
			}else{
                $num = 0;
            }
			
			//Низ
			if($limit_num < $num AND !$page_cnt){
				$tpl->load_template('reviews/bottom.tpl');
				$tpl->compile('content');
			}



			//Если вызваны пред.
			if($page_cnt){
				
				AjaxTpl();
				
				exit();
				
			}
		
	}
	
$tpl->clear();
$db->free();
