<?php
/**
 * ddTypograph.php
 * @version 2.2 (2014-05-25)
 * 
 * @desc Snippet for text typography.
 * 
 * @uses The modx.ddTools library 0.12.
 * @uses EMT lib 3.5 (contains in archive).
 * 
 * @param $text {string} — Text to correct. @required
 * @param $optAlign {0 | 1} — Optical alignment (hanging punctuation). Default: 0.
 * @param $text_paragraphs {0 | 1} — Section signs and line breaks insertion. Default: 0.
 * @param $text_autoLinks {0 | 1} — Marking links (including email ones). Default: 0.
 * @param $etc_unicodeConvert {0 | 1} — Convert html entities into Unicode (“—” instead of “&mdash;” etc.). Default: 1.
 * @param $noTags {0 | 1} — Whether HTML element insertion is allowed or not. There are cases when using tags causes the text to be invalid, for example, using the snippet inside of an HTML attribute. Default: 0.
 * 
 * @link http://code.divandesign.biz/modx/ddtypograph/2.2
 * 
 * @copyright 2014, DivanDesign
 * http://www.DivanDesign.biz
 */

//Если есть что типографировать
if (strlen($text) > 4){
	global $ddTypograph;
	
	//Заменим кавычки, вставленные через спец. символы на обычные (а то не обрабатываются в библиотеке)
	$text = str_replace('&#34;', '"', $text);
	
	if (!isset($ddTypograph)){
		//Подключаем EMT типограф
		require_once $modx->config['base_path'].'assets/snippets/ddTypograph/EMT.php';
		
		$ddTypograph = new EMTypograph();
	}
	
	//Подключаем modx.ddTools
	require_once $modx->config['base_path'].'assets/snippets/ddTools/modx.ddtools.class.php';
	
	//Для обратной совместимости
	extract(ddTools::verifyRenamedParams($params, array(
		'optAlign' => 'OptAlign',
		'text_paragraphs' => 'Text_paragraphs',
		'text_autoLinks' => 'Text_autoLinks',
		'etc_unicodeConvert' => 'Etc_unicodeConvert'
	)));
	
	//Если нельзя добавлять теги к тексту
	if (isset($noTags) && $noTags == 1){
// 		$noTags = 'off';
		
		$optAlign = 'off';
		$text_paragraphs = 'off';
		$text_autoLinks = 'off';
		
		$etc_nobr_to_nbsp = 'on';
	}else{
// 		$noTags = 'on';
		
		$optAlign = isset($optAlign) && $optAlign == 1 ? 'on' : 'off';
		$text_paragraphs = isset($text_paragraphs) && $text_paragraphs == 1 ? 'on' : 'off';
		$text_autoLinks = isset($text_autoLinks) && $text_autoLinks == 1 ? 'on' : 'off';
		
		$etc_nobr_to_nbsp = 'off';
	}
	
	$etc_unicodeConvert = isset($etc_unicodeConvert) && $etc_unicodeConvert == 0 ? 'off' : 'on';
	
	$ddTypograph->setup(array(
		//Расстановка «кавычек-елочек» первого уровня
		'Quote.quotes' => 'on',
		//Внутренние кавычки-лапки
		'Quote.quotation' => 'on',
		
		//Автоматическая простановка дефисов в обезличенных местоимениях и междометиях
		'Dash.to_libo_nibud' => 'on',
		//Расстановка дефисов между «из-за», «из-под»
		'Dash.iz_za_pod' => 'on',
		//Расстановка дефисов перед «-ка», «-де», «-кась».
		'Dash.ka_de_kas' => 'on',
		
		//Привязка союзов и предлогов к написанным после словам
		'Nobr.super_nbsp' => 'on',
		//Привязка союзов и предлогов к предыдущим словам в случае конца предложения
		'Nobr.nbsp_in_the_end' => 'on',
		//TODO: работает плоховато (в «+7 777 777 77 77» ставит неразнывные пробелы только в двух первых случаях), обсудить с Евгением
		//Объединение в неразрывные конструкции номеров телефонов
// 		'Nobr.phone_builder' => $noTags,
		'Nobr.phone_builder' => 'on',
		//Дополнительный формат номеров телефонов («+7(123)1234567» → «+7 123 123-45-67»)
// 		'Nobr.phone_builder_v2' => $noTags,
		'Nobr.phone_builder_v2' => 'on',
		//Объединение IP-адресов.
		'Nobr.ip_address' => 'off',
		//Привязка инициалов к фамилиям («Иванов И. И.» → «Иванов&nbsp;И.&nbsp;И.»)
// 		'Nobr.spaces_nobr_in_surname_abbr' => $noTags,
		'Nobr.spaces_nobr_in_surname_abbr' => 'on',
		//Расстановка точек у инициалов («Иванов И И» | «Иванов ИИ» → «Иванов И. И.»)
// 		'Nobr.dots_for_surname_abbr' => $noTags,
		'Nobr.dots_for_surname_abbr' => 'on',
		//TODO: Не работает (по крайней мере, не удалось увидеть работу)
		//Привязка градусов к числу
		'Nobr.nbsp_celcius' => 'on',
		//TODO: Параметр не ясен
		//Обрамление пятисимвольных слов разделенных дефисом в неразрывные блоки
		'Nobr.hyphen_nowrap_in_small_words' => 'off',
		//Отмена переноса слова с дефисом
// 		'Nobr.hyphen_nowrap' => $noTags,
		'Nobr.hyphen_nowrap' => 'on',
		//TODO: Тег «nobr» невалидный, а для «word-spacing» нет значения «nowrap», нужно использовать свойство «white-space».
		//Использовать nowrap для неразрывных конструкций
		'Nobr.nowrap' => 'on',
		
		//Замена «(tm)» на символ торговой марки «™»
		'Symbol.tm_replace' => 'on',
		//Замена «(r)» на символ зарегистрированной торговой марки «®»
		'Symbol.r_sign_replace' => 'on',
		//Замена «(c)» на символ копирайта «©»
		'Symbol.copy_replace' => 'on',
		//Расстановка правильного апострофа в текстах
		'Symbol.apostrophe' => 'on',
		//TODO: Параметр не ясен
		//Градусы по Фаренгейту
		'Symbol.degree_f' => 'on',
		//TODO: Не срабатывает в конце предложения
		//Замена стрелок «<-» и «->» на символы «←» и «→»
		'Symbol.arrows_symbols' => 'on',
		//TODO: Параметр не ясен
		//Расстановка дюйма после числа
		'Symbol.no_inches' => 'on',
		
		//Расстановка запятых перед «а» и «но»
		'Punctmark.auto_comma' => 'on',
		//Замена трех точек на знак многоточия («...» → «…»)
		'Punctmark.hellip' => 'on',
		//Замена сдвоенных знаков препинания на одинарные
		'Punctmark.fix_pmarks' => 'on',
		//Замена восклицательного и вопросительного знаков местами
		'Punctmark.fix_excl_quest_marks' => 'on',
		//Точка в конце текста, если её там нет
		'Punctmark.dot_on_end' => 'off',
		
		//Расстановка знака минус между числами
		'Number.minus_between_nums' => 'on',
		//TODO: Параметр не ясен
		//Расстановка знака минус между диапозоном чисел
		'Number.minus_in_numbers_range' => 'off',
		//Замена «x» (и по-русски и по-английски) на символ «×» в размерных единицах
		'Number.auto_times_x' => 'on',
		//Замена дробей на соответствующие символы («1/2» → «½», «1/4» → «⅓», «3/4» → «¼»)
		'Number.simple_fraction' => 'off',
		//Математические знаки больше или равно/меньше или равно/плюс минус/неравно («>=» → «≥», «<=» → «≤», «+-» → «±», «!=» → «≠»)
		'Number.math_chars' => 'on',
		//Объединение триад чисел полупробелом (не разбивает на триады, просто заменяет обычный пробел на полупробел)
		'Number.thinsp_between_number_triads' => 'on',
		//Пробел между символом номера и числом
		'Number.thinsp_between_no_and_number' => 'on',
		//Пробел между символом параграфа и числом
		'Number.thinsp_between_sect_and_number' => 'on',
		
		//TODO: Параметр не ясен
		//Установка тире и пробельных символов в периодах дат
		'Date.years' => 'on',
		//Расстановка тире и объединение в неразрывные периоды месяцев
		'Date.mdash_month_interval' => 'off',
		//Расстановка тире и объединение в неразрывные периоды дней
		'Date.nbsp_and_dash_month_interval' => 'off',
		//Привязка года к дате (« 01.01.2015г.» → « 01.01.2015&nbsp;г.»)
		'Date.nobr_year_in_date' => 'on',
		
		//Удаление лишних пробельных символов и табуляций
		'Space.many_spaces_to_one' => 'on',
		//Удаление пробела перед символом процента
		'Space.clear_percent' => 'on',
		//Удаление пробелов перед и после знаков препинания в предложении
		'Space.clear_before_after_punct' => 'on',
		//Расстановка пробелов после знаков препинания
		'Space.autospace_after' => 'on',
		//Удаление пробелов внутри скобок, а также расстановка пробела перед скобками
		'Space.bracket_fix' => 'on',
		
		//Форматирование денежных сокращений (расстановка пробелов и привязка названия валюты к числу)
		'Abbr.nbsp_money_abbr' => 'on',
		//Объединение сокращений «и т. д.», «и т. п.», «в т. ч.»
// 		'Abbr.nobr_vtch_itd_itp' => $noTags,
		'Abbr.nobr_vtch_itd_itp' => 'on',
		//Расстановка пробелов перед сокращениями «см.», «им.»
		'Abbr.nobr_sm_im' => 'on',
		//Расстановка пробелов перед сокращениями «гл.», «стр.», «рис.», «илл.», «ст.», «п.»
		'Abbr.nobr_acronym' => 'on',
		//Расстановка пробелов в сокращениях «г.», «ул.», «пер.», «д.»
		'Abbr.nobr_locations' => 'on',
		//Расстановка пробелов перед сокращениями «dpi», «lpi»
		'Abbr.nobr_abbreviation' => 'on',
		//Объединение сокращений «P.S.», «P.P.S.»
// 		'Abbr.ps_pps' => $noTags,
		'Abbr.ps_pps' => 'on',
		//Привязка сокращений форм собственности к названиям организаций
		'Abbr.nbsp_org_abbr' => 'on',
		//Привязка аббревиатуры «ГОСТ» к номеру
// 		'Abbr.nobr_gost' => $noTags,
		'Abbr.nobr_gost' => 'on',
		//Установка пробельных символов в сокращении вольт
		'Abbr.nobr_before_unit_volt' => 'on',
		//Замена символов и привязка сокращений в размерных величинах («м», «см», «м2», …)
		'Abbr.nbsp_before_unit' => 'on',
		
		//TODO: Разобраться, что это за параметр и какие значения он может принимать
		//Все настройки оптического выравнивания
// 		'OptAlign.all' => 'off',
		//Оптическое выравнивание открывающей кавычки
		'OptAlign.oa_oquote' => $optAlign,
		//Оптическое выравнивание для пунктуации (скобка и запятая)
		'OptAlign.oa_obracket_coma' => $optAlign,
		//TODO: Параметр не ясен
		//Оптическое выравнивание кавычки
		'OptAlign.oa_oquote_extra' => $optAlign,
		//Inline стили или CSS-классы
		'OptAlign.layout' => 'style',
		
		//Простановка параграфов
		'Text.paragraphs' => $text_paragraphs,
		//Выделение ссылок из текста
		'Text.auto_links' => $text_autoLinks,
		//Выделение электронной почты из текста
		'Text.email' => $text_autoLinks,
		//Простановка переносов строк
		'Text.breakline' => $text_paragraphs,
		//Удаление повторяющихся слов
		'Text.no_repeat_words' => 'off',
		
		//Преобразовывать html-сущности в юникод
		'Etc.unicode_convert' => $etc_unicodeConvert,
		//Использовать символ «&nbsp;» вместо тегов для связывания
		'Etc.nobr_to_nbsp' => $etc_nobr_to_nbsp,
		//Разбиение числа на триады («10000» → «10&thinsp;000»)
		'Etc.split_number_to_triads' => 'on'
	));
	
	$ddTypograph->set_text($text);
	
	//Типографируем
	return $ddTypograph->apply();
}else{
	return $text;
}
?>