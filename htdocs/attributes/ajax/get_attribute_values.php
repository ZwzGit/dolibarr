<?php

/* Copyright (C) 2016	Marcos García	<marcosgdf@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

define('NOTOKENRENEWAL','1');
define('NOREQUIREMENU','1');
define('NOREQUIREHTML','1');
define('NOREQUIREAJAX','1');
define('NOREQUIRESOC','1');

require '../../main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/product/class/product.class.php';
require_once DOL_DOCUMENT_ROOT.'/attributes/class/ProductAttribute.class.php';
require_once DOL_DOCUMENT_ROOT.'/attributes/class/ProductAttributeValue.class.php';

header('Content-Type: application/json');

$id = GETPOST('id');

if (!$id) {
	print json_encode(array(
		'error' => 'ID not set'
	));
	die;
}

$prodattr = new ProductAttribute($db);

if ($prodattr->fetch($id) < 0) {
	print json_encode(array(
		'error' => 'Attribute not found'
	));
	die;
}

$prodattrval = new ProductAttributeValue($db);

$res = $prodattrval->fetchAllByProductAttribute($id);

if ($res == -1) {
	print json_encode(array(
		'error' => 'Internal error'
	));
	die;
}

print json_encode($res);