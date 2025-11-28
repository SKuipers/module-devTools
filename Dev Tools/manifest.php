<?php
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http:// www.gnu.org/licenses/>.
*/

// This file describes the module, including database tables

// Basic variables
$name        = 'Dev Tools';            
$description = 'Utilities and UI library for development and testing.';            
$entryURL    = "index.php";   
$type        = "Additional";  
$category    = 'Admin';           
$version     = '0.0.01';         
$author      = 'Sandra Kuipers';           
$url         = 'https://github.com/SKuipers';          

// Module tables
// $moduleTables[] = ""; 

// Module settings
// $gibbonSetting[] = "";

// Action rows 
$actionDefaults = [
    'precedence'                => '0',
    'description'               => '', 
    'URLList'                   => '', 
    'entrySidebar'              => 'Y', 
    'menuShow'                  => 'Y', 
    'defaultPermissionAdmin'    => 'Y',
    'defaultPermissionTeacher'  => 'N',
    'defaultPermissionStudent'  => 'N',
    'defaultPermissionParent'   => 'N',
    'defaultPermissionSupport'  => 'N',
    'categoryPermissionStaff'   => 'Y',
    'categoryPermissionStudent' => 'N',
    'categoryPermissionParent'  => 'N',
    'categoryPermissionOther'   => 'N',
];

$actions = [
    // Admin
    [
        'name'     => 'Overview',
        'category' => 'Admin',
        'entryURL' => 'index.php',
    ],
    // [
    //     'name'     => 'Settings',
    //     'category' => 'Admin',
    //     'entryURL' => 'settings.php',
    // ],

    // Forms
    [
        'name'     => 'Basic Fields',
        'category' => 'UI Forms',
        'entryURL' => 'ui_forms_basic.php',
    ],
    [
        'name'     => 'Components',
        'category' => 'UI Forms',
        'entryURL' => 'ui_forms_components.php',
    ],
    [
        'name'     => 'Custom Blocks',
        'category' => 'UI Forms',
        'entryURL' => 'ui_forms_blocks.php',
    ],
    [
        'name'     => 'Files & Uploads',
        'category' => 'UI Forms',
        'entryURL' => 'ui_forms_files.php',
    ],
    [
        'name'     => 'Multi-part Forms',
        'category' => 'UI Forms',
        'entryURL' => 'ui_forms_multi.php',
    ],
    [
        'name'     => 'Select Lists',
        'category' => 'UI Forms',
        'entryURL' => 'ui_forms_select.php',
    ],

    // Tables
    [
        'name'     => 'Basic Tables',
        'category' => 'UI Tables',
        'entryURL' => 'ui_tables_basic.php',
    ],
    [
        'name'     => 'Formatters',
        'category' => 'UI Tables',
        'entryURL' => 'ui_tables_format.php',
    ],
    [
        'name'     => 'Grid Tables',
        'category' => 'UI Tables',
        'entryURL' => 'ui_tables_grid.php',
    ],
    [
        'name'     => 'Paginated Tables',
        'category' => 'UI Tables',
        'entryURL' => 'ui_tables_paginated.php',
    ],
    [
        'name'     => 'Report Tables',
        'category' => 'UI Tables',
        'entryURL' => 'ui_tables_report.php',
    ],
    
    // Display
    [
        'name'     => 'Alerts & Returns',
        'category' => 'UI Display',
        'entryURL' => 'ui_display_alerts.php',
    ],
    [
        'name'     => 'Details Tables',
        'category' => 'UI Display',
        'entryURL' => 'ui_display_details.php',
    ],
    [
        'name'     => 'Icon Library',
        'category' => 'UI Display',
        'entryURL' => 'ui_display_icons.php',
    ],
    [
        'name'     => 'Navigation',
        'category' => 'UI Display',
        'entryURL' => 'ui_display_nav.php',
    ],
    [
        'name'     => 'Graphs & Charts',
        'category' => 'UI Display',
        'entryURL' => 'ui_display_charts.php',
    ],

    // Utilities
    
    // [
    //     'name'     => 'Snapshots',
    //     'category' => 'Utilities',
    //     'entryURL' => 'snapshot_manage.php',
    //     'URLList' => 'snapshot_manage.php,snapshot_manage_add.php,snapshot_manage_delete.php,snapshot_manage_load.php',
    // ],
];

foreach ($actions as $action) {
    if (empty($action['URLList'])) $action['URLList'] = $action['entryURL'];

    $actionRows[] = $action + $actionDefaults;
}
