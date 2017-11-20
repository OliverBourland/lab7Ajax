<?php
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=my_guitar_shop1';
    private static $username = 'mgs_user';
    private static $password = 'pa55word';
	private static $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
			self::$db = new PDO(self::$dsn,
								self::$username,
								self::$password, 
								self::$options);
             
		}
        return self::$db;
    }
}
?>