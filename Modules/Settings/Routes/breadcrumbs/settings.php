<?php

Breadcrumbs::for('dashboard.settings.update', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('settings::settings.plural'), route('dashboard.settings.index'));
});

Breadcrumbs::for('dashboard.settings.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $name = trans('settings::settings.tabs.' . request('tab', 'main'));
    $breadcrumb->push($name, route('dashboard.settings.index'));
});
