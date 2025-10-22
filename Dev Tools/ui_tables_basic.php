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

use Gibbon\Http\Url;
use Gibbon\Services\Format;
use Gibbon\Tables\DataTable;
use Gibbon\Support\Facades\Access;

if (Access::denies('Dev Tools', 'ui_tables_basic')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Basic Tables'));

$sampleData = include('data/sampleTableData.php');

// Basic Table
$table = DataTable::create('table1');
$table->setTitle(__('Basic Table'));
$table->setDescription(__('A basic data table is useful for displaying small sets of data or lists.'));

$table->addColumn('name', __('Name'))
    ->width('15%')
    ->context('primary');

$table->addColumn('description', __('Description'))
    ->width('40%')
    ->format(Format::using('small', 'description'));

$table->addColumn('result', __('Result'))
    ->context('primary')
    ->translatable()
    ->format(Format::using('tag', ['result', 'result']));

$page->write($table->render($sampleData));

// Row Highlights
$table = DataTable::create('table2');
$table->setTitle(__('Row Highlights'));
$table->setDescription(__('Data tables can apply row highlights depending on the values in each row.'));

$table->modifyRows(function ($values, $row)  {
    if ($values['result'] == 'success') $row->addClass('success');
    if ($values['result'] == 'warning') $row->addClass('warning');
    if ($values['result'] == 'error') $row->addClass('error');
    if ($values['result'] == 'dull') $row->addClass('dull');
    return $row;
});

$table->addColumn('name', __('Name'))
    ->width('15%')
    ->context('primary');

$table->addColumn('description', __('Description'))
    ->width('40%')
    ->format(Format::using('small', 'description'));

$table->addColumn('result', __('Result'))
    ->context('primary')
    ->translatable();

$page->write($table->render($sampleData));
