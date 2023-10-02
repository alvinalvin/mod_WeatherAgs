
<?php
/**
 * @copyright	@copyright	Copyright (c) 2023 Weather. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
// recibiendo parametros de configuracion
$id_city      =     $params->get("idcity");
$api_key      =        $params->get("key");
$color        =      $params->get("color");
$font_color   =  $params->get("colorfont");
$units        =      $params->get("units");
// include the syndicate functions only once
// $class_sfx = htmlspecialchars($params->get('class_sfx'));
require(JModuleHelper::getLayoutPath('mod_weatherags', $params->get('layout', 'default')));
