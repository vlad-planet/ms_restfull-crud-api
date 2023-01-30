<?php

include ('vendor/autoload.php');

use prodigyview\network\Request;
use prodigyview\network\Response;

//Создание макетных данных
$articles = array(
	1 => array('title' => 'Little Red Riding Hood', 'description' => 'A sweet innocent girl meets a werewolf'),
	2 => array('title' => 'Snow White and the Seven Dwarfs', 'description' => 'A sweet girl, a delicious apple, and lots of little men.'),
	3 => array('title' => 'Gingerbread Man', 'description' => 'A man who actively avoids kitchens and hungry children.'),
);

//Создать и обработайть текущий запрос
$request = new Request();

//Получить метод запроса(GET, POST, PUT, DELETE)
$method = strtolower($request->getRequestMethod());

//Извлечь данные из запроса
$data = $request->getRequestData('array');

//Перенаправить запрос
switch ($method) {
    case 'get':
				get($data);
				break;
    case 'post':
				post($data);
				break;
    case 'put':
				put($data);
				break;
    case 'delete':
				delete($data);
				break;				
}

/**
 * Отображение данных в соответствии с запросом
 */
function get($data) {
	
	global $articles;
	
	$response  = array();
	
	if(isset($data['id']) && isset($articles[$data['id']])) {
		$response = $articles[$data['id']];
	} else {
		$response = $articles;
	}
	
	echo Response::createResponse(200, json_encode($response));
	exit();
};

/**
 * Добавление переданных данных
 */
function post($data) {
	
	global $articles;
	
	$response  = array();
	
	if(isset($data['title']) && isset($data['description'])) {
		$articles[] = $data;
		$response = array('status' => 'Article Successfully Added');
	} else {
		$response = array('status' => 'Unable To Add Article');
	}
	
	echo Response::createResponse(200, json_encode($response));
	exit();
};

/**
 * Обновление данные в соотвествии с переданными параметрами
 */
function put($data) {
	
	global $articles;
	parse_str($data,$data);
	
	$response  = array();
	
	if(isset($data['id']) && isset($articles[$data['id']])) {
		
		if(isset($data['title'])) {
			$articles[$data['id']]['title'] = $data['title'];
		}
		
		if(isset($data['description'])) {
			$articles[$data['id']]['description'] = $data['description'];
		}
		
		$response = array('status' => 'Article Successfully Updated', 'content' => $articles[$data['id']]);
	} else {
		$response = array('status' => 'Unable To Update Article');
	}
	
	echo Response::createResponse(200, json_encode($response));
	exit();
};

/**
 * Удаление данных в соотвествии с переданными параметрами
 */
function delete($data) {
	
	global $articles;
	parse_str($data,$data);
	
	$response  = array();
	
	if(isset($data['id']) && isset($articles[$data['id']])) {
		
		unset($articles[$data['id']]);
		
		$response = array('status' => 'Article Deleted', 'content' => $articles);
	} else{
		$response = array('status' => 'Unable To Delete Article');
	}
	
	echo Response::createResponse(200, json_encode($response));
	exit();
};
