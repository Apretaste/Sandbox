<?php

/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */

function smarty_function_img($params, $template)
{
	// get params
	$href = $params["src"];
	$alt = isset($params["alt"]) ? $params["alt"] : "";
	$width =  isset($params["width"]) ? "width='{$params["width"]}'" : "";
	$height =  isset($params["height"]) ? "height='{$params["height"]}'" : "";

	// @NOTE
	// This part of the method differs from the one in Production
	// So your images are displayed once you run your code
	// But you can still use this method; it will work well once in production

	$di = \Phalcon\DI\FactoryDefault::getDefault();
	$wwwroot = $di->get('path')['root'];
	copy($href, "$wwwroot/public/temp/".basename($href));

	// create and return image
	$wwwhttp = $di->get('path')['http'];
	$destination = "$wwwhttp/temp/".basename($href);
	return "<img src='$destination' alt='$alt' $width $height />";
}
