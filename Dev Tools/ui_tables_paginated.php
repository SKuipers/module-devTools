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
use Gibbon\Tables\DataTable;
use Gibbon\Services\Format;
use Gibbon\Support\Facades\Access;
use Gibbon\Domain\System\I18nGateway;

if (Access::denies('Dev Tools', 'ui_tables_paginated')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Paginated Tables'));

$gateway = $container->get(I18nGateway::class);
$criteria = $gateway->newQueryCriteria()
    ->pageSize(10)
    ->fromPost();

$sampleData = $gateway->queryI18n($criteria);

$table = DataTable::createPaginated('table2', $criteria);
$table->setTitle(__('Paginated Table'));
$table->setDescription(__('Paginated tables automatically handle multiple pages of data, as well as sorting and filtering results.'));

$table->addHeaderAction('add', __('Add'))
    ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_tables_paginated'))
    ->displayLabel();

$table->addMetaData('filterOptions', [
    'active:yes' => __('Active').': '.__('Yes'),
    'active:no'  => __('Active').': '.__('No'),
]);

$table->addColumn('name', __('Name'))
    ->context('primary')
    ->width('50%');

$table->addColumn('code', __('Code'))
    ->context('secondary')
    ->width('10%');

$table->addColumn('active', __('Active'))
    ->context('primary')
    ->format(Format::using('yesNo', 'active'));

$table->addActionColumn()
    ->addParam('gibboni18nID')
    ->format(function ($values, $actions) {
        $actions->addAction('edit', __('Edit'))
            ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_tables_paginated'));

        $actions->addAction('copy', __('Duplicate'))
            ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_tables_paginated'));

        $actions->addAction('delete', __('Delete'))
            ->setURL(Url::fromModuleRoute('Dev Tools', 'ui_tables_paginated'));
    });


$page->write($table->render($sampleData));
