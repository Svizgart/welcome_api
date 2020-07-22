## Развертывание проекта


Команды после клонирования репозитория: 
- `composer install`
- `php artisan migrate --seed`
- `php artisan passport:install`
- `php artisan config:cache`
- `./vendor/bin/phpunit  (Запуск тестов)`
- `php artisan queue:work  (Запуск воркера очередей)`

## .env`

`APP_DEBUG=` - указать false

`DB_DATABASE=` - назв. базы бвнных

`DB_USERNAME=` - пользователь БД
 
`DB_PASSWORD=` - пароль пользователь БД 

`QUEUE_CONNECTION=` - указать нужный драйвер (redis, database, и т.д.) 

##

если нужна отправка почты нужно расскоментировать 34-ую, 35-ую линию в файле `app/Jobs/SenMassageJob.php` и настроить .env  

- `MAIL_HOST=` - почтовый сервер
- `MAIL_USERNAME=` - имя полхователя
- `MAIL_PASSWORD=` - пфроль полхователя
- `MAIL_FROM_ADDRESS=` - *почта отпровителя

##
Работа с API:


Данные для авторизации находятся в файле сидов(`database/seeds/UserSeeder.php`).
При успешной авторизации верннеться JSON с полями "token_type", "token", "expires_at"
(срок действия токена можно изменить в файле `app/Http/Controllers/Api/Auth/LoginController.php`).
Каждый последующий запрос должен содержать в заголовках "token_type" и "token" через пробел
## Роуты

- (get) `api/event/{event}` - получить конкретное событие. (параметр id)
- (get) `api/events` - получить список событий
- (post) `api/login` - авторизация, параметны: 'email', 'pass' 
- (post) `api/logout` - удаляет существующий токет авторизации 

- (post) `api/participants` - добавление участника.
Параметны: 

'name' - 'имя участника(строка) не обяз.'

'surname' - 'фамилия участника (строка) не обяз.'

'email' - электронная почта уникальное (строка) *обязательное

'event'- id события       
- (get) `api/participants` - получить список участников
- (post) `api/participants/{participant}` - удалить участника (параметр id)
- (upt|patch) `api/participants/{participant}` - обновить участника (параметр id)
- (get) `api/participants/{participant}` - получть участника (параметр id)
