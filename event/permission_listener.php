<?php
/**
 *
 *
 */

namespace phpbbde\pastebin\event;

/**
 * @ignore
 */

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */

class permission_listener implements EventSubscriberInterface
{
	public function __construct(protected \phpbb\auth\auth $auth)
	{
	}

	public static function getSubscribedEvents()
	{
		return array(
			'core.permissions' => 'permissions',
		);
	}

	/**
	 * Add permissions
	 *
	 * @param	object	$event	The event object
	 * @return	null
	 * @access	public
	 */
	public function permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions['a_pastebin'] = array('lang' => 'ACL_A_PASTEBIN', 'cat' => 'misc');
		$event['permissions'] = $permissions;
	}
}
