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

use Gibbon\Services\Format;
use Gibbon\Tables\DataTable;
use Gibbon\Support\Facades\Access;
use Gibbon\Module\DevTools\DevFormat;

if (Access::denies('Dev Tools', 'ui_tables_basic')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Formatters'));

$page->write(Format::heading(__('Formatters')));

$page->write(Format::paragraph(<<<HTML
    Use the ->format() and ->formatDetails() methods to apply formatters to a column. These methods take a callable.

    1. The Format::using method is a helper that returns a callable. The first 
    parameter is the formatter name, the second is the array key, or an array of 
    array keys for your data set.
    HTML
));

$page->write(DevFormat::codeBlock(<<<HTML
    ->format(Format::using('bold', 'name'));
    HTML
));

$page->write(Format::paragraph(<<<HTML
    2. Or, use an anonymous function that directly applies the formatter. 
    HTML
));

$page->write(DevFormat::codeBlock(<<<HTML
    ->format(function (\$values) {
        return Format::bold(\$values['name']);
    });
    HTML
));

$page->write(Format::paragraph(<<<HTML
    3. Or, create custom formats using the values from the data set.
    HTML
));

$page->write(DevFormat::codeBlock(<<<HTML
    ->format(function (\$values) {
        return \$values['data1'].' plus '.\$values['data2'];
    }); 
    HTML
));

/*
    Use the ->format() and ->formatDetails() methods to apply formatters to a column.

    These methods take a callable. There are a few ways to use these.

    1. The Format::using method is a helper that returns a callable. The first 
    parameter is the formatter name, the second is the array key, or an array of 
    array keys for your data set.

    ->format(Format::using('bold', 'name'));

    2. Or, use an anonymous function that directly applies the formatter. 

    ->format(function ($values) {
        return Format::bold($values['name']);
    });

    3. Or, create custom formats using the values from the data set.
    
    ->format(function ($values) {
        return $values['data1'].' plus '.$values['data2'];
    }); 
*/

$sampleData = include('data/sampleTableData.php');

// Common Formats
$table = DataTable::create('table3');
$table->setTitle(__('Common Formats'));
$table->setDescription(__('Formatters take in raw data and display them in a user friendly format.'));

$table->addColumn('bold', __('Bold'))
    ->description(__('Small'))
    ->format(Format::using('bold', 'name'))
    ->formatDetails(Format::using('small', 'result'));

$table->addColumn('number', __('Number'))
    ->format(Format::using('number', ['number', 1]));

$table->addColumn('currency', __('Currency'))
    ->format(Format::using('currency', ['number', true]));

$table->addColumn('yesNo', __('Yes No'))
    ->format(Format::using('yesNo', 'active'));

$table->addColumn('tooltip', __('Tooltip'))
    ->format(Format::using('tooltip', ['name', 'description']));

$table->addColumn('truncate', __('Truncate'))
    ->format(Format::using('truncate', 'description'));
    
$table->addColumn('filesize', __('Filesize'))
    ->format(Format::using('filesize', 'number'));

$table->addColumn('tag', __('Tag'))
    ->format(Format::using('tag', ['result', 'result']));

$page->write($table->render($sampleData));


// Date Formats
$table = DataTable::create('table4');
$table->setTitle(__('Date & Time Formats'));
$table->setDescription(__('Date formatters help when displaying standard date, time, and datetime data from the database.'));

$table->addColumn('dateStart', __('dateStart'))
    ->format(Format::using('date', 'dateStart'));

$table->addColumn('dateReadable', __('Date Readable'))
    ->format(Format::using('dateReadable', 'dateStart'));

$table->addColumn('dateRangeReadable', __('Date Range Readable'))
    ->format(Format::using('dateRangeReadable', ['dateStart', 'dateEnd']));

$table->addColumn('time', __('Time'))
    ->format(Format::using('time', 'dateStart'));

$table->addColumn('timeRange', __('Time Range'))
    ->format(Format::using('timeRange', ['dateStart', 'dateEnd']));

$table->addColumn('relativeTime', __('Relative Time'))
    ->format(Format::using('relativeTime', 'dateStart'));

$page->write($table->render($sampleData));


// User Formats
$table = DataTable::create('table5');
$table->setTitle(__('User Formats'));
$table->setDescription(__('Formatters can help display user names and photos.'));

$table->addColumn('image_240', __('Photo'))
    ->context('primary')
    ->width('10%')
    ->notSortable()
    ->format(Format::using('userPhoto', ['image_240', 'sm']));

$table->addColumn('nameLinked', __('Name Linked'))
    ->context('primary')
    ->sortable(['surname', 'preferredName'])
    ->format(Format::using('nameLinked', ['001', 'title', 'preferredName', 'surname', 'Student', true]))
    ->formatDetails(Format::using('small', 'name'));

$table->addColumn('name', __('Name'))
    ->sortable(['surname', 'preferredName'])
    ->format(Format::using('name', ['title', 'preferredName', 'surname', 'Student', false]));

$table->addColumn('status', __('User Status'))
    ->format(function ($values) {
        return Format::userStatusInfo($values);
    });

$table->addColumn('age', __('Age'))
    ->format(Format::using('age', 'age'));

$table->addColumn('phone', __('Phone'))
    ->format(Format::using('phone', ['phoneNumber', '42']));

$table->addColumn('colorSwatch', __('Color Swatch'))
    ->format(Format::using('colorSwatch', 'color'));

$page->write($table->render($sampleData));
