<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::for('home', function (BreadcrumbsGenerator $trail) {
    $trail->push('Главная', route('home'));
});

Breadcrumbs::for('root', function (BreadcrumbsGenerator $trail) {
    $trail->push('Главная', route('root'));
});

Breadcrumbs::for('show-wagon', function (BreadcrumbsGenerator $trail, $wagon) {
    $trail->parent('root');
    $trail->push($wagon->inw);
});

Breadcrumbs::for('detained-by', function (BreadcrumbsGenerator $trail, $detainer) {
    $trail->parent('root');
    $trail->push('Задержаны');
    $trail->push($detainer->name);
});

Breadcrumbs::for('detained-by-long', function (BreadcrumbsGenerator $trail, $detainer) {
    $trail->parent('root');
    $trail->push('Длительно простаивающие');
    $trail->push($detainer->name);
});


Breadcrumbs::for('long-only', function (BreadcrumbsGenerator $trail) {
    $trail->parent('root');
    $trail->push('Длительно стоящие вагоны');
});


Breadcrumbs::for('recent', function (BreadcrumbsGenerator $trail, $day, $type) {
    $trail->parent('root');
    $trail->push(ucfirst($day));
    $trail->push(ucfirst($type));
});

Breadcrumbs::for('reports.last', function (BreadcrumbsGenerator $trail) {
    $trail->parent('root');
    $trail->push('Отчеты по задержанным вагонам');
    $trail->push('Последняя смена');
});

Breadcrumbs::for('wagons.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('root');
    $trail->push('Работа с вагонами', route('wagons.index'));
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
    $trail->parent('root');
    $trail->push('Вход на сайт', route('login'));
});

Breadcrumbs::for('register', function (BreadcrumbsGenerator $trail) {
    $trail->parent('root');
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