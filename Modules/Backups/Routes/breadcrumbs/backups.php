<?php

Breadcrumbs::for('dashboard.backups.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('backups::backups.plural'), route('dashboard.backups.index'));
});

Breadcrumbs::for('dashboard.backups.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.backups.index');
    $breadcrumb->push(trans('backups::backups.actions.create'), route('dashboard.backups.create'));
});

Breadcrumbs::for('dashboard.backups.show', function ($breadcrumb, $backup) {
    $breadcrumb->parent('dashboard.backups.index');
    $breadcrumb->push($backup->title, route('dashboard.backups.show', $backup));
});

Breadcrumbs::for('dashboard.backups.edit', function ($breadcrumb, $backup) {
    $breadcrumb->parent('dashboard.backups.show', $backup);
    $breadcrumb->push(trans('backups::backups.actions.edit'), route('dashboard.backups.edit', $backup));
});
