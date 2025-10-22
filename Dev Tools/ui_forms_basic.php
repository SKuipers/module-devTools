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
use Gibbon\Forms\Form;
use Gibbon\Data\PasswordPolicy;
use Gibbon\Forms\DatabaseFormFactory;

if (Access::denies('Dev Tools', 'ui_forms_basic')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Basic Fields'));

// Form
$form = Form::create('basic', '#');
$form->setFactory(DatabaseFormFactory::create($pdo));

$form->addMeta('test');

// Text
$form->addSection('Text', __('Text'));

$form->addTextField('textField')
    ->label(__('Text Field'), __('Help text to assist the user'))
    ->required()
    ->maxLength(60);

$form->addTextArea('textArea')
    ->label(__('Text Area'))
    ->setRows(3);

$form->addEmail('email')
    ->label(__('Email'));

$form->addUrl('url')
    ->label(__('Url'));

$form->addTextField('autocomplete')
    ->label(__('Autocomplete'))
    ->autocomplete(['Test 1','Test 2','Test 3']);


// Numbers
$form->addSection('Numbers', __('Numbers'));

$form->addNumber('number')
    ->label(__('Number'));

$form->addCurrency('currency')
    ->label(__('Currency'));

$form->addPhoneNumber('phoneNumber')
    ->label(__('Phone Number'));

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
