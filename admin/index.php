<?php
// +--------------------------------------------------------------------------+
// | Smiley Plugin for glFusion CMS                                           |
// +--------------------------------------------------------------------------+
// | index.php                                                                |
// |                                                                          |
// | Administrative interface                                                 |
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

require_once '../../../lib-common.php';
require_once '../../auth.inc.php';

if (!SEC_inGroup('Root')) {
    // Someone is trying to illegally access this page
    COM_errorLog("Someone has tried to access the Smiley admin page.  User id: {$_USER['uid']}, Username: {$_USER['username']}, IP: $REMOTE_ADDR",1);
    $display = COM_siteHeader ('menu', $LANG_ACCESS['accessdenied'])
             . COM_startBlock ($LANG_ACCESS['accessdenied'])
             . $LANG_ACCESS['plugin_access_denied_msg']
             . COM_endBlock ()
             . COM_siteFooter ();
    echo $display;
    exit;
}

USES_lib_admin();

function listSmiley()
{
    global $_CONF, $_SA_CONF, $_TABLES, $LANG_SA00, $LANG_ADMIN;

    $retval = '';

    $menu_arr = array (
        array('url' => $_CONF['site_admin_url'] . '/plugins/smiley/index.php?mode=add',
              'text' => $LANG_SA00['add_smiley']),
        array('url' => $_CONF['site_admin_url'] . '/plugins/smiley/index.php?mode=import',
              'text' => $LANG_SA00['batch_load']),
        array('url' => $_CONF['site_admin_url'],
              'text' => $LANG_ADMIN['admin_home'])
    );

    $retval .= COM_startBlock($LANG_SA00['menulabel'], '',
                              COM_getBlockTemplate('_admin_block', 'header'));

    $retval .= ADMIN_createMenu(
        $menu_arr,
        $LANG_SA00['admin_help'],
        $_CONF['site_admin_url'] . '/plugins/smiley/images/smiley.png'
    );

    $header_arr = array(
        array('text' => $LANG_SA00['edit'],'field' => 'edit', 'align' => 'center', 'sort' => false),
        array('text' => $LANG_SA00['graphic'], 'field' => 'graphic', 'align' => 'center'),
        array('text' => $LANG_SA00['code'], 'field' => 'emoticon'),
        array('text' => $LANG_SA00['description'], 'field' => 'description'),
        array('text' => $LANG_SA00['move'], 'field' => 'move', 'align' => 'center','sort' => false),
        array('text' => $LANG_SA00['delete'], 'field' => 'delete', 'align' => 'center', 'sort' => false),
    );

    $options = array('chkselect' => true,
                     'chkfield' => 'id',
                     'chkname' => 'selitem',
                     'chkminimum' => 0,
                     'chkall' => true,
                     'chkactions' => ''
                     );

    $data_arr = array();
    $text_arr = array();

    $text_arr = array(
        'has_extras' => false,
        'form_url'   => $_CONF['site_admin_url'] . '/plugins/smiley/index.php',
        'help_url'   => ''
    );

    $defsort_arr = array('field'     => 'display_order',
                         'direction' => 'ASC');

    $sql = "SELECT * FROM {$_TABLES['sa_smiley']}";

    $query_arr = array('table'          => 'sa_smiley',
                       'sql'            => $sql,
                       'query_fields'   => array('id','code','image','description','emoticon','display_order'),
                       'default_filter' => '');

    $retval .= ADMIN_list('smiley', 'ADMIN_getListField_smiley', $header_arr,
                          $text_arr, $query_arr, $defsort_arr,'','',$options);

    $retval .= COM_endBlock(COM_getBlockTemplate('_admin_block', 'footer'));
    return $retval;
}

