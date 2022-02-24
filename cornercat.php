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

		// Enable the main events we are interested in
		$this->enable([
			'onAssetsInitialized' => ['addPluginAssets', 0],
			'onOutputGenerated' => ['addCorner', 0],
		]);
	}

	public function addPluginAssets() {
		// stub
	}

	public function addCorner() {
		// stub
	}

}
