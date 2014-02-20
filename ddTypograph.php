<?php
/**
 * ddTypograph.php
 * @version 1.4.3 (2013-05-28)
 * 
 * @desc Snippet for text typography.
 * 
 * @uses Jare Typograph 2.0.0_dd1 lib (contains in archive).
 * 
 * @param $text {string} - Text for typography. @required
 * @param $disableTof {comma separated string} - Tofs to disable. Default: ''.
 * @param $disableBaseParam {separated string} - Base-params of tofs to disable. Format: 'tof1::param1,param2||tof2::param1||etc'. Default: 'etc::paragraphs,auto_links,email,optical_alignment||quote::optical_alignment'.
 * 
 * @link http://code.divandesign.biz/modx/ddtypograph/1.4.3
 * 
 * @copyright 2013, DivanDesign
 * http://www.DivanDesign.biz
 */

//Если есть что типографировать
if (strlen($text) > 4){
	//Заменим кавычки, вставленные через спец. символы на обычные (а то не обрабатываются в библиотеке)
	$text = str_replace('&#34;', '"', $text);
	
	$disableTof = isset($disableTof) ? explode(',', $disableTof) : array();
	$disableBaseParam = isset($disableBaseParam) ? $disableBaseParam : 'etc::paragraphs,auto_links,email,optical_alignment||quote::optical_alignment';
	
	//Подключаем Jare типограф
	set_include_path($modx->getConfig('base_path').'/assets/snippets/ddtypograph');
	require_once 'Jare/Typograph.php';
	
	$jareTypo = new Jare_Typograph($text);
	
	//Отключаем ненужные тофы
	foreach ($disableTof as $val){$jareTypo->getTof($val)->disableParsing(true);}
	
	//Отключаем необходимые базовые параметры
	$mas = explode('||', $disableBaseParam);
	
	foreach ($mas as $val){
		$val = explode('::', $val);
		$jareTypo->getTof($val[0])->disableBaseParam(explode(',', $val[1]));
	}
	
	//Типографируем
	return $jareTypo->parse($jareTypo->getBaseTofsNames());
}
?>