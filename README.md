# Envybox - Тестовое задание PHP + VueJs #

*Ссылка на git-репозиторий: https://bitbucket.org/irina2908/envybox-test-php-vuejs/src/master/*

В этом файле указана техническая информация по реализации проекта, а также приведен текст задания на разработку.

### Описание проекта ###

Тестовое задание на позицию "PHP + VueJs Разработчик" в компании Envybox.
Проект - форма Обратной связи.

### Задание ###

Сделать форму обратной связи.

При сохранении заявки использовать паттерн фабрика.

Реализовать структуру, чтобы можно было добавлять новые места для хранения заявок, например другая база данных или email.

Изначально реализовать сохранение в базу и в файл. Саму структуру базы можно не делать.

Поля: имя, телефон, само обращение. Валидация данных на бекенде.


Что необходимо использовать:

- PHP 7
- Фреймворк Laravel или mvc фреймворк
- ООП (для создания заявки и места для хранения заявки)
- DDD для организации приложения (не обязательно)
- Обязательно Vuejs

### Техническая спецификация ###

Для разработки данного проекта использовалась программная сборка Open Server v.5.2.9 Basic.

**Используемые технологии и программные компоненты:**

- Веб-сервер: Apache 2.4.34 (Win x64)
- PHP: PHP 7.2
- PHP фреймворк: Phalcon 3.4.1 - входит в стандартную сборку Open Server v.5.2.9
- База данных: MySql 5.6
- Gulp для сборки компонентов фронтенда, Node package manager для загрузки пакетов, необходимых для фронтенд-разработки.

### Установка, настройка, запуск ###

Фреймворк Phalcon (https://docs.phalcon.io/3.4/en/introduction) входит в стандартную сборку Open Server v.5.2.9 и ниже; в сборки более поздних версий этот фреймворк не входит.

Данные для подключения к базе данных находятся в файле `/app/config/config.php`.

Для начала работы необходимо создать базу данных и необходимые таблицы.
В проекте имеется бэкап базы данных - файл `db_backup.sql`, для инициализации базы данных можно воспользоваться им - 
восстановить базу со всеми необходимыми таблицами из данного бэкапа.

Перед запуском проекта нужно скачать npm-пакеты. Для этого запустить `npm install` из корневой папки проекта.

Сборка компонентов фронтенда проекта осуществляется посредством gulp, с использованием webpack - для сборки Vue-приложения.
Команды gulp, заданные в этом проекте:

- `gulp prod` - полная сборка продакшн-версии проекта;
- `gulp app:prod` - сборка Vue-приложения;
- `gulp styles:prod` - сборка стилей;
- `gulp html:prod` - сборка html-страницы из исходника;
- `gulp markup:prod` - объединяет задачи `styles:prod` и `app:prod`, предназначена в основном для разработки.

В репозиторий уже загружены все скомпилированные файлы фронтенда - стилевой файл `/public/assets/styles.min.css`, файл сборки Vue-приложения - `/public/app/bundle.js`, html-файл - `/app/views/index/index.phtml`.
Таким образом, проект полностью готов к запуску (за исключением того, что нужно скачать npm-пакеты), и запуск gulp-команд перед стартом проекта не требуется.
Однако, в случае необходимости, команду `gulp prod` следует запускать перед первым стартом проекта, либо для сборки всех фронтенд-компонентов.
Также можно запускать отдельные команды для сборки какого-то конкретного компонента фронтенда.

----
*Выполнено: Жунусова Ирина,*

*+7 (921) 084-23-20,*

*iris118.25@mail.ru*