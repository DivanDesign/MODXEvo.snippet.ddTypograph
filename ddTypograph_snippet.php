<?php
/**
 * ddTypograph
 * @version 2.4.2 (2020-05-06)
 * 
 * @see README.md
 * 
 * @link https://code.divandesign.biz/modx/ddtypograph
 * 
 * @copyright 2010–2020 DD Group {@link https://DivanDesign.biz }
 */

//Include (MODX)EvolutionCMS.libraries.ddTools
require_once(
	$modx->getConfig('base_path') .
	'assets/libs/ddTools/modx.ddtools.class.php'
	);

return \DDTools\Snippet::runSnippet([
	'name' => 'ddTypograph',
	'params' => $params
]);
?>