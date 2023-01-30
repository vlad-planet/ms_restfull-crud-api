<?php

include('vendor/autoload.php');

use prodigyview\network\Curl;


$host = '127.0.0.1:8080/server.php';

echo "\nStarting RESTFUL Tests\n\n";

//Запросить все истории
$curl = new Curl($host);
$curl-> send('get');
echo $curl->getResponse();
echo "\n\n";

//Запросить одну историю соотвествующую индификатору
$curl = new Curl($host);
$curl-> send('get', array('id'=>1));
echo $curl->getResponse();
echo "\n\n";

//Создать историю: Запрос с провалом
$curl = new Curl($host);
$curl-> send('post',array('create_not_title' => 'not found'));
echo $curl->getResponse();
echo "\n\n";

//Создать историю
$curl = new Curl($host);
$curl-> send('post',array('title' => 'Robin Hood', 'description' => 'Steal from the rich and give to me.'));
echo $curl->getResponse();
echo "\n\n";

//Обновлить историю
$curl = new Curl($host);
$curl-> send('put',array('id' => '2', 'title' => 'All About Me'));
echo $curl->getResponse();
echo "\n\n";

//Удалить историю: Запрос с провалом
$curl = new Curl($host);
$curl-> send('delete',array('delete_not_id' => 'me'));
echo $curl->getResponse();
echo "\n\n";

//Удалить историю
$curl = new Curl($host);
$curl-> send('delete',array('id' => 1));
echo $curl->getResponse();
echo "\n\n";