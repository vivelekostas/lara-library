<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About the TEST application

Задача: реализовать API библиотеки на Laravel с книгами их авторами, рейтингом и поиском.

Сущности Автора (полный круд) и Книги (полный круд) связанны связью один ко многим. Рейтинг связан с Автором и Книгой полиморфным отношением, через промежуточную таблицу. Бизнес-логика Автора и Книги вынесена в соответствующие сервисы, трейты и события ("тонкий контроллер"). Создание новых объектов валидируется через формреквесты.  Первоначальная загрузка данных реализована через сиды. Поиск работает по названию и имени книги и автора, как вместе, так и по отдельности. В модели, помимо связей, добавлял локальные скоупы, а в ресурсных контроллерах использованы нетерпеливую загрузку (экшены index).

