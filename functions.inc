<?php
// +--------------------------------------------------------------------------+
// | Smiley Plugin for glFusion CMS                                           |
// +--------------------------------------------------------------------------+
// | functions.inc                                                            |
// |                                                                          |
// | Implement the glFusion Plugin API                                        |
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
    die ('This file can not be used on its own!');
}

// Initialize the configuration

require_once $_CONF['path_system'] . 'classes/config.class.php';
$sa_config = config::get_instance();
$_SA_CONF = $sa_config->get_config('smiley');
require_once $_CONF['path'].'plugins/smiley/smiley.php';

$langfile = $_CONF['path'] . 'plugins/smiley/language/' . $_CONF['language'] . '.php';
if (file_exists ($langfile)) {
    require_once $langfile;
} else {
    require_once $_CONF['path'].'plugins/smiley/language/english.php';
}

function plugin_chkVersion_smiley() {
    global $_SA_CONF;

    return $_SA_CONF['pi_version'];
}

function plugin_geticon_smiley() {
    global $_CONF;

    $retval = $_CONF['site_admin_url'].'/plugins/smiley/images/smiley.png';
    return $retval;
}

function plugin_upgrade_smiley(){
    global $_CONF, $_TABLES, $_SA_CONF, $_DB_table_prefix;

    if ( @file_exists($_CONF['path'].'plugins/smiley/upgrade.php') ) {
        require_once $_CONF['path'].'plugins/smiley/upgrade.php';
        return smiley_upgrade();
    } else {
        COM_errorLog("Smiley plugin upgrade function not implemented");
        return 3001;
    }
}

function plugin_getadminoption_smiley()
{
    global $_TABLES, $_CONF, $_SA_CONF, $LANG_SA00;

    if (SEC_hasRights('smiley.admin')) {
        return array($LANG_SA00['cc_menulabel'], $_CONF['site_admin_url'] . '/plugins/smiley/index.php',DB_count($_TABLES['sa_smiley']) );
    }
}

function plugin_cclabel_smiley()
{
    global $_CONF, $LANG_SA00;

    if (SEC_hasRights('smiley.admin')) {
        return array($LANG_SA00['cc_menulabel'],$_CONF['site_admin_url'] . '/plugins/smiley/index.php',$_CONF['site_admin_url'] . '/plugins/smiley/images/smiley.png');
    } else {
        return false;
    }
}

/**
 * Set template variable
 *
 * This plugin uses the 'templatesetvars' hook to insert the smiley
 * configuration code for the CKEditor or TinyMCE editor
 *
 * @param   string  Template type - only processes ckeditor or tinymce
 * @param   class   Template class handle
 * @return  string  blank
 */
function plugin_templatesetvars_smiley($ctype, &$template)
{
    global $_CONF, $_SA_CONF, $_TABLES;

    if ( $ctype != 'ckeditor') return;

    $smileyArray = array();
    $retval = '';

    $retval .= 'smiley_columns : 6,' . LB;
    $sql = "SELECT * FROM {$_TABLES['sa_smiley']} ORDER BY display_order";
    $result = DB_query($sql);
    while ( $row = DB_fetchArray($result) ) {
        $smileyArray[] = $row;
    }
    $retval .=  'smiley_descriptions : [';
    $first = 1;
    foreach ($smileyArray AS $smiley) {
        if ($first == 0) {
            $retval .= ',';
        }
        $emoticonArray = unserialize($smiley['emoticon']);
        $retval .= "'" . $emoticonArray[0] . "'";
        $first = 0;
    }
    $retval .= '],' . LB;

    $first = 1;
    $retval .= 'smiley_images : [';
    foreach ($smileyArray AS $smiley) {
        if ($first == 0) {
            $retval .= ',';
        }
        $retval .= "'" . $smiley['graphic'] . "'";
        $first = 0;
    }
    $retval .= '],' . LB;
    $retval .= "smiley_path : '";
    $retval .= $_CONF['site_url'].'/smiley/smiley/';
    $retval .= "',";

    $template->set_var(array('smilies'   => $retval));
}



