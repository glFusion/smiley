<?php
// +--------------------------------------------------------------------------+
// | Smiley Plugin for glFusion CMS                                           |
// +--------------------------------------------------------------------------+
// | smiley.php                                                               |
// +--------------------------------------------------------------------------+
// | $Id::                                                                   $|
// +--------------------------------------------------------------------------+
// | Copyright (C) 2009-2010 by the following authors:                        |
// |                                                                          |
// | Mark R. Evans          mark AT glfusion DOT org                          |
// +--------------------------------------------------------------------------+
// |                                                                          |
// | This program is free software; you can redistribute it and/or            |
// | modify it under the terms of the GNU General Public License              |
// | as published by the Free Software Foundation; either version 2           |
// | of the License, or (at your option) any later version.                   |
// |                                                                          |
// | This program is distributed in the hope that it will be useful,          |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of           |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            |
// | GNU General Public License for more details.                             |
// |                                                                          |
// | You should have received a copy of the GNU General Public License        |
// | along with this program; if not, write to the Free Software Foundation,  |
// | Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.          |
// |                                                                          |
// +--------------------------------------------------------------------------+

if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

$_SA_CONF['pi_name']           = 'smiley';
$_SA_CONF['pi_display_name']   = 'Smiley Administration Plugin';
$_SA_CONF['pi_version']        = '1.0.4';
$_SA_CONF['gl_version']        = '1.2.0';
$_SA_CONF['pi_url']            = 'http://www.glfusion.org';

$_SA_table_prefix = $_DB_table_prefix . 'sa_';

$_TABLES['sa_smiley']       = $_SA_table_prefix . 'smiley';
?>