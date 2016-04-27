<?php
/**
 * @package   DebugHelper
 * @copyright Copyright (c)2016 Akeeba Ltd / Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 3, or later
 */

defined('_JEXEC') or die;

class plgakeebadebugsysteminfoInstallerScript
{
	public function postflight($route, JAdapterInstance $adapter)
	{
		// Manually enable us after installation
		$db = JFactory::getDbo();

		$query = $db->getQuery(true)
					->update($db->qn('#__extensions'))
					->where($db->qn('element').' = '.$db->q('systeminfo'))
					->where($db->qn('folder').' = '.$db->q('akeebadebug'))
					->set($db->qn('enabled').' = '.$db->q(1));

		try
		{
			$db->setQuery($query)->execute();
		}
		catch (Exception $e)
		{
			// Do not break if anything bad happens
		}
	}
}