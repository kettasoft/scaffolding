<?php

Breadcrumbs::for('dashboard.parents.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('accounts::parents.plural'), route('dashboard.parents.index'));
});

Breadcrumbs::for('dashboard.parents.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.parents.index');
    $breadcrumb->push(trans('accounts::parents.actions.create'), route('dashboard.parents.create'));
});

Breadcrumbs::for('dashboard.parents.show', function ($breadcrumb, $parent) {
    $breadcrumb->parent('dashboard.parents.index');
    $breadcrumb->push($parent->name, route('dashboard.parents.show', $parent));
});

Breadcrumbs::for('dashboard.parents.edit', function ($breadcrumb, $parent) {
    $breadcrumb->parent('dashboard.parents.show', $parent);
    $breadcrumb->push(trans('accounts::parents.actions.edit'), route('dashboard.parents.edit', $parent));
});
