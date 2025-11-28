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

use Gibbon\Forms\Form;
use Gibbon\Data\PasswordPolicy;
use Gibbon\Forms\DatabaseFormFactory;
use Gibbon\Support\Facades\Access;

if (Access::denies('Dev Tools', 'ui_forms_basic')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__('Custom Blocks'));

// Form
$form = Form::create('basic', '#');

$form->addMeta('test');

// Custom Blocks

$form->addSection('Custom Blocks', __('Custom Blocks'));

// Simple Blocks
$column = $form->addRow()->addColumn();
$column->addLabel('simpleBlocks', __('Simple Blocks'))->description(__('Description'));
$customBlocks = $column->addCustomBlocks('simpleBlocks');

// Simple Template
$row = $customBlocks->addTemplateRow();
$row->addTextField('title')->required()->placeholder(__('Title'));
$row->addColor('color')->setOuterClass('w-48')->required()->setValue('#ffffff');

$row = $customBlocks->addTemplateRow();
$row->addTextArea('description')->placeholder(__('Description'))->setRows(3);

// Add some example blocks
$items = array_fill(0, 3, ['title' => 'Example', 'color' => '#9862e3']);
$customBlocks->addBlocks($items);




// Complex Blocks
$column = $form->addRow()->addColumn();
$column->addLabel('complexBlocks', __('Complex Blocks'))->description(__('Description'));
$customBlocks = $column->addCustomBlocks('complexBlocks')
    ->settings(['inputNameStrategy' => 'object', 'addOnEvent' => 'click', 'sortable' => true])
    ->placeholder(__('Add some things here...'));

$customBlocks->addToolButton(__('Add Block'))->setIcon('solid', 'add')->addClass('addBlock');
$customBlocks->addToolButton(__('Calculate'))->setIcon('solid', 'run')->setAttribute('@click', 'alert("Total Blocks: "+blockCount)');

// Complex Template
$row = $customBlocks->addTemplateRow();
    $row->addTextField('title')
        ->placeholder(__('Title'))
        ->maxlength(100)
        ->setClass('title');

$row = $customBlocks->addTemplateRow();
    $row->addTextField('type')->placeholder(__('type (e.g. discussion, outcome)'))
        ->maxlength(50)
        ->setOuterClass('w-2/3');
    $row->addTextField('length')->placeholder(__('length (min)'))
        ->maxlength(3);

$row = $customBlocks->addTemplateRow();
    $row->addDate('date')->setOuterClass('w-1/3');
    $row->addTime('time')->setOuterClass('w-1/3');
    $row->addTime('time2')->setOuterClass('w-1/3');

$col = $customBlocks->addTemplateRow()->setClass('flex-col sm:flex-col');
    $col->addTextArea('contents')->setRows(8)->addData('tinymce')->addData('media', '1');

// Add some example blocks
// $items = array_fill(0, 3, ['title' => 'Example', 'color' => '#9862e3']);
// $customBlocks->addBlocks($items);



$form->addSection('submit')->addSubmit();

$page->write($form->getOutput());