function ADMIN_getListField_smiley($fieldname, $fieldvalue, $A, $icon_arr)
{
    global $_CONF, $_SA_CONF, $LANG_SA00, $LANG_ADMIN;

    $retval = '';

    switch ($fieldname) {
        case 'edit':
            $retval = COM_createLink($icon_arr['edit'], $_CONF['site_admin_url'].'/plugins/smiley/index.php?mode=edit&amp;id='.$A['id']);
            break;
        case 'graphic' :
            $retval = '<img src="'.$_CONF['site_url'].'/smiley/smiley/'.$fieldvalue.'" alt="'.$A['description'].'" title="'.$A['description'].'" />';
            break;
        case 'delete' :
            $attr['title'] = $LANG_ADMIN['delete'];
            $attr['onclick'] = "return confirm('" . $LANG_SA00['confirm_delete'] . "');";
            $retval = COM_createLink($icon_arr['delete'],
                $_CONF['site_admin_url'].'/plugins/smiley/index.php?mode=delete&amp;id='.$A['id'],
                $attr);
            break;
        case 'emoticon' :
            $emoticons = unserialize($fieldvalue);
            if ( is_array($emoticons) ) {
                $retval = implode('  ',$emoticons);
            } else {
                $retval = $emoticons;
            }
            $retval = htmlspecialchars($retval);
            break;
        case 'move' :
            $uplink = '<a href="'.$_CONF['site_admin_url'].'/plugins/smiley/index.php?mode=move&amp;direction=up&amp;id='.$A['id'].'"><img src="'.$_CONF['site_admin_url'].'/plugins/smiley/images/up.png" alt="'.$LANG_SA00['up'].'" /></a>';
            $downlink = '<a href="'.$_CONF['site_admin_url'].'/plugins/smiley/index.php?mode=move&amp;direction=down&amp;id='.$A['id'].'"><img src="'.$_CONF['site_admin_url'].'/plugins/smiley/images/down.png" alt="'.$LANG_SA00['down'].'" /></a>';
            $retval = $uplink . '&nbsp;&nbsp;'.$downlink;
            break;
        default:
            $retval = $fieldvalue;
            break;
    }

    return $retval;
}

function addSmiley()
{
    global $_CONF, $_SA_CONF, $_TABLES, $LANG_SA00,$LANG_ADMIN;

    $retval = '';

    $menu_arr = array (
        array('url' => $_CONF['site_admin_url'] . '/plugins/smiley/index.php',
              'text' => $LANG_SA00['smiley_list']),
        array('url' => $_CONF['site_admin_url'] . '/plugins/smiley/index.php?mode=import',
              'text' => $LANG_SA00['batch_load']),
        array('url' => $_CONF['site_admin_url'],
              'text' => $LANG_ADMIN['admin_home'])
    );

    $retval .= COM_startBlock($LANG_SA00['menulabel'] . ' :: '. $LANG_SA00['add_smiley'], '',
                              COM_getBlockTemplate('_admin_block', 'header'));

    $retval .= ADMIN_createMenu(
        $menu_arr,
        $LANG_SA00['add_help'],
        $_CONF['site_admin_url'] . '/plugins/smiley/images/smiley.png'
    );

    $result = DB_query("SELECT MAX(display_order) AS max_order FROM {$_TABLES['sa_smiley']}");
    list($order) = DB_fetchArray($result);
    if ( $order < 10 ) {
        $order = 10;
    } else {
        $order = $order + 5;
    }

    $T = new Template($_CONF['path'] . 'plugins/smiley/templates/');
    $T->set_file (array (
        'add'   => 'smiley.thtml',
    ));

    $T->set_var(array(
        'mode'           => 'addsave',
        'order'          => $order,
        'order_select'   => orderList(),
    ));

    $T->parse ('output', 'add');
    $retval .= $T->finish ($T->get_var('output'));

    $retval .= COM_endBlock(COM_getBlockTemplate('_admin_block', 'footer'));

    return $retval;
}

