<?php

Breadcrumbs::for('dashboard.articles.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('articles::articles.plural'), route('dashboard.articles.index'));
});

Breadcrumbs::for('dashboard.articles.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.articles.index');
    $breadcrumb->push(trans('articles::articles.actions.create'), route('dashboard.articles.create'));
});

Breadcrumbs::for('dashboard.articles.show', function ($breadcrumb, $article) {
    $breadcrumb->parent('dashboard.articles.index');
    $breadcrumb->push(Illuminate\Support\Str::limit($article->name, $limit = 50, $end = '...'), route('dashboard.articles.show', $article));
});

Breadcrumbs::for('dashboard.articles.edit', function ($breadcrumb, $article) {
    $breadcrumb->parent('dashboard.articles.show', $article);
    $breadcrumb->push(trans('articles::articles.actions.edit'), route('dashboard.articles.edit', $article));
});
