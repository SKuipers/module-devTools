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
use Gibbon\View\Components\ReturnMessage;
use Gibbon\Services\Format;

if (Access::denies('Dev Tools', 'ui_display_alerts')) {
	$page->addError(__('You do not have access to this action.'));
    return;
}

$page->breadcrumbs->add(__m('Return Codes'));

// Alerts
$page->write(Format::heading(__('Alert Types')));

$page->write(Format::alert('Magic: '. __('Something neat has just happened, like a quicksave.'), 'magic'));

$page->write(Format::alert('Message: '. __('This is a helpful message or useful tip.'), 'message'));

$page->write(Format::alert('Success: '. __('Your request was completed successfully.'), 'success'));

$page->write(Format::alert('Warning: '. __('Your request was successful, but some data was not properly saved.'), 'warning'));

$page->write(Format::alert('Error: '. __('Your request failed due to a database error.'), 'error'));

$page->write(Format::alert('Exception: '. __('Something has gone horribly wrong in the code.'), 'exception'));

$page->write(Format::alert('Empty: '. __('There is nothing here, this is an empty state.'), 'empty'));

$page->write('<br><br>');


// Return codes
$page->write(Format::heading(__('Return Codes')));

$returns = $container->get(ReturnMessage::class);
$returnCodes = $returns->getReturns();

foreach ($returnCodes as $code => $message) {
    $return = $returns->process($code);
    $page->write(Format::alert($code.': '.$return['text'], $return['context']));
}
