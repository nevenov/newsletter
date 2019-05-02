<?php
session_start();
//print_r($_SESSION);
//if(isset($_SERVER['HTTP_REFERER']) and $_SERVER['HTTP_REFERER']!="") { 
//if((isset($_SESSION["KCFinderAktive"]) and ($_SESSION["KCFinderAktive"]=="Activated"))) {
/** This file is part of KCFinder project
  *
  *      @desc Browser calling script
  *   @package KCFinder
  *   @version 2.54
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */

require "core/autoload.php";
$browser = new browser();
$browser->action();

//} else { echo "You could open this window only from admin area!";}
?>