# newsFeed_and_guestBook (Yii2 framework)

Модуль Новости:

localhost/newsfeed - страница пользователя 

localhost/newsfeed/news/manage - страница администратора

Модуль Гостевая книга:

localhost/gbook - страница пользователя 

localhost/gbook/post/manage - страница администратора

В task.sql находится дамп базы данных. В нем есть данные о пользователе user с паролем 111111 (для обеих админпанелей).

Конфигурация приложения /config/config.php

Расположение содержимого должно быть следующим.

yii
|
|
----vendor
|
|
|
----project
          |
          |
          |
          -----web
          |
          |
          |
          -----models
          |
          |
          |
          ...
          
В инном случае нужно изменить конфиг.



