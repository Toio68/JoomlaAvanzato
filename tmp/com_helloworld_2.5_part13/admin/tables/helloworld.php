<?php

// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * Hello Table class
 */
class HelloWorldTableHelloWorld extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__helloworld', 'id', $db);
	}
	/**
	 * Overloaded bind function
	 *
	 * @param       array           named array
	 * @return      null|string     null is operation was satisfactory, otherwise returns an error
	 * @see JTable:bind
	 * @since 1.5
	 */
	public function bind($array, $ignore = '') 
	{
		if (isset($array['params']) && is_array($array['params'])) 
		{
			// Convert the params field to a string.
			$parameter = new JRegistry;
			$parameter->loadArray($array['params']);
			$array['params'] = (string)$parameter;
		}
		return parent::bind($array, $ignore);
	}

	/**
	 * Overloaded load function
	 *
	 * @param       int $pk primary key
	 * @param       boolean $reset reset data
	 * @return      boolean
	 * @see JTable:load
	 */
	public function load($pk = null, $reset = true) 
	{
		if (parent::load($pk, $reset)) 
		{
			// Convert the params field to a registry.
			$params = new JRegistry;
			$params->loadJSON($this->params);
			$this->params = $params;
			return true;
		}
		else
		{
			return false;
		}
	}
}
