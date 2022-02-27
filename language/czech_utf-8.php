<?php
// +--------------------------------------------------------------------------+
// | Smiley Plugin - glFusion CMS                                             |
// +--------------------------------------------------------------------------+
// | english_utf-8.php                                                        |
// |                                                                          |
// | English language file                                                    |
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

if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

$LANG_SA00 = array (
    'menulabel'         => 'Správa smajlíků',
    'cc_menulabel'      => 'Smajlíci',
    'plugin'            => 'smajlík',
    'admin_menu'        => 'Správce smajlíků',
    'smiley_index'      => 'Index smajlíků',
    'batch_load'        => 'Importovat smajlíky',
    'smiley'            => 'Smajlík',
    'admin_help'        => 'Plugin smiley administrace umožňuje snadno spravovat smajlíky pluginu fóra.',
    'add_help'          => 'Tato obrazovka umožňuje přidat do systému nové smajlíky.',
    'edit_help'         => 'Tato obrazovka umožňuje upravovat nebo přidávat kódy do existujících smajlíků.',
    'batch_help'        => 'Tato obrazovka umožňuje provést dávkový import smajlíků. Umístěte grafiku smajlíku do <strong>'.$_CONF['path'].'pluginy/smajlík/dávkovénahrání/</strong> adresář. Vyberte smajlíky pro import níže a uložte. Toto je zkopíruje do adresáře smajlíků a přidá je do databáze smajlíků.',
    'smiley_list'       => 'Seznam smajlíků',
    'add_smiley'        => 'Přidat smajlíky',
    'edit_smiley'       => 'Upravit smajlíka',
    'graphic'           => 'Obrázek',
    'code'              => 'Kód',
    'description'       => 'Emoce',
    'delete'            => 'Smazat',
    'move'              => 'Přesunout',
    'order'             => 'Pořadí',
    'up'                => 'Nahoru',
    'down'              => 'Dolů',
    'edit'              => 'Editovat',
    'save'              => 'Uložit',
    'cancel'            => 'Zrušit',
    'confirm_delete'    => 'Opravdu chcete smazat tento smajlík?',
    'first'             => 'První',
    'after'             => 'Po',
    'import'            => 'Importovat',
);

$LANG_SA_ERRORS = array(
    'no_code'           => 'Nebyl zadán žádný kód emotikonu',
    'no_description'    => 'Nebyly vyjádřeny žádné emoce',
    'duplicate_code'    => 'Kód %s již byl použit.',
    'no_upload_path'    => 'Nelze nastavit cestu k nahrávání - zkontrolujte konfiguraci',
    'no_graphic'        => 'Nebyl zadán žádný emotikon.',
    'upload_errors'     => 'Chyby při nahrávání: ',
    'successful_add'    => 'Smajlík byl úspěšně přidán do knihovny.',
    'id_not_found'      => 'ID smajlíka nebylo v databázi nalezeno.',
    'successful_delete' => 'Smajlík byl úspěšně smazán.',
    'not_writable'      => ' smajlík/ adresář není webovým serverem zapisovatelný',
    'already_exists'    => ' již existuje v adresáři smajlíků.',
    'copy_error'        => 'Nelze zkopírovat smajlíky do adresáře public_html/smiley/.',
    'import_dir_err'    => 'Adresář importu nelze vyhledat: ' . $_CONF['path'].'pluginy/smajlík/hromadnénahrávání /',
    'no_smileys_found'  => 'Žádné smilie, kde se nachází v adresáři dávky.',
);
$PLG_smiley_MESSAGE1 = 'Aktualizace pluginu smiley: Aktualizace byla úspěšně dokončena.';
$PLG_smiley_MESSAGE2 = 'Aktualizace pluginu smiley: Tuto verzi nelze aktualizovat automaticky. Vraťte se do dokumentace pluginu.';
$PLG_smiley_MESSAGE3 = 'Aktualizace pluginu Smajlík selhala - zkontrolujte chybu.log';
$PLG_smiley_MESSAGE4 = 'Smajlík byl úspěšně přidán do knihovny.';
$PLG_smiley_MESSAGE5 = 'Úpravy smajlíků uloženy.';
$PLG_smiley_MESSAGE6 = 'Smajlík byl smazán.';
?>