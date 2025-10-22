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
use Gibbon\Forms\FormFactory;
use Gibbon\Services\Format;
use Gibbon\Support\Facades\Access;

if (Access::denies('Dev Tools', 'ui_display_nav')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Navigation'));


// $page->write(Format::heading(__('School Year Navigation')));

$gibbonSchoolYearID = $_REQUEST['gibbonSchoolYearID'] ?? $session->get('gibbonSchoolYearID');
$page->navigator->addSchoolYearNavigation($gibbonSchoolYearID);

$factory = $container->get(FormFactory::class);

// Buttons
$page->write(Format::heading(__('Buttons')));


$page->write(
    $factory->createButton(__('Button'))->getOutput().' '.
    $factory->createButton()->setIcon('basic', 'add')->getOutput().' '.
    $factory->createButton(__('Button Icon'))->setIcon('basic', 'add')->getOutput().' '.
    $factory->createButton(__('Button Tag'))->setTag(3)->getOutput()
);

$page->write(Format::paragraph(__('Different button states:'), 'mt-4'));

$page->write(
    $factory->createButton(__('Normal'))->setColor('gray')->getOutput().' '.
    $factory->createButton(__('Danger'))->setColor('red')->getOutput().' '.
    $factory->createButton(__('Highlight'))->setColor('purple')->getOutput().' '.
    $factory->createButton(__('Submit'))->setColor('submit')->getOutput()
);

$page->write(
    $factory->createButton(__('Disabled'))->disabled()->getOutput()
);

$page->write(Format::paragraph('With modal confirm:', 'mt-4'));

$page->write(
    $factory->createButton(__('Modal'))
    ->setAttribute('@click', "modalType = 'small'; modalOpen = true; modalAlert = {
        title: 'Something important will happen', 
        text: 'This is just a warning so you know in advance. The important thing hasn\'t happened yet, but it will.',
    }")
    ->getOutput()
);

$page->write(
    $factory->createButton(__('Modal Confirm'))
    ->setAttribute('@click', "modalType = 'small'; modalOpen = true; modalAlert = {
        title: 'Are you sure you want to refund this payment?', 
        text: 'The refund will be reflected in the customer\’s bank account 2 to 3 business days after processing.',
        cancel: 'Cancel',
        confirm: 'Refund',
    }")
    ->getOutput()
);

$page->write(
    $factory->createButton(__('Help'))
    ->setIcon('solid', 'help')
    ->setAttribute('@click', "modalOpen = true; modalType = 'medium'; modalAlert = {
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    }")
    ->getOutput()
);

$page->write('<br><br>');

// Buttons
$page->write(Format::heading(__('Button Groups')));

$page->write(Format::paragraph(__('Sets of related buttons:'), 'mt-4'));

$page->write(
    $factory->createButton(__('Left'))->groupAlign('left')->getOutput().
    $factory->createButton(__('Middle'))->groupAlign('middle')->getOutput().
    $factory->createButton(__('Right'))->groupAlign('right')->getOutput()
);

$page->write(
    $factory->createButton(__('Prev'))->setIcon('basic', 'chevron-left')->groupAlign('left')->getOutput().
    $factory->createButton(__('Next'))->setIcon('basic', 'chevron-right', 'order-last')->groupAlign('right')->getOutput()
);

$page->write(
    $factory->createButton(__('Star'))->setIcon('solid', 'star')->groupAlign('left')->getOutput().
    $factory->createButton('3')->groupAlign('right')->getOutput()
);

$page->write(Format::paragraph('Attached to form fields:', 'mt-4'));

$page->write(
    $factory->createTextField('left')->setOuterClass('inline-flex w-40 align-middle')->groupAlign('left')->getOutput().
    $factory->createButton(__('Generate'))->setIcon('solid', 'config')->groupAlign('right')->getOutput()
);

$page->write(
    $factory->createDate('left')->setOuterClass('inline-flex w-40 align-middle')->groupAlign('left')->getOutput().
    $factory->createButton(__('Go'))->groupAlign('right')->getOutput()
);

$page->write(
    $factory->createButton('')->setIcon('basic', 'chevron-left')->groupAlign('left')->getOutput().
    $factory->createSelect('middle')->setOuterClass('inline-flex w-40 align-middle')->groupAlign('middle')->getOutput().
    $factory->createButton('')->setIcon('basic', 'chevron-right')->groupAlign('right')->getOutput()
);

$page->write('<br><br>');

// Basic Actions
$page->write(Format::heading(__('Basic Actions')));
$page->write(Format::paragraph(__('Generally these are attached to tables, forms and details sections.')));

$page->write(
    $factory->createAction('view', __('View'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_display_nav'))
    ->getOutput()
);

$page->write(
    $factory->createAction('add', __('Add'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_display_nav'))
    ->getOutput()
);

$page->write(
    $factory->createAction('edit', __('Edit'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_display_nav'))
    ->getOutput()
);

$page->write(
    $factory->createAction('copy', __('Copy'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_display_nav'))
    ->getOutput()
);

$page->write(
    $factory->createAction('delete', __('Delete'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_display_nav'))
    ->getOutput()
);

// Data Actions
$page->write(Format::heading(__('Data Actions')));
    
$page->write(
    $factory->createAction('accept', __('Accept'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_display_nav'))
    ->getOutput()
);

$page->write(
    $factory->createAction('reject', __('Reject'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_display_nav'))
    ->getOutput()
);

$page->write(
    $factory->createAction('print', __('Print'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_display_nav'))
    ->getOutput()
);

$page->write(
    $factory->createAction('export', __('Export'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_display_nav'))
    ->getOutput()
);

$page->write(
    $factory->createAction('import', __('Import'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_display_nav'))
    ->getOutput()
);

$page->write('<br><br>');