function addSmileySave()
{
    global $_CONF, $_SA_CONF, $_TABLES, $LANG_SA00, $LANG_SA_ERRORS;

    require_once $_CONF['path_system'] . 'classes/upload.class.php';

    $retval = '';
    $errors = 0;

    // let's add some edits to ensure nothing is blank...

    if ( !isset($_FILES['graphic']['name']) || $_FILES['graphic']['name'] == '' ) {
        $retval .= 'No graphic select<br />';
        $errors++;
    }
    if ( !isset($_POST['emoticon']) || $_POST['emoticon'] == '' ) {
        $retval .= $LANG_SA_ERRORS['no_code'].'<br />';
        $errors++;
    }
    if ( !isset($_POST['description']) || $_POST['description'] == '' ) {
        $retval .= $LANG_SA_ERRORS['no_description'].'<br />';
        $errors++;
    }

    if ( $errors ) {
        return array(false,$retval);
    }

    // build a list of existing codes
    $result = DB_query("SELECT * FROM {$_TABLES['sa_smiley']}");
    while ( $S = DB_fetchArray($result) ) {
        $emoticons = unserialize($S['emoticon']);
        $x = count($emoticons);
        for ( $i = 0; $i < $x; $i++ ) {
            $smileys[] = $emoticons[$i];
        }
    }
    if (array_search($_POST['emoticon'],$smileys) ) {
        $eMsg = sprintf($LANG_SA_ERRORS['duplicate_code'],htmlspecialchars($_POST['emoticon']));
        return array(false,$eMsg);
    }
    if ( isset($_POST['emoticon1']) && $_POST['emoticon1'] != '' ) {
        if (array_search($_POST['emoticon1'],$smileys) ) {
            $eMsg = sprintf($LANG_SA_ERRORS['duplicate_code'],htmlspecialchars($_POST['emoticon1']));
            return array(false,$eMsg);
        }
    }
    if ( isset($_POST['emoticon2']) && $_POST['emoticon2'] != '' ) {
        if (array_search($_POST['emoticon2'],$smileys) ) {
            $eMsg = sprintf($LANG_SA_ERRORS['duplicate_code'],htmlspecialchars($_POST['emoticon2']));
            return array(false,$eMsg);
        }
    }
    if ( isset($_POST['emoticon3']) && $_POST['emoticon3'] != '' ) {
        if (array_search($_POST['emoticon3'],$smileys) ) {
            $eMsg = sprintf($LANG_SA_ERRORS['duplicate_code'],htmlspecialchars($_POST['emoticon3']));
            return array(false,$eMsg);
        }
    }

    $upload = new upload();
    $upload->setAutomaticResize (true);
    $upload->setDebug (false);
    $upload->setAllowedMimeTypes (array ('image/gif'   => '.gif',
                                         'image/jpeg'  => '.jpg,.jpeg',
                                         'image/pjpeg' => '.jpg,.jpeg',
                                         'image/x-png' => '.png',
                                         'image/png'   => '.png'
                                 )      );
    if (!$upload->setPath ($_CONF['path_html'] . 'smiley/smiley')) {
        $retval .= $LANG_SA_ERRORS['no_upload_path'];
        return array(false,$retval);
    }

    $filename = '';
    $newsmiley = $_FILES['graphic'];
    if (!empty ($newsmiley['name'])) {
        $filename = $newsmiley['name'];
    } else {
        $retval .= $LANG_SA_ERRORS['no_graphic'];
    }

    // check to see if one already exists by that name....


    // now do the upload
    if (!empty ($filename)) {
        $upload->setFileNames ($filename);
        $upload->setFieldName('graphic');
        $upload->setPerms ('0644');
        $upload->setMaxDimensions (100,100);

        $upload->uploadFiles ();

        if ($upload->areErrors ()) {
            $retval .= $LANG_SA_ERRORS['upload_errors'];
            $retval .= $upload->printErrors (false);
            return array(false,$retval);
        } else {
            $retval = $LANG_SA_ERRORS['successful_add'];
            $emoticon = $_POST['emoticon'];
            $description = $_POST['description'];

            $emoticon1 = '';
            $emoticon2 = '';
            $emoticon3 = '';
            if ( isset($_POST['emoticon1']) && $_POST['emoticon1'] != '' ) {
                $emoticon1 = $_POST['emoticon1'];
            }
            if ( isset($_POST['emoticon2']) && $_POST['emoticon2'] != '' ) {
                $emoticon2 = $_POST['emoticon2'];
            }
            if ( isset($_POST['emoticon3']) && $_POST['emoticon3'] != '' ) {
                $emoticon3 = $_POST['emoticon3'];
            }

            $emoticons = array();
            $emoticons[] = $emoticon;
            if ( $emoticon1 != '' ) {
                $emoticons[] = $emoticon1;
            }
            if ( $emoticon2 != '' ) {
                $emoticons[] = $emoticon2;
            }
            if ( $emoticon3 != '' ) {
                $emoticons[] = $emoticon3;
            }

            $display_order = (int) COM_applyFilter($_POST['order'],true);

            $sql = "INSERT INTO {$_TABLES['sa_smiley']} SET graphic='".DB_escapeString($filename)."', emoticon='".DB_escapeString(serialize($emoticons))."', description='".DB_escapeString($description)."', display_order=".$display_order;
            DB_query($sql);
        }
    }

    return array(true,$retval);
}

