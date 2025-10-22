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

if (Access::denies('Dev Tools', 'ui_forms_select')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Select Lists'));


// Form
$form = Form::create('select', '#');
$form->setFactory(DatabaseFormFactory::create($pdo));

$form->addMeta();

// User Data
$form->addSection('User Data', __('User Data'));

$form->addSelectTitle('title')
    ->label(__('Title'));

$form->addSelectGender('gender')
    ->label(__('Gender'));

$form->addSelectRole('Role')
    ->label(__('Role'));
    
$form->addSelectStatus('Status')
    ->label(__('Status'));

$form->addSelectRelationship('Relationship')
    ->label(__('Relationship'));

$form->addSelectEmergencyRelationship('EmergencyRelationship')
    ->label(__('Emergency Relationship'));

$form->addSelectMaritalStatus('MaritalStatus')
    ->label(__('Marital Status'));
    
$form->addSelectTransport('Transport')
    ->label(__('Transport'));

$form->addTextFieldDistrict('District')
    ->label(__('District'));


// School Data
$form->addSection('School Data', __('School Data'));

$form->addSelectSchoolYear('SchoolYear')
    ->label(__('School Year'));

$form->addSelectSchoolYearTerm('SchoolYearTerm', $session->get('gibbonSchoolYearID'))
    ->label(__('School Year Term'));

$form->addSelectYearGroup('YearGroup')
    ->label(__('Year Group'));

$form->addSelectFormGroup('FormGroup', $session->get('gibbonSchoolYearID'))
    ->label(__('Form Group'));

$form->addSelectDepartment('Department')
    ->label(__('Department'));

$form->addSelectCourseByYearGroup('Course', $session->get('gibbonSchoolYearID'), '001,002,003')
    ->label(__('Course'));

$form->addSelectClass('Class', $session->get('gibbonSchoolYearID'))
    ->label(__('Class'));

$form->addSelectSpace('Space')
    ->label(__('Space'));
    
$form->addSelectHouse('House')
    ->label(__('House'));

// Assessment Data
$form->addSection('Assessment Data', __('Assessment Data'));

$form->addSelectReportingCycle('ReportingCycle')
    ->label(__('Reporting Cycle'));

$form->addSelectGradeScale('GradeScale')
    ->label(__('Grade Scale'));

$form->addSelectGradeScaleGrade('GradeScaleGrade', '1')
    ->label(__('Grade'));

$form->addSelectRubric('Rubric', '001,002,003')
    ->label(__('Rubric'));

// System Data
$form->addSection('System Data', __('System Data'));

$form->addSelectSystemLanguage('SystemLanguage')
    ->label(__('System Language'))->placeholder();

$form->addSelectCurrency('Currency')
    ->label(__('Currency'));

$form->addSelectTimezone('Timezone')
    ->label(__('Timezone'));

$form->addSelectI18n('I18n')
    ->label(__('I18n'));

$form->addSelectLanguage('Language')
    ->label(__('Language'));

$form->addSelectCountry('Country')
    ->label(__('Country'));

$form->addSelectTheme('Theme')
    ->label(__('Theme'));

$form->addSelectAlert('Alert')
    ->label(__('Alert'));


// Database Checkboxes
$form->addSection('Checkboxes', __('Checkboxes'));

$form->addCheckboxYearGroup('CheckboxYearGroup')
    ->label(__('Year Group'))
    ->addCheckAllNone();

$form->addCheckboxSchoolYearTerm('CheckboxSchoolYearTerm', $session->get('gibbonSchoolYearID'))
    ->label(__('School Year Term'));


$form->addSection('submit')->addSubmit();

echo $form->getOutput();
