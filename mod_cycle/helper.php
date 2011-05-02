<?php

/**
* Joomla helper class
*/
class cycleHelper
{

	var $xml;




	public function setXML($XMLpath) {
		$this->xml = $XMLpath;
	}

	public function addJs($XMLpath, $moduleClass,$IdSelector, $width, $height, $padding, $jquery)
	{
		//Send JS to header
		$document = &JFactory::getDocument();
		if ($jquery == "1") {
			$document->addScript('modules/mod_cycle/js/jquery.js');
		}
		// $document->addScript('modules/mod_cycle/js/originalHide.js');
		$document->addScript('modules/mod_cycle/js/cycle.js' );
		$document->addScript('modules/mod_cycle/js/script.js');
		$document->addStyleSheet('modules/mod_cycle/css/rotator.css' );
		
		

		//Javascript with PHP variable inside...
		$document->addScriptDeclaration('
			jQuery(document).ready(function(){

			p(\''.$XMLpath.'\',\''.$moduleClass.'\',\''.$IdSelector.'\',\''.($width).'\',\''.($height-($padding*2)).'\',\''.$padding.'\');

			});
			
			');
	}

	
	public function rotate(&$XMLpath, $class, &$output)
	{
		//Load XML file with picturepaths 
		if (file_exists($XMLpath)) {
			$parsed = simplexml_load_file($XMLpath);
		} 

		//Prepare class string
		if (!empty($class)) {
			$class = "class=\"". $class . "\"";
		} else {
			$class = '';
		}
		//Check if XMl file was loaded successfully
		if($parsed){
			foreach ($parsed->picture as $key => $value) {
				if(self::expires($value->expires) === true ){

					if(!empty($value->desc)){
						$desc = "<h2><span>".$value->desc."</span></h2>";
					} else {
						$desc = '';
					}
	
					if(!empty($value->link)) {
						$link = "<a href=\"".$value->link."\">";
						$close = "</a>";
					} else {
						$link = '';
						$close = '';
	 				}
				$output.= "<li>".$link."<img src=\"".$value->path."\"/>".$close.$desc."</li>";
				//echo "success";
				} else { $output .= '';}
			}
		} else {
			echo("There was an error loading the XML file");
		}
	}
	
	public function rand(&$XMLpath, &$class, &$output)
	{


		if (file_exists($XMLpath)) {
		$parsed = simplexml_load_file($XMLpath);
		
			$image = $parsed->picture;
			$rand = mt_rand(0,count($image)-1);
			if(!empty($image[$rand]->link)) {
				$link = "<a href=\"".$image[$rand]->link."\">";
				$close = "</a>";
			} else {
				$link = '';
				$close = '';
			}
			$output.= "<li>".$link."<img src=\"".$image[$rand]->path."\"/>".$close	."</li>";
			
		} else {
			$error = "Cycle Module:::The XML file could not be loaded::: rand function";
			//	mail("krisnrg@gmail.com","Error","$error"); 
		}
	}
	
	public function expires($date) {		
		
		$today = time();
		$date = strtotime($date);
		
		if ($today > $date) {
			return false;
			
		} else {
			return true;
		}
	}

}





?>