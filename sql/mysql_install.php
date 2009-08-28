<?php
// +--------------------------------------------------------------------------+
// | Smiley Plugin                                                            |
// +--------------------------------------------------------------------------+
// | mysql_install.php                                                        |
// |                                                                          |
// | Contains all the SQL necessary to install the Smiley plugin              |
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

$_SQL['sa_smiley']  = "CREATE TABLE {$_TABLES['sa_smiley']} (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  emoticon    varchar(250) NOT NULL,
  graphic     varchar(250) NOT NULL,
  description varchar(250) NOT NULL,
  display_order int(8) NOT NULL default '0',
  PRIMARY KEY (id)
) TYPE=MyISAM;";

$_SQLDEFAULTS[0]  = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(1, 'a:1:{i:0;s:7:\":arrow:\";}', 'arrow.gif', 'Arrow', 185);";
$_SQLDEFAULTS[1]  = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(2, 'a:2:{i:0;s:2:\"B)\";i:1;s:2:\"8)\";}', 'cool.gif', 'Cool', 40);";
$_SQLDEFAULTS[2]  = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(3, 'a:1:{i:0;s:5:\":cry:\";}', 'cry.gif', 'Cry', 70);";
$_SQLDEFAULTS[3]  = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(4, 'a:1:{i:0;s:2:\":D\";}', 'biggrin.gif', 'Big Grin', 10);";
$_SQLDEFAULTS[4]  = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(5, 'a:1:{i:0;s:2:\":?\";}', 'confused.gif', 'Confused', 30);";
$_SQLDEFAULTS[5]  = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(6, 'a:1:{i:0;s:2:\":?\";}', 'geek.gif', 'Geek', 100);";
$_SQLDEFAULTS[6]  = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(7, 'a:1:{i:0;s:2:\":(\";}', 'sad.gif', 'Sad', 20);";
$_SQLDEFAULTS[7]  = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(8, 'a:1:{i:0;s:2:\":)\";}', 'smile.gif', 'Smile', 15);";
$_SQLDEFAULTS[8]  = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(9, 'a:1:{i:0;s:2:\":o\";}', 'surprised.gif', 'Surprised', 65);";
$_SQLDEFAULTS[9]  = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(10, 'a:1:{i:0;s:7:\":ugeek:\";}', 'ugeek.gif', 'Uber Geek', 95);";
$_SQLDEFAULTS[10] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(11, 'a:1:{i:0;s:2:\";)\";}', 'wink.gif', 'Wink', 90);";
$_SQLDEFAULTS[11] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(12, 'a:2:{i:0;s:2:\"8O\";i:1;s:7:\":shock:\";}', 'eek.gif', 'Eek!', 25);";
$_SQLDEFAULTS[12] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(13, 'a:1:{i:0;s:6:\":evil:\";}', 'evil.gif', 'Evil', 75);";
$_SQLDEFAULTS[13] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(14, 'a:1:{i:0;s:3:\":!:\";}', 'exclaim.gif', 'Exclaimation', 195);";
$_SQLDEFAULTS[14] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(15, 'a:1:{i:0;s:6:\":idea:\";}', 'idea.gif', 'Idea', 200);";
$_SQLDEFAULTS[15] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(16, 'a:1:{i:0;s:5:\":lol:\";}', 'lol.gif', 'Laughing Out Loud', 45);";
$_SQLDEFAULTS[16] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(17, 'a:1:{i:0;s:2:\":x\";}', 'mad.gif', 'Mad', 50);";
$_SQLDEFAULTS[17] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(18, 'a:1:{i:0;s:9:\":mrgreen:\";}', 'mrgreen.gif', 'Mr. Green', 105);";
$_SQLDEFAULTS[18] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(19, 'a:1:{i:0;s:2:\":|\";}', 'neutral.gif', 'Neutral', 35);";
$_SQLDEFAULTS[19] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(20, 'a:2:{i:0;s:10:\":question:\";i:1;s:3:\":?:\";}', 'question.gif', 'Question', 190);";
$_SQLDEFAULTS[20] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(21, 'a:1:{i:0;s:2:\":P\";}', 'razz.gif', 'Razz', 55);";
$_SQLDEFAULTS[21] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(22, 'a:1:{i:0;s:6:\":oops:\";}', 'redface.gif', 'Embarrased', 60);";
$_SQLDEFAULTS[22] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(23, 'a:1:{i:0;s:6:\":roll:\";}', 'rolleyes.gif', 'Roll Eyes', 85);";
$_SQLDEFAULTS[23] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(24, 'a:1:{i:0;s:9:\":twisted:\";}', 'twisted.gif', 'Twisted', 80);";
$_SQLDEFAULTS[24] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(25, 'a:1:{i:0;s:7:\":angel:\";}', 'angel.gif', 'Angel', 110);";
$_SQLDEFAULTS[25] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(26, 'a:1:{i:0;s:6:\":clap:\";}', 'clap.gif', 'Clapping', 115);";
$_SQLDEFAULTS[26] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(27, 'a:1:{i:0;s:7:\":crazy:\";}', 'crazy.gif', 'Crazy', 120);";
$_SQLDEFAULTS[27] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(28, 'a:1:{i:0;s:4:\":eh:\";}', 'eh.gif', 'Eh', 125);";
$_SQLDEFAULTS[28] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(29, 'a:1:{i:0;s:7:\":lolno:\";}', 'lolno.gif', 'Lol, No', 130);";
$_SQLDEFAULTS[29] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(30, 'a:1:{i:0;s:9:\":problem:\";}', 'problem.gif', 'Problem', 135);";
$_SQLDEFAULTS[30] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(31, 'a:1:{i:0;s:5:\":shh:\";}', 'shh.gif', 'Shh', 140);";
$_SQLDEFAULTS[31] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(32, 'a:1:{i:0;s:8:\":shifty:\";}', 'shifty.gif', 'Shifty', 145);";
$_SQLDEFAULTS[32] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(33, 'a:1:{i:0;s:8:\":silent:\";}', 'silent.gif', 'Silent', 150);";
$_SQLDEFAULTS[33] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(34, 'a:1:{i:0;s:7:\":think:\";}', 'think.gif', 'Thinking', 155);";
$_SQLDEFAULTS[34] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(35, 'a:1:{i:0;s:11:\":thumbdown:\";}', 'thumbdown.gif', 'Thumbdown', 160);";
$_SQLDEFAULTS[35] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(36, 'a:1:{i:0;s:9:\":thumbup:\";}', 'thumbup.gif', 'Thumbup', 165);";
$_SQLDEFAULTS[36] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(37, 'a:1:{i:0;s:6:\":wave:\";}', 'wave.gif', 'Wave', 170);";
$_SQLDEFAULTS[37] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(38, 'a:1:{i:0;s:5:\":wtf:\";}', 'wtf.gif', 'WTF', 175);";
$_SQLDEFAULTS[38] = "INSERT INTO {$_TABLES['sa_smiley']} VALUES(39, 'a:1:{i:0;s:6:\":yawn:\";}', 'yawn.gif', 'Yawn', 180);";

?>