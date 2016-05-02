<?php
/**
 * @package   DebugHelper
 * @copyright Copyright (c)2016 Akeeba Ltd / Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 3, or later
 */

defined('_JEXEC') or die;

class plgAkeebadebugSysteminfo extends JPlugin
{
	/**
	 * Gather system information useful for support. If a component is passed we are going to add some relevant info for
	 * that extension, too.
	 *
	 * @param $component
	 *
	 * @return array
	 */
	public function onGetSystemInformation($component = '')
	{
		$result = $this->genericInfo();

		switch ($component)
		{
			case 'com_akeeba':
				$result = array_merge($result, $this->akeebaBackupInfo());

				break;
			case 'com_admintools':
				$result = array_merge($result, $this->adminToolsInfo());

				break;
			case 'com_ats':
				$result = array_merge($result, $this->atsInfo());

				break;
		}

		return $result;
	}

	/**
	 * Generic info about the system. For example database version, PHP version etc etc
	 *
	 * @return array
	 */
	private function genericInfo()
	{
		$info['jversion'] = JVERSION;
		$info['php'] 	  = PHP_VERSION;
		$info['db']	 	  = JFactory::getDbo()->getVersion();

		return $info;
	}

	/**
	 * System info useful for Akeeba Backup support.
	 *
	 * @return array
	 */
	private function akeebaBackupInfo()
	{
		$info['ab_version'] = defined('AKEEBA_VERSION') ? AKEEBA_VERSION : '';

		return $info;
	}

	/**
	 * System info useful for Admin Tools support.
	 *
	 * @return array
	 */
	private function adminToolsInfo()
	{
		$info['at_version'] = defined('ADMINTOOLS_VERSION') ? ADMINTOOLS_VERSION : '';

		return $info;
	}

	/**
	 * System info useful for Akeeba Ticket System support.
	 *
	 * @return array
	 */
	private function atsInfo()
	{
		$info['ats_version'] = defined('ATS_VERSION') ? ATS_VERSION : '';

		return $info;
	}
}