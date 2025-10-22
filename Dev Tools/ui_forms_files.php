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
use Gibbon\View\View;
use Gibbon\Domain\System\SettingGateway;
use Gibbon\Domain\User\PersonalDocumentGateway;

if (Access::denies('Dev Tools', 'ui_forms_components')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Files & Uploads'));

// Form
$form = Form::create('basic', '#');
$form->setFactory(DatabaseFormFactory::create($pdo));

$form->addMeta('test');

// Files
$form->addSection('Files', __('Files'));

$form->addFileUpload('file1')
    ->label(__('File'));

$form->addFileUpload('file2')
    ->label(__('Image'))
    ->accepts('.jpg,.jpeg,.gif,.png')
    ->setMaxUpload(false);

$form->addFileUpload('file3')
    ->label(__('Attachment'))
    ->setMaxUpload(false)
    ->setAttachment('attachment', $session->get('absoluteURL'), $session->get('image_240'));

// Documents
$form->addSection('Documents', __('Documents'));

$documents = ['Test','Test2'];
$uploads = ['Test' => 'Test.pdf'];

$form->addRow()->addColumn()
    ->addDocuments('documents', $documents, $container->get(View::class), $session->get('absoluteURL'), 'edit')
    ->label(__('Documents'))
    ->setAttachments($uploads);

$params = ['student' => true];
$documents = $container->get(PersonalDocumentGateway::class)->selectPersonalDocuments('gibbonPerson', null, $params)->fetchAll();

$form->addRow()->addColumn()
    ->addPersonalDocuments('documents3', $documents, $container->get(View::class), $container->get(SettingGateway::class))
    ->label(__('Personal Documents'));

$form->addSection('submit')->addSubmit();

echo $form->getOutput();

