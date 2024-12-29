## Laravel Wind Client Lessons

ветка первого репозитория с предыдущими уроками

https://github.com/vagum/wind

================ 13 Http Client Config Env =====================

Временные метки по видео предыдущего урока:
```
9.31 composer create-project laravel/laravel wind_client
11.31 php artisan make:model Post -m
12.06 Исправление миграции Post
12.16 php artisan migrate
12.20 подключение sqlite
12.52 php artisan make:command GoCommand
14.45 хттп клиент Http::get
15.24 php artisan go
17.20 GoCommand пишем полученное в базу Post::firstOrCreate
17.36 Исправляем ошибку делая правки в Post.php protected $guarded = false
18.35 php artisan make:class HttpClients/PostHttpClient
20.06 PostHttpClient
21.45 php artisan go
22.33 включение аутентификации в api.php через миддлвар
22.58 смотрим в GoCommand ->status
25.17 PostHttpClient метод login
26.23 GoCommand PostHttpClient::login
26.58 GoCommand access_token
27.55 GoCommand token
28.15 PostHttpClient Http::withToken()
28.35 php artisan go
33.17 фабрика make в PostHttpClient
35.21 GoCommand PostHttpClient::make()->login()->index()->collect()
40.06 login + pass в .env
42.34 пароль в конфиг
46.59 фильтр withQueryParameters()
```
