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
use Gibbon\Tables\View\GridView;
use Gibbon\Tables\DataTable;
use Gibbon\Services\Format;
use Gibbon\Domain\DataSet;
use Gibbon\Http\Url;

if (Access::denies('Dev Tools', 'ui_tables_grid')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Grid Tables'));

$sampleData = include('data/sampleTableData.php');
$sampleData2 = include('data/sampleActionData.php');

// Grid Table
$table = DataTable::createGrid('grid2');
$table->setTitle('Grid Table');
$table->setDescription(__('Display items from a data set in a visual grid with breakpoints for different viewport sizes.'));

$table->addMetaData('gridClass', 'gap-4');
$table->addMetaData('gridItemClass', 'flex justify-start border w-48 rounded text-center text-gray-600 text-xs px-4 py-8 gap-1 hover:bg-gray-100');
$table->addMetaData('allowHTML', ['icon']);

// $table->addColumn('image_240', __('Photo'))
//     ->format(Format::using('userPhoto', ['image_240', 'sm']));

$table->addColumn('person')
    ->sortable(['surname', 'preferredName'])
    ->setClass('text-sm font-bold mt-1')
    ->format(Format::using('name', ['title', 'preferredName', 'surname', 'Student', false]));
    
$table->addColumn('name')
    ->format(Format::using('small', 'name'));

$page->write($table->render($sampleData));


// Action Table
$table = DataTable::createGrid('grid2');
$table->setTitle(__('Action Table'));

$table->addMetaData('gridClass', 'rounded-md bg-gray-100 border py-4 gap-6 sm:flex-nowrap justify-around');
$table->addMetaData('gridItemClass', 'w-24 sm:flex-1 text-center text-gray-500 hover:text-gray-700');
$table->addMetaData('hidePagination', true);

$table->addColumn('icon')
    ->format(function ($menu) {
        return Format::link($menu['url'], icon('solid', $menu['icon'], 'size-8 sm:size-12'), ['class' => 'no-underline text-inherit']);
    });

$table->addColumn('name')
    ->setClass('font-bold text-xs')
    ->format(function ($menu) {
        return Format::link($menu['url'], $menu['name'], ['class' => 'no-underline text-gray-700']);
    });

$page->write($table->render($sampleData2));

// Participants Table
$table = DataTable::createGrid('grid3');
$table->setTitle(__('Participants Table'));

$table->addMetaData('gridClass', 'rounded-sm bg-blue-50 border');
$table->addMetaData('gridItemClass', 'w-1/2 sm:w-1/3 md:w-1/5 my-2 sm:my-4 text-center text-sm');

$table->addHeaderAction('edit', __('Edit Enrolment'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_tables_grid'))
    ->displayLabel();

$table->addHeaderAction('download', __('Export to Excel'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_tables_grid'))
    ->displayLabel();

$table->addColumn('image_240', __('Photo'))
    ->format(Format::using('userPhoto', ['image_240', 'md']));

$table->addColumn('person')
    ->sortable(['surname', 'preferredName'])
    ->setClass('text-xs font-bold mt-1')
    ->format(Format::using('nameLinked', ['001', '', 'preferredName', 'surname', 'Staff', false, true]));
    
$table->addColumn('name')
    ->format(Format::using('small', 'name'));

$page->write($table->render($sampleData));
