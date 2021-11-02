<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Описание
Для того чтобы развернуть данный проект необходимо склонировать репозиторий или скачать архив репозитория и распаковать.

Далее, корне склонированного/скопированного репозитория запустить команды

```
composer install
php artisan key:generate
php artisan storage:link
```

В репозитории есть экземпляр БД sqlite с пользователями и парой "сообщений",
для подключения БД необходимо переименовать файл ".env.example" в ".env" и заменить соответствующие строки, не забыв заменить полный путь, на:

```
DB_CONNECTION=sqlite
DB_DATABASE=(полный путь к файлу)/db.sqlite
DB_FOREIGN_KEYS=true
```

в данном случае запускать миграции не нужно.

Если хотите использовать свою базу данных, то так же переименуйте файл ".env.example" в ".env" и пропишите свои настройки для:
```
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
а затем запустите миграции
```
php artisan migrate
```
и сидер
```
php artisan db:seed --class=UserSeeder
```

Независимо от выбранного способа (sqlite или своя БД + сидер) в итоге получите двух пользователей:

логи/пароль - manager@test.com - 123456789

логи/пароль - client@test.com - 123456789