function editSmiley($id)
{
    global $_CONF, $_SA_CONF, $_TABLES, $LANG_SA00, $LANG_SA_ERRORS, $LANG_ADMIN;

    $retval = '';

    $result = DB_query("SELECT * FROM {$_TABLES['sa_smiley']} WHERE id=".(int) $id);
    if ( DB_numRows($result) > 0 ) {
        $row = DB_fetchArray($result);
    } else {
        $retval = $LANG_SA_ERRORS['id_not_found'];
        return $retval;
    }

    $menu_arr = array (
        array('url' => $_CONF['site_admin_url'] . '/plugins/smiley/index.php',
              'text' => $LANG_SA00['smiley_list']),
        array('url' => $_CONF['site_admin_url'] . '/plugins/smiley/index.php?mode=import',
              'text' => $LANG_SA00['batch_load']),
        array('url' => $_CONF['site_admin_url'],
              'text' => $LANG_ADMIN['admin_home'])
    );

    $retval .= COM_startBlock($LANG_SA00['menulabel'] . ' :: ' . $LANG_SA00['edit_smiley'], '',
                              COM_getBlockTemplate('_admin_block', 'header'));

    $retval .= ADMIN_createMenu(
        $menu_arr,
        $LANG_SA00['edit_help'],
        $_CONF['site_admin_url'] . '/plugins/smiley/images/smiley.png'
    );

    $T = new Template($_CONF['path'] . 'plugins/smiley/templates/');
    $T->set_file (array (
        'add'   => 'smiley.thtml',
    ));

    $emoticons = array();
    $emoticons = unserialize($row['emoticon']);
    if ( is_array($emoticons) ) {
        $emoticon = implode(' ', $emoticons);
    } else {
        $emoticon = '';
    }

    $T->set_var(array(
        'smiley_graphic' => '<img src="'.$_CONF['site_url'].'/smiley/smiley/'.$row['graphic'].'" />',
        'emoticon'       => htmlentities($emoticons[0],ENT_QUOTES,COM_getEncodingt()),
        'description'    => $row['description'],
        'id'             => (int) $id,
        'order'          => $row['display_order'],
        'order_select'   => orderList($id),
        'mode'           => 'editsave',
    ));

    $i = 1;
    $x = count($emoticons);
    for ($z = 1; $z < $x; $z++ ) {
        $T->set_var('emoticon'.$i , @htmlentities($emoticons[$z],ENT_QUOTES,COM_getEncodingt()));
        $i++;
    }

    $T->parse ('output', 'add');
    $retval .= $T->finish ($T->get_var('output'));

    $retval .= COM_endBlock(COM_getBlockTemplate('_admin_block', 'footer'));

    return $retval;
}

function editSmileySave()
{
    global $_CONF, $_SA_CONF, $_TABLES, $LANG_ADMIN;

    $id          = COM_applyFilter($_POST['id'],true);
    $emoticon    = $_POST['emoticon'];
    $description = $_POST['description'];
    $order       = COM_applyFilter($_POST['order'],true);

    $emoticon1 = '';
    $emoticon2 = '';
    $emoticon3 = '';
    if ( isset($_POST['emoticon1']) && $_POST['emoticon1'] != '' ) {
        $emoticon1 = $_POST['emoticon1'];
    }
    if ( isset($_POST['emoticon2']) && $_POST['emoticon2'] != '' ) {
        $emoticon2 = $_POST['emoticon2'];
    }
    if ( isset($_POST['emoticon3']) && $_POST['emoticon3'] != '' ) {
        $emoticon3 = $_POST['emoticon3'];
    }

    $emoticons = array();
    $emoticons[] = $emoticon;
    if ( $emoticon1 != '' ) {
        $emoticons[] = $emoticon1;
    }
    if ( $emoticon2 != '' ) {
        $emoticons[] = $emoticon2;
    }
    if ( $emoticon3 != '' ) {
        $emoticons[] = $emoticon3;
    }
    $sql = "UPDATE {$_TABLES['sa_smiley']} SET emoticon='".DB_escapeString(serialize($emoticons))."', description='".DB_escapeString($description)."', display_order='".intval($order)."' WHERE id=".(int) $id;

    DB_query($sql);

    reorder_smileys();

    return true;
}

