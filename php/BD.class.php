<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 18.05.14
 * Time: 21:49
 */

class BD extends PDO {
    private  $driver ;
    private  $host ;
    private  $activ_db ;
    private  $dbname;
    private  $user ;
    private  $pass ;
    private  $pref;
    private  $hostPref;
    private  $activeHost;
    private  $obj;

    function __construct($conf)
    {
        $this->activ_db      = $conf['db_bridge'];
        $this->activeHost     = $conf['activeHost'];
        $this->host          = $conf['host'][$this->activeHost] ;
        $this->driver        = $conf['driver'][$this->activ_db];
        $this->dbname        = $conf['dbName'][$this->activ_db];
        $this->user          = $conf['usrName'][$this->activ_db];
        $this->pass          = $conf['pass'][$this->activ_db];
        $this->pref          = $conf['dbPref'];
        $this->hostPref      = $conf['hostPref'];

        switch($this->driver)
        {
            case 'mysql:':
                $dsn = $this->driver.$this->hostPref.$this->host.";".$this->pref.$this->dbname ;
                break;
            case 'pgsql:':
                $dsn = $this->driver.$this->pref.$this->dbname." ".$this->hostPref.$this->host ;
                break;
//                case 'mongo':
//                    break;
//                case 'mssql':
//                    break;
//                case 'mariadb':
//                    break;
        }

        parent::__construct($dsn,$this->user,$this->pass);
    }
    public static function pdoFetch($query)
    {
        /*try {
            $res = $this ->query($query);

        } catch (Exception $exc) {
            echo 'Нет данных';//сделать перенапрвление на страницу 404
        }
        if(!$res){echo 'Нет данных'; exit;}

        else $result=$res->fetchAll(PDO::FETCH_ASSOC );
        $res = null;*/
//        print_r($this);
//        return $this;
    }

}