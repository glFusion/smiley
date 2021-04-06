<?php
// +--------------------------------------------------------------------------+
// | Smiley Plugin for glFusion CMS                                           |
// +--------------------------------------------------------------------------+
// | upgrade.php                                                              |
// |                                                                          |
// | Upgrade routines                                                         |
// +--------------------------------------------------------------------------+
// | Copyright (C) 2009-2017 by the following authors:                        |
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

// this file can't be used on its own
if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

function smiley_upgrade()
{
    global $_TABLES, $_CONF, $_SA_CONF, $_DB_table_prefix;

    $currentVersion = DB_getItem($_TABLES['plugins'],'pi_version',"pi_name='smiley'");

    switch ($currentVersion) {
        case '1.0.0' :
        case '1.0.1' :
        case '1.0.2' :
        case '1.0.3' :
        case '1.0.4' :
        case '1.0.5' :
        case '1.0.6' :
        case '1.0.7' :
        case '1.0.8' :
            DB_query("UPDATE {$_TABLES['groups']} SET grp_gl_core=2 WHERE grp_name='Smiley Admin'",1);

        case '1.0.9' :
            // no changes
        case '1.0.10' :
            // no changes
        case '1.0.11' :
            // no changes
        case '1.0.12' :
            // no changes
        case '1.0.13' :
            // no changes
        case '1.1.0' :
            // no changes

        default:
            DB_query("UPDATE {$_TABLES['plugins']} SET pi_version='".$_SA_CONF['pi_version']."',pi_gl_version='".$_SA_CONF['gl_version']."' WHERE pi_name='smiley' LIMIT 1");
            break;
    }

    CTL_clearCache();

    if ( DB_getItem($_TABLES['plugins'],'pi_version',"pi_name='smiley'") == $_SA_CONF['pi_version']) {
        return true;
    } else {
        return false;
    }
}
?>