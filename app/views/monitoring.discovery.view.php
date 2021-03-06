<?php
/*
** Zabbix
** Copyright (C) 2001-2018 Zabbix SIA
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**/


$this->addJsFile('gtlc.js');
$this->addJsFile('flickerfreescreen.js');
$this->addJsFile('layout.mode.js');

$widget = (new CWidget())
	->setTitle(_('Status of discovery'))
	->setWebLayoutMode(CView::getLayoutMode())
	->setControls(new CList([
		(new CForm('get'))
			->cleanItems()
			->addVar('action', 'discovery.view')
			->setAttribute('aria-label', _('Main filter'))
			->addItem((new CList())
				->addItem([
					new CLabel(_('Discovery rule'), 'druleid'),
					(new CDiv())->addClass(ZBX_STYLE_FORM_INPUT_MARGIN),
					$data['pageFilter']->getDiscoveryCB()
				])
			),
		(new CTag('nav', true, get_icon('fullscreen')))
			->setAttribute('aria-label', _('Content controls'))
	]));

$discovery_table = CScreenBuilder::getScreen([
	'resourcetype' => SCREEN_RESOURCE_DISCOVERY,
	'mode' => SCREEN_MODE_JS,
	'dataId' => 'discovery',
	'data' => [
		'druleid' => $data['druleid'],
		'sort' => $data['sort'],
		'sortorder' => $data['sortorder']
	]
])->get();

$widget->addItem($discovery_table)->show();
