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
use Gibbon\Tables\Prefab\ReportTable;
use Gibbon\Http\Url;
use Gibbon\Services\Format;
use Gibbon\Domain\User\RoleGateway;

if (Access::denies('Dev Tools', 'ui_tables_report')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$viewMode = $_REQUEST['format'] ?? '';

if (empty($viewMode)) {
    $page->breadcrumbs->add(__m('Report Tables'));
}


$gateway = $container->get(RoleGateway::class);
$criteria = $gateway->newQueryCriteria()
    ->pageSize(10)
    ->fromPost();

$sampleData = $gateway->queryRoles($criteria);

$table = ReportTable::createPaginated('table2', $criteria)->setViewMode($viewMode, $session);
$table->setTitle(__('Report Table'));
$table->setDescription(__('Report tables automatically add print and export options to the header.'));

$table->addMetaData('filterOptions', [
    'active:yes' => __('Active').': '.__('Yes'),
    'active:no'  => __('Active').': '.__('No'),
]);

$table->addColumn('category', __('Category'))->translatable();

$table->addColumn('name', __('Name'))->translatable();

$table->addColumn('nameShort', __('Short Name'));

$table->addColumn('description', __('Description'))->translatable();

$table->addColumn('type', __('Type'))->translatable();


$page->write($table->render($sampleData));
