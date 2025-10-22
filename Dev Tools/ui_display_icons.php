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

use Gibbon\UI\Icon;
use Gibbon\Services\Format;
use Gibbon\Tables\DataTable;
use Gibbon\Tables\View\GridView;
use Gibbon\Support\Facades\Access;
use Gibbon\Module\DevTools\DevFormat;


if (Access::denies('Dev Tools', 'ui_display_icons')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Icon Library'));

$libraries = Icon::getLibraryList();

foreach ($libraries as $library) {
    $class = $library == 'Large'? 'size-10 text-gray-600 hover:text-blue-500' : 'size-6 text-gray-600 hover:text-blue-500';
    $icons = Icon::getLibrary($library, $class);

    $table = DataTable::create($library)->setRenderer(new GridView($container->get('twig')));
    $table->setTitle(ucwords($library));
    $table->setDescription(DevFormat::code("icon('".strtolower($library)."', 'icon-name', '{$class}')").'</code>');

    $table->addMetaData('gridClass', 'gap-4');
    $table->addMetaData('gridItemClass', 'flex justify-start border w-48 rounded text-center text-gray-600 text-xs px-4 py-8 gap-1 hover:bg-gray-100');
    $table->addMetaData('allowHTML', ['icon']);

    $table->addColumn('icon');
    $table->addColumn('name')
        ->format(function ($values) {
            return !empty($values['alias'])
                ? $values['name'].'<br>'.Format::small($values['alias'])
                : $values['name'];
        });

    $iconList = [];
    $alias = array_flip($icons['alias'] ?? []);

    foreach ($icons as $name => $icon) {
        if ($name == 'alias') continue;

        $iconList[] = [
            'name' => $name,
            'icon' => $icon,
            'alias' => $alias[$name] ?? ''
        ];
    }

    $page->write($table->render($iconList));
}

