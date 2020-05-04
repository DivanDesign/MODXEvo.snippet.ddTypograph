# (MODX)EvolutionCMS.snippets.ddTypograph changelog


## Version 2.4 (2017-12-09)
* \* Attention! PHP >= 5.4 is required.
* \* Attention! (MODX)EvolutionCMS.libraries.ddTools >= 0.21 is required.
* \+ Added an ability to exlude HTML tags from snippet processing (see the `excludeTags` parameter).
* \* Content of the `<code>` tag is excluded by default from the snippet processing (the `excludeTags` parameter by default is equal to `notg,code`).
* \* Minor changes: Code style and comments.


## Version 2.3 (2015-08-24)
* \* PHP.libraries.EMT has been updated to 3.5:
	* \+ Unicode support has been added. At last!
	* \+ The `+X (XXX)XXXXXXX` phone format is now supported. Phones matching this pattern will be rewritten as `+X XXX XXX-XX-XX`.
	* \+ Thin space (`&thinsp;`) is now being used as the thousands separator (`10&thinsp;000`).
	* \* Mistaken transformation of an uppercase domain zone to initials has been fixed (`XXX.RU John Doe` → `XXX.R. U. John Doe`).
	* \* The error occurring while processing nested tags has been fixed.
	* \* Processing of links in quotes has been improved.
	* \* Putting dots in initials has been improved.
	* \* The quotes parsing rule was greatly improved.
	* \* The `$`, `€`, and `№` characters will be complemented with a non-breaking space (`&nbsp;`) either after or before depending on the position of the adjacent number.
* \* The `Nobr.phone_builder` typograph option now depends on the `noTags` snippet parameter.
* \* Forbidding line breaking using HTML tags is now controlled by the only `Etc.nobr_to_nbsp` typograph option.
* \* Other minor changes.


## Version 2.2 (2014-05-25)
* \* Attention! (MODX)EvolutionCMS.libraries.ddTools >= 0.12 is required.
* \* PHP.libraries.EMT has been updated to 3.3:
	* \* The period placement rule has been improved.
	* \* Optical margin alignment is now on by default. Also, the opening quotation mark alignment was improved.
	* \* The Volt symbol bug has been fixed.
	* \* Inch and closing quotation marks will no longer be mixed up.
* \+ The `noTags` parameter has been added. It allows disabling of HTML-tags inserting to the text.
* \- The redundant parameter `Nobr_hyphenNowrap` has been removed. You can use `noTags` instead. Please, contact us if you think that the removed parameter was useful and it should be returned.
* \* The following parameters have been renamed (the snippet works with the old names but they are deprecated):
	* `OptAlign` → `optAlign`.
	* `Text_paragraphs` → `text_paragraphs`.
	* `Text_autoLinks` → `text_autoLinks`.
	* `Etc_unicodeConvert` → `etc_unicodeConvert`.


## Version 2.1 (2014-04-16)
* \+ The `Nobr_hyphenNowrap` parameter, allowing hyphenated words to be rendered in nowrap mode, has been added.


## Version 2.0.2b (2014-03-26)
* \* The `else` statement was added in the string length check to prevent returning void. The snippet now returns the same passed string if its length is less than four symbols.


## Version 2.0.1b (2014-02-25)
* \* The path to PHP.libraries.EMT has been fixed.


## Version 2.0b (2014-02-21)
* \* PHP.libraries.EMT 3.2 is used.
* \- The following parameters have been removed:
	* \- `disableTof`.
	* \- `disableBaseParam`.
* \+ The following parameters have been added:
	* \+ `OptAlign`.
	* \+ `Text_paragraphs`.
	* \+ `Text_autoLinks`.
	* \+ `Etc_unicodeConvert`.
* \* Warning! This version can be capable with the 1.x versions if the only `text` parameter was passed while 1.x using.


## Version 1.4.3 (2013-05-28)
* \* Tiny bugfix.


## Version 1.4.2 (2013-04-05)
* \* Bugfix for PHP 5.3 (files `/assets/snippets/ddtypograph/Jare/Typograph.php` & `/assets/snippets/ddtypograph/Jare/Typograph/Tof.php`).


## Version 1.4.1 (2013-03-06)
* \+ Parsing of `&#34;` is now correct.


## Version 1.4 (2010-10-10)
* \+ Added disabling base-params for tofs.


<link rel="stylesheet" type="text/css" href="https://DivanDesign.ru/assets/files/ddMarkdown.css" />
<style>ul{list-style:none;}</style>