// read the contents of the directory, pulling only jpg / png / gif files
// show a form  with each one, add ability to add code and emotion and import.
// do we delete when done?
function batchLoadSmiley()
{
    global $_CONF, $_SA_CONF, $_TABLES, $LANG_SA00, $LANG_SA_ERRORS,$LANG_ADMIN;

    $retval = '';
    $rowcounter = 0;
    $pCount = 0;

    $menu_arr = array (
        array('url' => $_CONF['site_admin_url'] . '/plugins/smiley/index.php',
              'text' => $LANG_SA00['smiley_list']),
        array('url' => $_CONF['site_admin_url'],
              'text' => $LANG_ADMIN['admin_home'])
    );

    $retval .= COM_startBlock($LANG_SA00['menulabel'] . ' :: ' . $LANG_SA00['batch_load'], '',
                              COM_getBlockTemplate('_admin_block', 'header'));

    $retval .= ADMIN_createMenu(
        $menu_arr,
        $LANG_SA00['batch_help'],
        $_CONF['site_admin_url'] . '/plugins/smiley/images/smiley.png'
    );


    // check to see if we can write
    $rc = COM_isWritable($_CONF['path_html'].'smiley/smiley/');
    if ( $rc != true ) {
        $retval = SA_msgBox($_CONF['path_html'].$LANG_SA_ERRORS['not_writable']);
        $retval .= listSmiley();
        return $retval;
    }

    $directory = $_CONF['path'].'plugins/smiley/batchload/';

    if (!@is_dir($directory)) {
        $retval = SA_msgBox( $LANG_SA_ERRORS['import_dir_err']);
        $retval .= listSmiley();
    }
    if (!$dh = @opendir($directory)) {
        $retval = SA_msgBox( $LANG_SA_ERRORS['import_dir_err']);
        $retval .= listSmiley();
    }

    $T = new Template($_CONF['path'] . 'plugins/smiley/templates/');
    $T->set_file (array (
        'import'   => 'smiley_import.thtml',
    ));

    $T->set_var(array(
        'form_action_url' => $_CONF['site_admin_url'].'/plugins/smiley/index.php',
    ));

    $T->set_block('import', 'importrow', 'irow');

    $directory = trim($directory);
    if ( $directory[strlen($directory)-1] != '/' ) {
        $directory =  $directory . '/';
    }
    while ( ( $file = readdir($dh) ) != false ) {
        if ( $file == '..' || $file == '.' ) {
            continue;
        }
        $filename = $file;
        $filetmp = $directory . $file;

        $filename = basename($file);
        $file_extension = strtolower(substr(strrchr($filename,"."),1));

        if ( is_dir($filetmp)) {
            continue;
        }
        if ( $file_extension != 'png' && $file_extension != 'jpg' && $file_extension != 'gif' ) {
            continue;
        }

        $pCount++;

        $T->set_var(array(
            'class'         => ($rowcounter % 2) ? '2' : '1',
            'graphic'       => $filename,
            'index'         => str_replace('.','_',$filename),
            'emoticon_preview' => '',
        ));
        $T->parse('irow','importrow',true);
        $rowcounter++;
    }
    if ( $pCount == 0 ) {
        $T->set_var('no_smileys_found',$LANG_SA_ERRORS['no_smileys_found']);
    }
    closedir($dh);

    $T->parse ('output', 'import');
    $retval .= $T->finish ($T->get_var('output'));

    $retval .= COM_endBlock(COM_getBlockTemplate('_admin_block', 'footer'));

    return $retval;
}

