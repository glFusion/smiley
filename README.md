# Smiley Plugin for glFusion

For the latest documentation, please see

 [Smiley Wiki](https://www.glfusion.org/wiki/glfusion:plugins:smiley:start)

## Overview

The Smiley plugin allows you to easily manage emoticons that can be used by other plugins in the glFusion family.

## Usage

The Smiley plugin doesn't do much on its own, other than let you easily add, modify, and delete smileys.  Other plugins must support using the Smiley plugin in order to use the smileys.  At this time, the Forum plugin will use
the smileys managed by this plugin.

## Forum Integration

To enable the Forum plugin to use the Smiley plugin, go into Command & Control, Configuration, Forum, then set **Smilies Plugin Installed** to True.

The upcoming release of the PM (Private Message) plugin will also use the Smiley plugin to enable adding smileys to your messages.

## Adding Smileys

There are two methods to add new smileys to the library:

1. By choosing the 'Add Smiley' option in the List Smiley Admin screen. This allows you to upload a new smiley and set the code and emotion.

2. Batch Import - By choosing 'Import Smileys' from the List Smiley Admin screen, you can import several smileys at one time.  You must first upload the smiley icons
to the private/plugins/smiley/batchload/ directory.

You will then select the smileys to import and specify their code and emotion. The icons will be copied to the public_html/smiley folder and added to the smiley library.

## Deleting Smileys

You can delete a smiley from the List Smiley Admin screen. Simply select the
X icon.

## Configuration

There are no configuration options for this plugin.

## Installation

The Smiley Plugin uses the glFusion automated plugin installer. Simply upload the distribution using the glFusion plugin installer located in the Plugin Administration page.

## Upgrading

The upgrade process is identical to the installation process, simply upload the distribution from the Plugin Administration page.

## License

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
