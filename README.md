# Cornercat Plugin

The **Cornercat** Plugin is for [Grav CMS](http://github.com/getgrav/grav).

It places a Github Octocat hyperlinked to a relevant repo on the corner of your webpages. It would be useful if you are demoing a theme or plugin, or have pages about other software you have written that is available on Github.

The graphic and corner code have been taken from [Tim Holman](https://github.com/tholman)'s [github-corners](https://github.com/tholman/github-corners) under its [MIT License](https://github.com/tholman/github-corners/blob/master/license.md). 🙏, I like the cut of your gib.

## Installation

Installing the Cornercat plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

<!--
### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install cornercat

This will install the Cornercat plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/cornercat`.
-->
### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `cornercat`. You can find these files on [GitHub](https://github.com/hughbris/grav-plugin-cornercat) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/cornercat
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

<!--
### Admin Plugin

If you use the admin plugin, you can install directly through the admin plugin by browsing the `Plugins` tab and clicking on the `Add` button.
-->
## Configuration

Before configuring this plugin, you should copy the `user/plugins/cornercat/cornercat.yaml` to `user/config/plugins/cornercat.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
default: true # whether the Octocat is included or excluded by default (more details below)
color: '#fff' # foreground colour or SVG 'color'
fill: '#151513' # background colour or SVG 'fill'
animated: true # whether the cat waves on hover
position: right # which top corner your cat prefers
repository: hughbris/grav-plugin-cornercat # link destination Github repo (only the owner/repo): change this or I get the kudos
# styles: # optional custom CSS property/value declarations for SVG element - e.g. z-index: 10 (more details below)
```

You can also set these options (except `enabled` and `default`) under `cornercat` on any page's frontmatter to override these settings for that page only. For example:

```yaml
title: My special page
cornercat:  # child settings here imply that the cat is shown on this page (more detail below under "Usage")
  repository: tholman/github-corners
  fill: '#f0f'
```

Note that if you use the admin plugin, a file with your configuration, and named cornercat.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.

## Usage

The cornercat is enabled by **default** on every page on install. If you want to control which pages show the cat, first decide whether you want Octocat shown by default, and change `default` to `true` or `false` in your theme config. Then for each page that is different, add headers to their frontmatter with `cornercat: true # or false`. For example:

```yaml
title: "Let's be serious, guys"
cornercat: false
```

> Regardless of your default setting, if you set any custom options for the plugin on any page frontmatter, cornercat will be enabled on that page (that is, `cornercat: true` is implied).

If you need to add custom styles for your cornercat, create a file in your theme's `css` folder called `cornercat-custom.css` (so `user/<theme>/css/cornercat-custom.css`) and it will be picked up. Alternatively, you can add inline **styles** for the SVG element using CSS property/value settings as YAML in the config under `styles` (see above).

You may need to add styles to increase your z-index value, depending on your theme.

## Credits

Thanks to [@tholman](https://github.com/tholman) for the front end code.

## To Do

Support parameters sketched out in the [default config file](cornercat.yaml):
- [x] default (#2)
- [x] color
- [x] fill
- [x] animated
- [x] position
- [x] repository
- [ ] target (#3)
