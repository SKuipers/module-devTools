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
use Gibbon\UI\Chart\Chart;
use Gibbon\Services\Format;

if (Access::denies('Dev Tools', 'ui_display_charts')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Graphs & Charts'));

$sampleData = include('data/sampleChartData.php');

// Bar
$page->write(Format::heading(__('Bar Chart')));

$chart = Chart::create('exampleChart1', 'bar')
    ->setOptions([
        'height' => '340px',
        'scales' => [
            'x' => [
                'stacked' => false,
            ],
            'y' => [
                'stacked' => false,
            ]
        ],
    ])
    ->setLabels(array_column($sampleData, 'name'))
    ->setColors(['rgba(153, 102, 255, 1.0)', 'rgba(255, 159, 64, 1.0)']);

$chart->addDataset('data1', __('Success'))->setData(array_column($sampleData, 'data1'));
$chart->addDataset('data2', __('Failure'))->setData(array_column($sampleData, 'data2'));

$page->write($chart->render());
$page->write('<br><br>');


// Line
$page->write(Format::heading(__('Line Chart')));

$chart = Chart::create('exampleChart2', 'line')
    ->setOptions([
        'height' => '340px',
        'scales' => [
            'x' => [
                'stacked' => false,
            ],
            'y' => [
                'stacked' => false,
            ]
        ],
    ])
    ->setLabels(array_column($sampleData, 'name'));

$chart->addDataset('data1', __('Success'))->setData(array_column($sampleData, 'data1'));
$chart->addDataset('data2', __('Failure'))->setData(array_column($sampleData, 'data2'));

$page->write($chart->render());
$page->write('<br><br>');

// Pie
$page->write(Format::heading(__('Pie Chart')));

$chart = Chart::create('exampleChart3', 'pie')
    ->setOptions([
        'height' => '340px',
        'scales' => [
            'x' => [
                'stacked' => false,
            ],
            'y' => [
                'stacked' => false,
            ]
        ],
    ])
    ->setLabels(array_column($sampleData, 'name'));

$chart->addDataset('data1')->setData(array_column($sampleData, 'data1'));

$page->write($chart->render());
