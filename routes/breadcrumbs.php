<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::for('root', function (BreadcrumbsGenerator $trail) {
    $trail->push('Главная', route('root'));
});

Breadcrumbs::for('home', function (BreadcrumbsGenerator $trail) {
    $trail->push('Главная', route('home'));
});

Breadcrumbs::for('wagons.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('home');
    $trail->push('Вагоны', route('wagons.index'));
});

Breadcrumbs::for('wagons.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('wagons.index');
    $trail->push('Добавление', route('wagons.create'));
});

Breadcrumbs::for('wagons.show', function (BreadcrumbsGenerator $trail, $wagon) {
    $trail->parent('wagons.index');
    $trail->push($wagon->inw, route('wagons.show', $wagon));
});

Breadcrumbs::for('wagons.edit', function (BreadcrumbsGenerator $trail, $wagon) {
    $trail->parent('wagons.show', $wagon);
    $trail->push('Редактирование', route('wagons.edit', $wagon));
});

Breadcrumbs::for('login', function (BreadcrumbsGenerator $trail) {
    $trail->parent('home');
    $trail->push('Вход на сайт', route('login'));
});

Breadcrumbs::for('register', function (BreadcrumbsGenerator $trail) {
    $trail->parent('home');
    $trail->push('Регистрация', route('register'));
});

Breadcrumbs::for('password.request', function (BreadcrumbsGenerator $trail) {
    $trail->parent('login');
    $trail->push('Запрос восстановления пароля', route('login'));
});

Breadcrumbs::for('password.reset', function (BreadcrumbsGenerator $trail) {
    $trail->parent('login');
    $trail->push('Восстановление пароля', route('login'));
});