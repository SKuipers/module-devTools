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

$page->breadcrumbs->add(__m('Basic Fields'));

// Form
$form = Form::create('basic', '#');

$form->addMeta('test');

// Text
$form->addSection('Text', __('Text'));

$form->addTextField('textField')
    ->label(__('Text Field'), __('Help text to assist the user'))
    ->required()
    ->maxLength(60);

$form->addTextField('autocomplete')
    ->label(__('Text Field'), __('With autocomplete'))
    ->autocomplete(['Test 1','Test 2','Test 3']);

$form->addTextArea('textArea')
    ->label(__('Text Area'))
    ->setRows(3);

$form->addEmail('email')
    ->label(__('Email'));

$form->addUrl('url')
    ->label(__('Url'));


// Numbers
$form->addSection('Numbers', __('Numbers'));

$form->addNumber('number')
    ->label(__('Number'));

$form->addCurrency('currency')
    ->label(__('Currency'));

$form->addRange('range', 1, 5, 1)
    ->label(__('Range'))
    ->setValue(3);

// Dates
$form->addSection('Date & Time', __('Date & Time'));

$form->addDate('date1')
    ->label(__('Date'));

$form->addTime('time1')
    ->label(__('Time'));

$form->addDate('date2')
    ->label(__('Date & Time'))
    ->attach()
    ->addTime('time2');


$row = $form->addRow();
    $row->addLabel('dateStart', __('Date'));

    $row->addDate('dateStart')->chainedTo('dateEnd')->required()->setValue();
    $row->addDate('dateEnd')->chainedFrom('dateStart')->setValue();

    $row->addCheckbox('allDay')
        ->description(__('All Day'))
        ->setOuterClass('w-min')
        ->inline()
        ->setValue('Y')
        ->checked('Y');

$form->toggleVisibilityByClass('timeOptions')->onCheckbox('allDay')->whenNot('Y');

$row = $form->addRow()->addClass('timeOptions');
    $row->addLabel('time', __('Time'));
    $row->addTime('timeStart')
        ->required();
    $row->addTime('timeEnd')
        ->chainedTo('timeStart')
        ->required();

// Options
$form->addSection('Options', __('Options'));

$options = 'Option 1,Option 2,Option 3';

$form->addSelect('select')
    ->label(__('Select'))
    ->fromString($options)
    ->selected('Option 1');

$form->addCheckbox('checkbox')
    ->label(__('Checkbox'))
    ->fromString($options)
    ->checked('Option 2');

$form->addRadio('radio')
    ->label(__('Radio'))
    ->fromString($options)
    ->checked('Option 3');

$form->addSection('Password', __('Password'));

$form->addPassword('password')
    ->label(__('Password'))
    ->setValue('badPassword1234');

$form->addPassword('passwordNew')
    ->label(__('Password'), __('With password policy'))
    ->addPasswordPolicy($container->get(PasswordPolicy::class))
    ->addGeneratePasswordButton($form)
    ->required();

$form->addPassword('passwordConfirm')
    ->label(__('Confirm Password'), __('Must match'))
    ->addConfirmation('passwordNew')
    ->required();

$form->addSection('submit')->addSubmit();

$page->write($form->getOutput());
