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
use Gibbon\Forms\DatabaseFormFactory;
use Gibbon\Support\Facades\Access;

if (Access::denies('Dev Tools', 'ui_forms_components')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Components'));

// Form
$form = Form::create('basic', '#');
$form->setFactory(DatabaseFormFactory::create($pdo));

$form->addMeta('test');

// Toggles
$form->addSection('Toggles', __('Toggles'));

$form->addToggle('toggle')
    ->label(__('Toggle'))
    ->setValue(true);

$form->addYesNo('yesno')
    ->label(__('Yes / No'));

$form->addToggle('active')
    ->setActiveInactive()
    ->label(__('Active / Inactive'));


// Editors
$form->addSection('Text Editors', __('Text Editors'));

$form->addRow()->addColumn()->addEditor('Editor', $guid)
    ->label(__('Editor'))
    ->setRows(4);

$form->addRow()->addColumn()->addCommentEditor('CommentEditor', $guid)
    ->label(__('Comment Editor'))
    ->checkPronouns('F')
    ->checkName('Test')
    ->maxLength(120)
    ->setRows(4);

$form->addRow()->addColumn()->addCodeEditor('CodeEditor', $guid)
    ->label(__('Code Editor'))
    ->setHeight(160);



$form->addSection('submit')->addSubmit();

echo $form->getOutput();

