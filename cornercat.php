<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class CornercatPlugin
 * @package Grav\Plugin
 */
class CornercatPlugin extends Plugin
{

	private $options, $snippet;

	public static function getSubscribedEvents()
	{
		return [
			'onPluginsInitialized' => ['onPluginsInitialized', 0],
		];
	}

	public function onPluginsInitialized(): void
	{
		// Don't proceed if we are in the admin plugin
		if ($this->isAdmin()) {
			return;
		}

		$this->options = $this->config();
		$this->populateSnippet();

		// Enable the main events we are interested in
		$this->enable([
			'onAssetsInitialized' => ['addPluginAssets', 0],
			'onOutputGenerated' => ['addCorner', 0],
		]);
	}

	public function addPluginAssets() {
		if($this->options['animated']) {
			$this->grav['assets']->addCss('plugins://cornercat/css/animate.css');
		}
		$this->grav['assets']->addCss('theme://css/cornercat-custom.css');
	}

	public function addCorner() {
		$output = $this->grav->output;
		$output = preg_replace('/(\<\/body)\s*(\>)/i', $this->snippet . '${0}', $output, 1); // it's absolutely positioned, so we can add this before the closing body tag
		$this->grav->output = $output;
	}

	private function populateSnippet(): void {
		// TODO: source these by processing Twig templates

		if(trim($this->options['position']) == 'left') {
			$svg = <<<EOS
			<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 250 250" style="fill:{$this->options['fill']}; color:{$this->options['color']}; position: absolute; top: 0; left: 0" aria-hidden="true">
				<path d="M250 0L135 115h-15l-12 27L0 250V0z" />
				<path d="M122 109c15-9 9-19 9-19-3-7-2-11-2-11 1-7-3-2-3-2-4 5-2 11-2 11 3 10-5 15-9 16" fill="currentColor" style="-webkit-transform-origin: 120px 144px; transform-origin: 120px 144px" class="octo-arm" />
				<path d="M135 115s-4 2-5 0l-14-14c-3-2-6-3-8-3 8-11 15-24-2-41-5-5-10-7-16-7-1-2-3-7-12-11 0 0-5 3-7 16-4 2-8 5-12 9s-7 8-9 12c-14 4-17 9-17 9 4 8 9 11 11 11 0 6 2 11 7 16 16 16 30 10 41 2 0 3 1 7 5 11l12 11c1 2-1 6-1 6z" fill="currentColor" class="octo-body" />
			</svg>
EOS;
		}
		else {
			$svg = <<<EOS
			<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 250 250" style="fill:{$this->options['fill']}; color:{$this->options['color']}; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true">
				<path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z" />
				<path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="-webkit-transform-origin: 130px 106px; transform-origin: 130px 106px;" class="octo-arm" />
				<path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body" />
			</svg>
EOS;
		}

		$this->snippet = "<a href=\"https://github.com/{$this->options['repository']}\" id=\"github-corner\" aria-label=\"View source on GitHub\">$svg</a>";
	}

}
