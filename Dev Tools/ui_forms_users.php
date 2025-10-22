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

// User Select
$form->addSection('User Select', __('User Select'));

$form->addSelectUsers('Users')
    ->label(__('Users'));

$form->addSelectStaff('Staff')
    ->label(__('Staff'));

$form->addSelectStudent('Student', $session->get('gibbonSchoolYearID'))
    ->label(__('Student'));

$form->addSection('submit')->addSubmit();

echo $form->getOutput();

