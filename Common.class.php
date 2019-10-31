<?php
/**
 * unit-shortenurl:/Common.class.php
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
namespace OP\UNIT\SHORTENURL;

/** Used class
 *
 */
use OP\Env;
use OP\Unit;

/** Common
 *
 * @created   2019-10-31
 * @version   1.0
 * @package   unit-shortenurl
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
trait COMMON
{
	/** Return database config.
	 *
	 * @created  2019-10-31
	 * @return   array $config
	 */
	private function _Config()
	{
		return Env::Get('shortenurl')['database'] ?? [];
	}

	/** Return Database UNIT.
	 *
	 * @created  2019-10-31
	 * @return \OP\UNIT\Database
	 */
	private function _DB()
	{
		/* @var $_db \OP\UNIT\Database */
		static $_db;
		if(!$_db ){
			$_db = Unit::Instantiate('Database');
			$_db->Connect($this->_Config());
		}
		return $_db;
	}
}
