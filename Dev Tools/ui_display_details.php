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
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

use Gibbon\Support\Facades\Access;
use Gibbon\Tables\DataTable;

if (Access::denies('Dev Tools', 'ui_display_details')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Details Tables'));

$sampleData = [
    [
        'name' => 'Test',
        'status' => 'Testing',
    ],
];

// Details Table
$table = DataTable::createDetails('exampleTable');
$table->setTitle(__('Details Table'));

$table->addColumn('name', __('Name'));
$table->addColumn('status', __('Status'));

$page->write($table->render($sampleData));


// Formatters
// $table = DataTable::createDetails('exampleTable2');
// $table->setTitle(__('Formatters'));

// $table->addColumn('name', __('Name'));
// $table->addColumn('status', __('Status'));

// $page->write($table->render($sampleData));
