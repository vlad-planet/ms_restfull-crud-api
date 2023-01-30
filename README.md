microservices
 
## Создание базового интерфейса Restful Crud API для подключения к микросервису

В производственной среде дополнительно используется: безопасность, кэширование, контроль доступа

Требования к Запуску Теста:<br>
- Composer<br>
- ^PHP7<br>
- PHP Sockets Extensions Installed<br>

1. Перейдите в корневой каталог
2. Запустите composer install для установки необходимых пакетов
3. Откройте две вкладки в вашей консоли
4. На одной вкладке нам нужно запустить php-сервер: php -S 127.0.0.1:8080
5. На другой вкладке запустите: php client.php

___________________________________________________________________________________________

Отправка данных на стороне клиента
```php
$curl = new Curl($host);

$curl->send('put',array('id' => '2', 'title' => 'All About Me'));

echo $curl->getResponse();
```

Обработка данных на стороне сервера
```php
//Create And Process The Current Request
$request = new Request();

//Get The Request Method(GET, POST, PUT, DELETE)
$method = strtolower($request->getRequestMethod());

//Data From The Request
$data = $request->getRequestData('array');
```
