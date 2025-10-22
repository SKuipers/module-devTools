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
use Gibbon\Forms\MultiPartForm;
use Gibbon\Http\Url;

if (Access::denies('Dev Tools', 'ui_forms_multi')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Multi-part Forms'));

$params = [
    'step' => $_REQUEST['step'] ?? 1,
];
$pageUrl = Url::fromModuleRoute('Dev Tools', 'ui_forms_multi')->withQueryParams($params);

// Form
$form = MultiPartForm::create('basic', '#');

$form->setCurrentPage($params['step']);
$form->addPage(1, __('Step 1'), $pageUrl);
$form->addPage(2, __('Step 2'), $pageUrl);
$form->addPage(3, __('Step 3'), $pageUrl);

$form->addHiddenValue('step', $params['step'] + 1);

// $form->addMeta('test');

// Text
$form->addSection('Text', __('Text'));

$form->addTextField('textField2')
    ->label(__('Text Field'))
    ->maxLength(60);

$form->addTextArea('textArea')
    ->label(__('Text Area'))
    ->setRows(3);

$form->addSection('submit')->addSubmit($params['step'] >= 3? __('Submit') : __('Next'));

$page->write($form->getOutput());