function saveBatchLoadSmiley()
{
    global $_CONF, $_SA_CONF, $_TABLES, $LANG_SA00, $LANG_SA_ERRORS;

    $result = DB_query("SELECT MAX(display_order) AS max_order FROM {$_TABLES['sa_smiley']}");
    list($order) = DB_fetchArray($result);
    if ( $order < 10 ) {
        $order = 10;
    } else {
        $order = $order + 5;
    }

    $errors = '';
    $errorCount = 0;

    if ( isset($_POST['import']) && is_array($_POST['import']) ) {
        foreach ($_POST['import'] as $graphic) {
            $graphic = COM_applyFilter($graphic);
            $index   = str_replace('.','_',$graphic);
            $code    = $_POST['code_' . $index];
            $emotion = $_POST['emotion_' . $index];

            if ( $code == '' ) {
                $errors .= $LANG_SA_ERRORS['no_graphic'] . ' ('.$graphic.')<br />';
                $errorCount++;
                continue;
            }

            if ( @file_exists($_CONF['path'].'plugins/smiley/batchload/'.$graphic) ) {
                // check to see if it already exists in target?
                if ( @file_exists($_CONF['path_html'].'smiley/smiley/'.$graphic) ) {
                    COM_errorLog("SMILEY IMPORT: " . $graphic . " already exists.");
                    $errors .= $graphic . $LANG_SA_ERRORS['already_exists'] . '<br />';
                    $errorCount++;
                    continue;
                }
                $rc = @copy($_CONF['path'].'plugins/smiley/batchload/'.$graphic,$_CONF['path_html'].'smiley/smiley/'.$graphic);
                if ( $rc == true ) {
                    @chmod($graphic,$_CONF['path_html'].'smiley/smiley/'.$graphic,0666);
                    $emoticons = array();
                    $emoticons[0] = $code;
                    $emoticons[1] = '';
                    $emoticons[2] = '';
                    $emoticons[3] = '';
                    $sql = "INSERT INTO {$_TABLES['sa_smiley']} SET graphic='".DB_escapeString($graphic)."', emoticon='".DB_escapeString(serialize($emoticons))."', description='".DB_escapeString($emotion)."', display_order=".$order;
                    DB_query($sql);
                    @unlink($_CONF['path'].'plugins/smiley/batchload/'.$graphic);
                    $order += 5;
                } else {
                    $errors .= $LANG_SA_ERRORS['copy_error'] . '(' . $graphic . ')<br />';
                    $errorCount++;
                }
            }
        }
    }
    if ( $errorCount > 0 ) {
        return array(false, $errors);
    } else {
        return array(true,'');
    }
}


function SA_msgBox($message)
{
    $retval = '';

    $retval.= COM_showMessageText($message, '', false, 'info' );
    return $retval;
}

function reorder_smileys()
{
    global $_TABLES;

    $sql = "SELECT * FROM {$_TABLES['sa_smiley']} ORDER BY display_order ASC";
    $result = DB_query($sql);
    $nrows = DB_numRows($result);

    $dispOrd = 10;
    $stepNumber = 5;

    for ($i = 0; $i < $nrows; $i++) {
        $A = DB_fetchArray($result);
        $q = "UPDATE " . $_TABLES['sa_smiley'] . " SET display_order = '" .
              $dispOrd . "' WHERE id = '" . $A['id'] ."'";
        DB_query($q);
        $dispOrd += $stepNumber;
    }
}

function orderList( $id = '' )
{
    global $_CONF, $_SA_CONF, $_TABLES, $LANG_SA00;

    $retval = '';

    $sql = "SELECT id, display_order, emoticon, description FROM {$_TABLES['sa_smiley']} ORDER BY display_order ASC";

    $retval = '<select name="order">';
    $retval .= '<option value="0">'.$LANG_SA00['first'].'</option>';

    $result = DB_query($sql);
    $S = array();
    while ( $Z = DB_fetchArray($result) ) {
        if ( count($S) < 1 ) {
            $S = $Z;
            continue;
        }
        if ( $Z['id'] == $id ) {
            $selected = ' selected="selected" ';
        } else {
            $selected = '';
        }
        if ( $S['id'] == $id ) {
            $S = $Z;
            continue;
        }
        $emoticons = unserialize($S['emoticon']);
        $retval .= '<option value="'.($S['display_order']+1).'"'.$selected.'>'.$LANG_SA00['after'].' -> '.$S['description'].'  '.$emoticons[0].'</option>' . LB;
        $S = $Z;
    }
    $emoticons = unserialize($S['emoticon']);
    $retval .= '<option value="'.($S['display_order']+1).'">'.$LANG_SA00['after'].' -> '.$S['description'].'  '.$emoticons[0].'</option>' . LB;

    $retval .= '</select>';

    return $retval;
}


