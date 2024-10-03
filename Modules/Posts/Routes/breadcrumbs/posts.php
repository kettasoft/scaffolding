<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('dashboard.posts.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('posts::posts.plural'), route('dashboard.posts.index'));
});

Breadcrumbs::for('dashboard.posts.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.posts.index');
    $breadcrumb->push(trans('posts::posts.actions.create'), route('dashboard.posts.create'));
});

Breadcrumbs::for('dashboard.posts.show', function ($breadcrumb, $page) {
    $breadcrumb->parent('dashboard.posts.index');
    $breadcrumb->push($page->title, route('dashboard.posts.show', $page));
});

Breadcrumbs::for('dashboard.posts.edit', function ($breadcrumb, $page) {
    $breadcrumb->parent('dashboard.posts.show', $page);
    $breadcrumb->push(trans('posts::posts.actions.edit'), route('dashboard.posts.edit', $page));
});
