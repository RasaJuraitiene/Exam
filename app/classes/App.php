<?php

namespace App;

class App {

    /** @var \Core\FileDB **/
    public static $db;
    
    /** @var \Core\Session **/
    public static $session;

    public function __construct() {
        self::$db = new \Core\FileDB(DB_FILE);
        self::$db->load();
        
        self::$session = new \Core\Session();
    }

    public function __destruct() {
        self::$db->save();
    }
}
