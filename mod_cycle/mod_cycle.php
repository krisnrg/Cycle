<?php 
	defined('_JEXEC') or die('Restricted access');
	require_once (dirname(__FILE__).DS.'helper.php');
	
	// Get params from Joomla
	$XMLpath = $params->get('XMLpath');
	$moduleClass = $params->get('moduleclass_sfx');
	$IdSelector = $params->get('selector');
	$width = $params->get('width');
	$height = $params->get('height');
	$padding = ($params->get('margin')? $params->get('margin'): 40);
	$class = ($params->get('Class') ? $params->get('Class') : 'rotator');
	$output = '';
	$jquery = $params->get('jquery');
		
	cycleHelper::setXML($XMLpath);
	cycleHelper::addJs($XMLpath,$moduleClass,$IdSelector,$width, $height, $padding, $jquery);
 	cycleHelper::rand($XMLpath,$class,$output);
	
	
	//load they layout I guess...
	require(JModuleHelper::getLayoutPath('mod_cycle','default'));