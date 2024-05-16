<?php

return [
    'singular' => 'Backup',
    'plural' => 'Backups',
    'empty' => 'There are no backups yet.',
    'count' => 'Backups count',
    'search' => 'Search',
    'select' => 'Select Backup',
    'perBackup' => 'Backups Per Backup',
    'filter' => 'Search for backup',
    'description' => 'Show all backups',
    'actions' => [
        'list' => 'List all',
        'create' => 'Create Backup',
        'show' => 'Show Backup',
        'edit' => 'Edit Backup',
        'delete' => 'Delete Backup',
        'options' => 'Options',
        'save' => 'Save',
        'filter' => 'Filter',
        'full_backup' => 'Create Full Backup',
        'files_backup' => 'Create Files Only Backup',
        'db_backup' => 'Create Database Only Backup',
    ],
    'messages' => [
        'created' => 'The backup has been created successfully.',
        'updated' => 'The backup has been updated successfully.',
        'deleted' => 'The backup has been deleted successfully.',
    ],
    'attributes' => [
        'name' => 'Backup Name',
        '%name%' => 'Backup Name',
        'file_size' => 'Backup File Size',
        '%file_size%' => 'Backup File Size',
        'created_at' => 'The Date Of Creation',
        'created_age' => 'The Age Of Creation',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the backup?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
    ],
];
