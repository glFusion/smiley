<?php
// +--------------------------------------------------------------------------+
// | Smiley Plugin - glFusion CMS                                             |
// +--------------------------------------------------------------------------+
// | english.php                                                              |
// |                                                                          |
// | English language file                                                    |
// +--------------------------------------------------------------------------+
// | $Id::                                                                   $|
// +--------------------------------------------------------------------------+
// | Copyright (C) 2009 by the following authors:                             |
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

$LANG_SA00 = array (
    'menulabel'         => 'Smiley Administration',
    'cc_menulabel'      => 'Smiley\'s',
    'plugin'            => 'smiley',
    'admin_menu'        => 'Smiley Admin',
    'smiley_index'      => 'Smiley Index',
    'batch_load'        => 'Import Smileys',
    'smiley'            => 'Smiley',
    'admin_help'        => 'The Smiley Administration plugin allows you to easily manage smilies for the Forum plugin.',
    'add_help'          => 'This screen allows you to add new smileys to the system.',
    'edit_help'         => 'This screen allows you to edit or add codes to existing smileys.',
    'batch_help'        => 'This screen allows you to perform a batch import of smileys.  Place the smiley graphics in the <strong>'.$_CONF['path'].'plugins/smiley/batchload/</strong> directory.  Pick the smileys to import below and save. This will copy them to the smiley directory and add them to the smiley database.',
    'smiley_list'       => 'Smiley List',
    'add_smiley'        => 'Add Smiley',
    'edit_smiley'       => 'Edit Smiley',
    'graphic'           => 'Graphic',
    'code'              => 'Code',
    'description'       => 'Emotion',
    'delete'            => 'Delete',
    'move'              => 'Move',
    'order'             => 'Order',
    'up'                => 'Up',
    'down'              => 'Down',
    'edit'              => 'Edit',
    'save'              => 'Save',
    'cancel'            => 'Cancel',
    'confirm_delete'    => 'Are you sure you want to delete this smiley?',
    'first'             => 'First',
    'after'             => 'After',
    'import'            => 'Import',
);

$LANG_SA_ERRORS = array(
    'no_code'           => 'No emoticon code entered',
    'no_description'    => 'No emotion entered',
    'duplicate_code'    => 'Code %s has already been used.',
    'no_upload_path'    => 'Unable to set upload path - check configuration',
    'no_graphic'        => 'No emoticon graphic entered.',
    'upload_errors'     => 'Errors on upload: ',
    'successful_add'    => 'Smiley successfully added to the library.',
    'id_not_found'      => 'Smiley ID was not found in the database.',
    'successful_delete' => 'Smiley successfully deleted.',
    'not_writable'      => ' smiley/ directory is not writable by the web server',
    'already_exists'    => ' already exists in smiley directory.',
    'copy_error'        => 'Unable to copy smiley to public_html/smiley/ directory.',
    'import_dir_err'    => 'Unable to search import directory: ' . $_CONF['path'].'plugins/smiley/batchload/',
    'no_smileys_found'  => 'No smilies where found in the batchload directory.',
);
$PLG_smiley_MESSAGE1 = 'Smiley plugin upgrade: Update completed successfully.';
$PLG_smiley_MESSAGE2 = 'Smiley plugin upgrade: We are unable to update this version automatically. Refer to the plugin documentation.';
$PLG_smiley_MESSAGE3 = 'Smiley plugin upgrade failed - check error.log';
$PLG_smiley_MESSAGE4 = 'Smiley successfully added to the library.';
$PLG_smiley_MESSAGE5 = 'Smiley edits saved.';
$PLG_smiley_MESSAGE6 = 'Smiley deleted.';
?>