/**
* Implement replace Emoticon API
*
* Replace emoticons in the passed text with the appropriate <img> tag for
* the smiley.
*
* @param    string  $text   the text string to replace codes with images
* @return   string          text with the smiley <img> tags
*
*/
function msg_replaceEmoticons( $text ) {
    global $_CONF, $_SA_CONF, $_TABLES;

    static $arr_smilies = array();
    static $smiley_array = array();
    static $replacement_array = array();

    preg_match_all("/\[\w+:[^\]]*\]/", $text, $matches);
    $counter = 0;
    $queue = array();
    foreach($matches[0] AS $match) {
        $text = str_replace($match,"##".$counter."##",$text);
        $queue[$counter] = $match;
        $counter++;
    }

    if ( is_array($arr_smilies) && count($arr_smilies) < 1 ) {
        $arrCount = 0;
        $sql = DB_query("SELECT emoticon,graphic,description FROM {$_TABLES['sa_smiley']}");
        while ( list($emoticon,$graphic,$description) = DB_fetchArray($sql)) {
            $emoticons = unserialize($emoticon);
            $x = count($emoticons);
            for ( $i = 0; $i < $x; $i++ ) {
                $arr_smilies[] = array('code' => $emoticons[$i], 'graphic' => $graphic, 'description' => $description, 'size' => strlen($emoticons[$i]));
            }
        }
        if ( count($arr_smilies) > 0 ) {
            @usort($arr_smilies,"SA_cmp");
        }

        foreach ($arr_smilies AS $smiley) {
            $smiley_array[] = htmlspecialchars($smiley['code'],ENT_NOQUOTES);
            $replacement_array[] = '<img src="'.$_CONF['site_url'].'/smiley/smiley/'.$smiley['graphic'].'" alt="'.$smiley['description'].'" title="'.$smiley['description'].'" border="0" />';
        }

    }
    if ( is_array($smiley_array) && is_array($replacement_array) ) {
        $text = str_replace($smiley_array,$replacement_array,$text);
    }

    foreach($queue AS $counter => $rpl) {
        $text = str_replace("##".$counter."##",$rpl, $text);
    }

    return $text;
}

function SA_cmp($a, $b)
{
    if ( $a['size'] == $b['size'] ) {
        return 0;
    }
    return ($a['size'] < $b['size']) ? 1 : -1;
}

/**
* Implement restore Emoticon API
*
* Replace smiley images in the passed text with the appropriate emoticon code for
* the smiley.
*
* @param    string  $text   the text string to replace images with codes
* @return   string          text with the smiley emoticon codes
*
*/
function msg_restoreEmoticons( $text ) {
    global $_CONF, $_SA_CONF, $_TABLES;

    static $arr_smilies;

    if ( count($arr_smilies) < 1 ) {
        $arrCount = 0;
        $sql = DB_query("SELECT emoticon,graphic,description FROM {$_TABLES['sa_smiley']}");
        while ( list($emoticon,$graphic,$description) = DB_fetchArray($sql)) {
            $emoticons = unserialize($emoticon);
            $x = count($emoticons);
            for ( $i = 0; $i < $x; $i++ ) {
                $arr_smilies[] = array('code' => $emoticons[$i], 'graphic' => $graphic, 'description' => $description, 'size' => strlen($emoticons[$i]));
            }
        }
        if ( count($arr_smilies) > 0 ) {
            @usort($arr_smilies,"SA_cmp");
        }
    }

    if ( is_array($arr_smilies) ) {
        foreach ( $arr_smilies AS $smiley ) {
            $text = str_replace('<img src="'.$_CONF['site_url'].'/smiley/smiley/'. $smiley['graphic'] . '" alt="'.$smiley['description'].'" title="'.$smiley['description'].'" border="0" />',
                htmlspecialchars($smiley['code'],ENT_NOQUOTES),$text);
        }
    }
    return $text;

}

/**
* Implement display smiley API
*
* Returns a formatted string of available smileys.
*
* @return   string          text with available smileys
*
*/
function msg_showsmilies($wysiwyg = 0)
{
    global $_TABLES,$_CONF,$_SA_CONF;

    $smilies = '';

    $emoticonsArray = array();
    $query = DB_query("SELECT id,emoticon,graphic,description FROM {$_TABLES['sa_smiley']} ORDER BY display_order ASC");
    while ( list($id,$emoticon,$graphic,$description) = DB_fetchArray($query)) {
        if ( @file_exists($_CONF['path_html'].'smiley/smiley/'.$graphic) ) {
            $emoticons = unserialize($emoticon);
            $emoticonsArray[$graphic]['desc'] = $description;
            $emoticonsArray[$graphic]['code'] = $emoticons[0];
        }
    }
    if ( $wysiwyg ) {
        $emoticonjs = 'emoticon_wysiwyg';
    } else {
        $emoticonjs = 'emoticon';
    }

    foreach ($emoticonsArray as $key => $smiley) {
        $smilies .= '<a href="javascript:'.$emoticonjs.'(\'' .htmlentities($smiley['code'],ENT_QUOTES,COM_getEncodingt()).'\')"><img vspace="1" src="' .$_CONF['site_url'].'/smiley/smiley/'. $key. '" alt="' . $smiley['desc']. '" title="' .$smiley['desc']. '" border="0" /></a> ';
    }
    return $smilies;
}
?>