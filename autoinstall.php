<?php
// +--------------------------------------------------------------------------+
// | Smiley Plugin for glFusion CMS                                           |
// +--------------------------------------------------------------------------+
// | autoinstall.php                                                          |
// |                                                                          |
// | glFusion Auto Installer module                                           |
// +--------------------------------------------------------------------------+
// | Copyright (C) 2009-2014 by the following authors:                        |
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

global $_DB_dbms;

require_once $_CONF['path'].'plugins/smiley/smiley.php';
require_once $_CONF['path'].'plugins/smiley/sql/mysql_install.php';

// +--------------------------------------------------------------------------+
// | Plugin installation options                                              |
// +--------------------------------------------------------------------------+

$INSTALL_plugin['smiley'] = array(
    'installer' => array('type' => 'installer', 'version' => '1', 'mode' => 'install'),
    'plugin' => array('type' => 'plugin', 'name' => $_SA_CONF['pi_name'], 'ver' => $_SA_CONF['pi_version'], 'gl_ver' => $_SA_CONF['gl_version'], 'url' => $_SA_CONF['pi_url'], 'display' => $_SA_CONF['pi_display_name']),
    array('type' => 'table', 'table' => $_TABLES['sa_smiley'], 'sql' => $_SQL['sa_smiley']),
    array('type' => 'group', 'group' => 'Smiley Admin', 'desc' => 'Administrators of the Smiley Plugin',
            'variable' => 'admin_group_id', 'addroot' => true, 'admin' => true),
    array('type' => 'feature', 'feature' => 'smiley.admin', 'desc' => 'Ability to administer the Smiley plugin', 'variable' => 'admin_feature_id'),
    array('type' => 'mapping', 'group' => 'admin_group_id', 'feature' => 'admin_feature_id', 'log' => 'Adding PM feature to the PM admin group'),

    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[0]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[1]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[2]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[3]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[4]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[5]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[6]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[7]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[8]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[9]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[10]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[11]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[12]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[13]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[14]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[15]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[16]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[17]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[18]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[19]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[20]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[21]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[22]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[23]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[24]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[25]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[26]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[27]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[28]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[29]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[30]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[31]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[32]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[33]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[34]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[35]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[36]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[37]),
    array('type' => 'sql', 'sql' => $_SQLDEFAULTS[38]),
);

/**
* Puts the datastructures for this plugin into the glFusion database
*
* Note: Corresponding uninstall routine is in functions.inc
*
* @return   boolean True if successful False otherwise
*
*/
function plugin_install_smiley()
{
    global $INSTALL_plugin, $_SA_CONF, $_SQLDEFAULTS;

    $pi_name            = $_SA_CONF['pi_name'];
    $pi_display_name    = $_SA_CONF['pi_display_name'];
    $pi_version         = $_SA_CONF['pi_version'];

    COM_errorLog("Attempting to install the $pi_display_name plugin", 1);

    $ret = INSTALLER_install($INSTALL_plugin[$pi_name]);
    if ($ret > 0) {
        return false;
    }
    return true;
}

/**
* Automatic uninstall function for plugins
*
* @return   array
*
* This code is automatically uninstalling the plugin.
* It passes an array to the core code function that removes
* tables, groups, features and php blocks from the tables.
* Additionally, this code can perform special actions that cannot be
* foreseen by the core code (interactions with other plugins for example)
*
*/

function plugin_autouninstall_smiley ()
{
    $out = array (
        /* give the name of the tables, without $_TABLES[] */
        'tables' => array ( 'sa_smiley'),
        /* give the full name of the group, as in the db */
        'groups' => array('Smiley Admin'),
        /* give the full name of the feature, as in the db */
        'features' => array('smiley.admin'),
        /* give the full name of the block, including 'phpblock_', etc */
        'php_blocks' => array(),
        /* give all vars with their name */
        'vars'=> array()
    );
    return $out;
}
?>