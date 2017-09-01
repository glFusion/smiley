<?php
// +--------------------------------------------------------------------------+
// | Smiley Plugin for glFusion CMS                                           |
// +--------------------------------------------------------------------------+
// | preview.php                                                              |
// |                                                                          |
// | Shows preview of emoticons for batch import                              |
// +--------------------------------------------------------------------------+
// | Copyright (C) 2009-2017 by the following authors:                        |
// |                                                                          |
// | Mark R. Evans          mark AT glfusion DOT org                          |
// |                                                                          |
// | Based on the Geeklog CMS getimage.php                                    |
// | Copyright (C) 2004-2009 by the following authors:                        |
// |                                                                          |
// | Authors: Tony Bibbs        - tony AT tonybibbs DOT com                   |
// |          Dirk Haun         - dirk AT haun-online DOT de                  |
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

/**
* For really strict webhosts, this file an be used to show images in pages that
* serve the images from outside of the webtree to a place that the webserver
* user can actually write too
*
* @author   Tony Bibbs, tony AT tonybibbs DOT com
*
*/

require_once '../lib-common.php';

$downloader = new downloader();

$downloader->setLogFile($_CONF['path_log'] . 'error.log');

$downloader->setLogging(true);

$downloader->setAllowedExtensions(array('gif' => 'image/gif',
                                        'jpg' => 'image/jpeg',
                                        'jpeg' => 'image/jpeg',
                                        'png'  => 'image/png',
                                        'png'  => 'image/x-png'
                                       )
                                 );
$image = '';
if (isset($_GET['f'])) {
    $image = COM_applyFilter ($_GET['f']);
}
if (strstr($image, '..')) {
    COM_accessLog('Someone tried to illegally access files using preview.php');
    exit;
}

$downloader->setPath($_CONF['path'].'plugins/smiley/batchload/');

// Let's see if we don't have a legit file.  If not bail
$pathToImage = $downloader->getPath() . $image;
if (is_file($pathToImage)) {
    // support conditional GET, if possible
    $st = @stat($pathToImage);
    if (is_array($st)) {
        // cf. RFC 2616, Section 3.3.1 Full Date
        $last_mod = str_replace('+0000', 'GMT', gmdate('r', $st['mtime']));
        $etag     = '"' . md5($image) . '"';

        $mod_since  = '';
        $none_match = '';
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
            $mod_since = $_SERVER['HTTP_IF_MODIFIED_SINCE'];
        }
        if (isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
            $none_match = $_SERVER['HTTP_IF_NONE_MATCH'];
        }

        if (($last_mod == $mod_since) && ($etag == $none_match)) {
            // image hasn't change - we're done
            header('HTTP/1.1 304 Not Modified');
            header('Status: 304 Not Modified');
            exit;
        }
        header('Last-Modified: ' . $last_mod);
        header('ETag: ' . $etag);
    }
    $downloader->downloadFile($image);
} else {
    $display = COM_errorLog('File, ' . $image . ', was not found in preview.php');
    // send 404 in any case
    header('HTTP/1.1 404 Not Found');
    header('Status: 404 Not Found');
}
?>