/**
* Moderates a list of items as defined by the 'chkall' action
*
* This will actually perform moderation (approve or delete) one or more items
*
* @param    string  $action     Action to perform ('delete' or 'approve')
* @return   string              HTML for "command and control" page
*
*/
function SMILEY_selectedItems($action = '')
{
    global $_CONF, $_TABLES, $LANG_SA_ERRORS;

    $retval = '';

    $item = (isset($_POST['selitem'])) ? $_POST['selitem'] : array();

    if (isset($item) AND is_array($item)) {
        foreach($item as $selitem) {
            $id = COM_applyFilter($selitem);
            if (empty($id)) {
                return $retval; // null id - make an early exit!
            }
            if ( $action == 'delete' ) {
                $graphic = DB_getItem($_TABLES['sa_smiley'],'graphic','id='.(int) $id);
                if ( $graphic != '' ) {
                    @unlink($_CONF['path_html'].'smiley/smiley/'.$graphic);
                }
                DB_delete($_TABLES['sa_smiley'],'id',(int)$id);
            }
        }
    }

    $retval = SA_msgBox($LANG_SA_ERRORS['successful_delete']);

    return $retval;
}

$display = COM_siteHeader();

$mode = '';
if ( isset($_GET['mode']) ) {
    $mode = COM_applyFilter($_GET['mode']);
} elseif (isset($_POST['mode']) ) {
    $mode = COM_applyFilter($_POST['mode']);
}

if ( isset($_POST['delbutton_x'] ) ) {
    $mode = 'delbutton_x';
}

if ( isset($_POST['cancel']) ) {
    $mode = '';
}

switch ( $mode ) {
    case 'delbutton_x' :
        $display .= SMILEY_selectedItems('delete');
        $display .= listSmiley();
        break;
    case 'import' :
        $display .= batchLoadSmiley();
        break;
    case 'importsave' :
        list($rc, $errors) = saveBatchLoadSmiley();
        if ( $rc == false ) {
            $display .= SA_msgBox($errors);
            $display .= batchLoadSmiley();
        } else {
            $display .= listSmiley();
        }
        break;
    case 'move' :
        if ( isset($_GET['id']) ) {
            $id = COM_applyFilter($_GET['id'],true);
            if ( isset($_GET['direction']) ) {
                $direction = COM_applyFilter($_GET['direction']);
                switch ( $direction ) {
                    case 'up' :
                        DB_query("UPDATE {$_TABLES['sa_smiley']} SET display_order=display_order-6 WHERE id=".intval($id));
                        reorder_smileys();
                        break;
                    case 'down' :
                        DB_query("UPDATE {$_TABLES['sa_smiley']} SET display_order=display_order+6 WHERE id=".intval($id));
                        reorder_smileys();
                        break;
                }
            }
        }
        $display .= listSmiley();
        break;
    case 'delete' :
        if ( isset($_GET['id']) ) {
            $id = COM_applyFilter($_GET['id'],true);
            $graphic = DB_getItem($_TABLES['sa_smiley'],'graphic','id='.intval($id));
            if ( $graphic != '' ) {
                @unlink($_CONF['path_html'].'smiley/smiley/'.$graphic);
            }
            DB_delete($_TABLES['sa_smiley'],'id',intval($id));
        }
        $display .= SA_msgBox($LANG_SA_ERRORS['successful_delete']);
        $display .= listSmiley();
        break;
    case 'add' :
        $display .= addSmiley();
        break;
    case 'addsave' :
        list($rc,$message) = addSmileySave();
        $display .= SA_msgBox($message);
        if ( $rc == true ) {
            $display .= listSmiley();
        } else {
            $display .= addSmiley();
        }
        break;
    case 'editsave' :
        if ( editSmileySave() == true ) {
            $display .= SA_msgBox($LANG_SA_ERRORS['successful_add']);
            $display .= listSmiley();
        } else {
            $display .= 'error on edit';
        }
        break;
    case 'edit' :
        if ( isset($_GET['id']) ) {
            $id = COM_applyFilter($_GET['id'],true);
            $display .= editSmiley($id);
            break;
        }
    default :
        $display .= listSmiley();
        break;
}

$display .= COM_siteFooter();
echo $display;
?>