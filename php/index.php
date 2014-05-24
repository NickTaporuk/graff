<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'conf.php';
require_once 'functioanal.class.php';
require_once 'BD.class.php';
$f = new Functional();

$loc=array(
    $conf['driver'][0],
    $conf['hostPref'],
    $conf['host'][0],
    $conf['dbPref'],
    $conf['dbName'][0],
    $conf['pass'][0],
    $conf['usrName'][0]
            );

//$bd = BD::getInstance($loc)->pdoFetch('SELECT * FROM tasks',$bd);
$bd = new BD($conf);
//$b = $bd->query('SELECT * FROM google_stats')->fetchAll(PDO::FETCH_ASSOC );
 $b =$bd->pdoFetch('SELECT * FROM google_stats');
print_r($b);