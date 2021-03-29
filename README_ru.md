# (MODX)EvolutionCMS.snippets.ddTypograph

Сниппет типографирует текст. Не использует сторонних сервисов, не отправляет никаких запросов, всё делается прямо у вас на сервере.


## Использует

* PHP >= 5.6
* [(MODX)EvolutionCMS.libraries.ddTools](https://code.divandesign.biz/modx/ddtools) >= 0.48.1
* [PHP.libraries.EMT](http://mdash.ru) 3.5 (содержится в архиве)


## Документация


### Установка


#### 1. Элементы → Сниппеты: Создайте новый сниппет со следующими параметрами

1. Название сниппета: `ddTypograph`.
2. Описание: `<b>2.5</b> Сниппет типографирует текст. Не использует сторонних сервисов, не отправляет никаких запросов, всё делается прямо у вас на сервере.`.
3. Категория: `Core`.
4. Анализировать DocBlock: `no`.
5. Код сниппета (php): Вставьте содержимое файла `ddTypograph_snippet.php` из архива.


#### 2. Элементы → Управление файлами

1. Создайте новую папку `assets/snippets/ddTypograph/`.
2. Извлеките содержимое архива в неё (кроме файла `ddTypograph_snippet.php`).


### Описание параметров

* `text`
	* Описание: Текст, который нужно типографировать.
	* Допустимые значения: `string`
	* **Обязателен**
	
* `optAlign`
	* Описание: Оптическое выравнивание (висячая пунктуация).
	* Допустимые значения:
		* `0`
		* `1`
	* Значение по умолчанию: `0`
	
* `text_paragraphs`
	* Описание: Простановка параграфов и переносов строк.
	* Допустимые значения:
		* `0`
		* `1`
	* Значение по умолчанию: `0`
	
* `text_autoLinks`
	* Описание: Выделение ссылок из текста (в том числе email).
	* Допустимые значения:
		* `0`
		* `1`
	* Значение по умолчанию: `0`
	
* `etc_unicodeConvert`
	* Описание: Преобразовывать HTML-сущности в юникод (`—` вместо `&mdash;` и т. п.).
	* Допустимые значения:
		* `0`
		* `1`
	* Значение по умолчанию: `1`
	
* `noTags`
	* Описание: Не добавлять HTML-теги.  
		Бывают ситуации, когда использование HTML-тегов в тексте недопустимо (например, когда текст выводится в значение атрибута тега), для таких случаев и предназначен этот параметр.
	* Допустимые значения:
		* `0`
		* `1`
	* Значение по умолчанию: `0`
	
* `excludeTags`
	* Описание: HTML-теги, содержимое которых не будет типографироваться.
	* Допустимые значения: `stringCommaSeparated`
	* Значение по умолчанию: `'notg,code'`


### Примеры


#### Типографирование контента перед выводом

```
[[ddTypograph? &text=`[*content*]`]]
```


#### Типографирование текста с автоматической расстановкой абзацев, ссылок и адресов email

```
[[ddTypograph?
	&text=`Какой-то текст, который должен быть типографирован.`
	&text_paragraphs=`1`
	&text_autoLinks=`1`
]]
```


#### Типографирование текста с автоматическим оптическим выравниванием (висячие кавычки и пр.)

```
[[ddTypograph?
	&text=`Какой-то текст, который должен быть "типографирован".`
	&optAlign=`1`
]]
```


#### Отключить работу типографа для фрагмента текста (тег `<notg></notg>`)

```html
[[ddTypograph?
	&text=`Какой-то текст. <notg>Текст внутри этого тега не будет типографироваться.</notg> Вот так просто.`
]]
```


#### Запустить сниппет без DB и eval через `\DDTools\Snippet::runSnippet`

```php
\DDTools\Snippet::runSnippet([
	'name' => 'ddTypograph',
	'params' => [
		'text' => "
			There's nothing you can do that can't be done
			Nothing you can sing that can't be sung
			
			https://ru.wikipedia.org/wiki/The_Beatles
		",
		'text_paragraphs' => true,
		'text_autoLinks' => true
	]
]);
```

Вернёт:

```
<p>There’s nothing you can do&nbsp;that can’t be&nbsp;done<br>
Nothing you can sing that can’t be&nbsp;sung</p>
<p><a href="https://en.wikipedia.org/wiki/The_Beatles">en.wikipedia.org/wiki/The_Beatles</a></p>
```


## Ссылки

* [Home page](https://code.divandesign.ru/modx/ddtypograph)
* [Telegram chat](https://t.me/dd_code)
* [Packagist](https://packagist.org/packages/dd/evolutioncms-snippets-ddtypograph)


<link rel="stylesheet" type="text/css" href="https://DivanDesign.ru/assets/files/ddMarkdown.css" />