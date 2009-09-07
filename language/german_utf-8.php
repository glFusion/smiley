<?php
// +--------------------------------------------------------------------------+
// | Smiley Plugin - glFusion CMS                                             |
// +--------------------------------------------------------------------------+
// | german_utf-8.php                                                         |
// |                                                                          |
// | german language file by Tony Kluever                                     |
// +--------------------------------------------------------------------------+
// | $Id:: english_utf-8.php 4876 2009-08-28 20:35:03Z mevans0263            $|
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
    'menulabel'         => 'Smiley-Verwaltung',
    'cc_menulabel'      => 'Smileys',
    'plugin'            => 'Smiley',
    'admin_menu'        => 'Smiley-Admin',
    'smiley_index'      => 'Smiley-Index',
    'batch_load'        => 'Smileys importieren',
    'smiley'            => 'Smiley',
    'admin_help'        => 'Das Smiley-Plugin erlaubt Dir, Smileys für das Forum-Plugin zu verwalten.',
    'add_help'          => 'Hier kannst Du neue Smileys zum System hinzufügen.',
    'edit_help'         => 'Hier kannst Du Codes bearbeiten oder zu existierenden Smileys hinzufügen.',
    'batch_help'        => 'Hier kannst Du mehrere Smileys zugleich importieren. Platziere die Smiley-Grafiken im <strong>'.$_CONF['path'].'plugins/smiley/batchload/</strong> Ordner. Wähle die zu importierenden Smiley unten aus und klicke auf Speichern. Dies kopiert sie in den Smiley-Ordner und fügt sie der Smiley-Datenbank hinzu.',
    'smiley_list'       => 'Smiley-Liste',
    'add_smiley'        => 'Smiley hinzufügen',
    'edit_smiley'       => 'Smiley bearbeiten',
    'graphic'           => 'Grafik',
    'code'              => 'Code',
    'description'       => 'Emotion',
    'delete'            => 'Löschen',
    'move'              => 'Verschieben',
    'order'             => 'Reihenfolge',
    'up'                => 'Hoch',
    'down'              => 'Runter',
    'edit'              => 'Bearbeiten',
    'save'              => 'Speichern',
    'cancel'            => 'Abbruch',
    'confirm_delete'    => 'Möchtest Du dieses Smiley wirklich löschen?',
    'first'             => 'Erstes',
    'after'             => 'Nach',
    'import'            => 'Import',
);

$LANG_SA_ERRORS = array(
    'no_code'           => 'Kein Emoticon-Code eingegeben',
    'no_description'    => 'Keine Emotion eingegeben',
    'duplicate_code'    => 'Code %s wurde schon verwendet.',
    'no_upload_path'    => 'Kann Upload-Pfad nicht setzen - überprüfe die Konfiguration',
    'no_graphic'        => 'Kein Emoticon-Grafik angegeben.',
    'upload_errors'     => 'Fehler beim Hochladen: ',
    'successful_add'    => 'Smiley erfolgreich der Bibliothek hinzugefügt.',
    'id_not_found'      => 'Smiley-ID in Datenbank nicht gefunden.',
    'successful_delete' => 'Smiley erfolgreich gelöscht.',
    'not_writable'      => ' smiley/ Ordner ist nicht beschreibbar',
    'already_exists'    => ' exisitiert schon im Smiley-Ordner.',
    'copy_error'        => 'Kann Smiley nicht in public_html/smiley/ Ordner kopieren.',
    'import_dir_err'    => 'Kann Import-Ordner nicht durchsuchen: ' . $_CONF['path'].'plugins/smiley/batchload/',
    'no_smileys_found'  => 'Es wurden keine Smileys im batchload Ordner gefunden.',
);
$PLG_smiley_MESSAGE1 = 'Smiley plugin upgrade: Update completed successfully.';
$PLG_smiley_MESSAGE2 = 'Smiley plugin upgrade: We are unable to update this version automatically. Refer to the plugin documentation.';
$PLG_smiley_MESSAGE3 = 'Smiley plugin upgrade failed - check error.log';
$PLG_smiley_MESSAGE4 = 'Smiley successfully added to the library.';
$PLG_smiley_MESSAGE5 = 'Smiley edits saved.';
$PLG_smiley_MESSAGE6 = 'Smiley deleted.';
?>