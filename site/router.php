<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.2.9
	@build			30th November, 2015
	@created		22nd October, 2015
	@package		Sermon Distributor
	@subpackage		router.php
	@author			Llewellyn van der Merwe <https://www.vdm.io/>	
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
  ____  _____  _____  __  __  __      __       ___  _____  __  __  ____  _____  _  _  ____  _  _  ____ 
 (_  _)(  _  )(  _  )(  \/  )(  )    /__\     / __)(  _  )(  \/  )(  _ \(  _  )( \( )( ___)( \( )(_  _)
.-_)(   )(_)(  )(_)(  )    (  )(__  /(__)\   ( (__  )(_)(  )    (  )___/ )(_)(  )  (  )__)  )  (   )(  
\____) (_____)(_____)(_/\/\_)(____)(__)(__)   \___)(_____)(_/\/\_)(__)  (_____)(_)\_)(____)(_)\_) (__) 

/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Routing class from com_sermondistributor
 *
 * @since  3.3
 */
class SermondistributorRouter extends JComponentRouterBase
{	
	/**
	 * Build the route for the com_sermondistributor component
	 *
	 * @param   array  &$query  An array of URL arguments
	 *
	 * @return  array  The URL arguments to use to assemble the subsequent URL.
	 *
	 * @since   3.3
	 */
	public function build(&$query)
	{
		$segments = array();

		// Get a menu item based on Itemid or currently active
		$params = JComponentHelper::getParams('com_sermondistributor');
		
		if (empty($query['Itemid']))
		{
			$menuItem = $this->menu->getActive();
		}
		else
		{
			$menuItem = $this->menu->getItem($query['Itemid']);
		}

		$mView = (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
		$mId = (empty($menuItem->query['id'])) ? null : $menuItem->query['id'];

		if (isset($query['view']))
		{
			$view = $query['view'];

			if (empty($query['Itemid']))
			{
				$segments[] = $query['view'];
			}

			unset($query['view']);
		}
		
		// Are we dealing with a item that is attached to a menu item?
		if (isset($view) && ($mView == $view) and (isset($query['id'])) and ($mId == (int) $query['id']))
		{
			unset($query['view']);
			unset($query['catid']);
			unset($query['id']);
			return $segments;
		}

		if (isset($view) && isset($query['id']) && ($view == 'preachers' || $view == 'preacher' || $view == 'categories' || $view == 'category' || $view == 'serieslist' || $view == 'series' || $view == 'sermon'))
		{
			if ($mId != (int) $query['id'] || $mView != $view)
			{
				if ($view == 'preachers' || $view == 'preacher' || $view == 'categories' || $view == 'category' || $view == 'serieslist' || $view == 'series' || $view == 'sermon')
				{
					$segments[] = $view;
					$id = explode(':', $query['id']);
					if (count($id) == 2)
					{
						$segments[] = $id[1];
					}
					else
					{
						$segments[] = $id[0];
					}
				}
			}
			unset($query['id']);
		}
		
		$total = count($segments);

		for ($i = 0; $i < $total; $i++)
		{
			$segments[$i] = str_replace(':', '-', $segments[$i]);
		}

		return $segments; 
		
	}

	/**
	 * Parse the segments of a URL.
	 *
	 * @param   array  &$segments  The segments of the URL to parse.
	 *
	 * @return  array  The URL attributes to be used by the application.
	 *
	 * @since   3.3
	 */
	public function parse(&$segments)
	{
		//var_dump($segments);
		//$app = JFactory::getApplication();
		//$menu = $app->getMenu();
		//$item = $menu->getActive();
		
		$count = count($segments);
		$vars = array();
				
		//var_dump($item->query['view']);
		//Handle View and Identifier
		switch($segments[0])
		{
			case 'preachers':
				$vars['view'] = 'preachers';
				if (is_numeric($segments[$count-1]))
				{
					$vars['id'] = (int) $segments[$count-1];
				}
				else
				{
					$id = $this->getVar('preachers', $segments[$count-1], 'alias', 'id');
					if($id)
					{
						$vars['id'] = $id;
					}
				}
				break;
			case 'preacher':
				$vars['view'] = 'preacher';
				if (is_numeric($segments[$count-1]))
				{
					$vars['id'] = (int) $segments[$count-1];
				}
				else
				{
					$id = $this->getVar('preacher', $segments[$count-1], 'alias', 'id');
					if($id)
					{
						$vars['id'] = $id;
					}
				}
				break;
			case 'categories':
				$vars['view'] = 'categories';
				if (is_numeric($segments[$count-1]))
				{
					$vars['id'] = (int) $segments[$count-1];
				}
				else
				{
					$id = $this->getVar('categories', $segments[$count-1], 'alias', 'id');
					if($id)
					{
						$vars['id'] = $id;
					}
				}
				break;
			case 'category':
				$vars['view'] = 'category';
				if (is_numeric($segments[$count-1]))
				{
					$vars['id'] = (int) $segments[$count-1];
				}
				else
				{
					$id = $this->getVar('category', $segments[$count-1], 'alias', 'id');
					if($id)
					{
						$vars['id'] = $id;
					}
				}
				break;
			case 'serieslist':
				$vars['view'] = 'serieslist';
				if (is_numeric($segments[$count-1]))
				{
					$vars['id'] = (int) $segments[$count-1];
				}
				else
				{
					$id = $this->getVar('serieslist', $segments[$count-1], 'alias', 'id');
					if($id)
					{
						$vars['id'] = $id;
					}
				}
				break;
			case 'series':
				$vars['view'] = 'series';
				if (is_numeric($segments[$count-1]))
				{
					$vars['id'] = (int) $segments[$count-1];
				}
				else
				{
					$id = $this->getVar('series', $segments[$count-1], 'alias', 'id');
					if($id)
					{
						$vars['id'] = $id;
					}
				}
				break;
			case 'sermon':
				$vars['view'] = 'sermon';
				if (is_numeric($segments[$count-1]))
				{
					$vars['id'] = (int) $segments[$count-1];
				}
				else
				{
					$id = $this->getVar('sermon', $segments[$count-1], 'alias', 'id');
					if($id)
					{
						$vars['id'] = $id;
					}
				}
				break;
		}

		return $vars;
	} 

	protected function getVar($table, $where = null, $whereString = 'user', $what = 'id', $operator = '=', $main = 'sermondistributor')
	{
		if(!$where)
		{
			$where = JFactory::getUser()->id;
		}
		// Get a db connection.
		$db = JFactory::getDbo();
		// Create a new query object.
		$query = $db->getQuery(true);

		$query->select($db->quoteName(array($what)));
		if ('categories' == $table || 'category' == $table)
		{
			$query->from($db->quoteName('#__categories'));
		}
		else
		{
			$query->from($db->quoteName('#__'.$main.'_'.$table));
		}
		if (is_numeric($where))
		{
			$query->where($db->quoteName($whereString) . ' '.$operator.' '.(int) $where);
		}
		elseif (is_string($where))
		{
			$query->where($db->quoteName($whereString) . ' '.$operator.' '. $db->quote((string)$where));
		}
		else
		{
			return false;
		}
		$db->setQuery($query);
		$db->execute();
		if ($db->getNumRows())
		{
			return $db->loadResult();
		}
		return false;
	}
}

function SermondistributorBuildRoute(&$query)
{
	$router = new SermondistributorRouter;
	
	return $router->build($query);
}

function SermondistributorParseRoute($segments)
{
	$router = new ContentRouter;

	return $router->parse($segments);
}