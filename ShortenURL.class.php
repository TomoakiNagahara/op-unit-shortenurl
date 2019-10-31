<?php
/**
 * unit-shortenurl:/ShortenURL.class.php
 *
 * @created   2019-10-31
 * @version   1.0
 * @package   unit-shortenurl
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP\UNIT;

/** Used class
 *
 */
use OP\OP_CORE;
use OP\OP_UNIT;
use OP\IF_UNIT;
use OP\Env;
use OP\Unit;
use OP\UNIT\SHORTENURL\Admin;
use OP\UNIT\SHORTENURL\COMMON;
use OP\UNIT\SHORTENURL\Constance;

/** ShortenURL
 *
 * @created   2019-10-31
 * @version   1.0
 * @package   unit-shortenurl
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class ShortenURL implements IF_UNIT
{
	/** trait
	 *
	 */
	use OP_CORE, OP_UNIT, COMMON;

	/** Automatically
	 *
	 * @created  2019-10-31
	 */
	function Auto()
	{
		//	...
		list($url, $query) = explode('?', $_SERVER['REQUEST_URI'].'?');

		//	...
		$pos = strrpos($url, '/');
		$key = substr($url, $pos+1);

		//	...
		$select = [];
		$select['table'] = Constance::_TABLE_;
		$select['where']['key'] = $key;
		$select['limit'] = 1;

		//	...
		if(!$record = $this->_DB()->Select($select) ){
			return;
		}

		//	...
		$url = $record['url'];

		//	...
		if( Env::Get('shortenurl')['query'] ){
			$url .= '?'.$query;
		}

		//	...
		Unit::App()->Transfer($url);
	}

	/** Admin
	 *
	 * @created  2019-10-31
	 */
	function Admin()
	{
		include(__DIR__.'/Admin.class.php');
		return new Admin();
	}
}
