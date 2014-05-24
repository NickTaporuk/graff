<?php
/**
 * User: Николай
 * Date: 26.08.13
 */
require_once"functioanal.class.php";
require_once"conf.php";
const DEFAULT_DATE = '15.06.2013';
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

if(!empty($_POST['utm_s']) || !empty($_POST['utm_m']))
{
    $utm_s = $_POST['utm_s'];
    $utm_m = $_POST['utm_m'];
    $pdoObj = Functional::pdoConn($loc);

    if(isset($_POST['first']) || isset($_POST['end_date'])|| isset($_POST['json']))
    {
        /*
         * 1.сначала запрос на выборку дат если есть они
         * 2.запрос по счётчику и дальше понакатаной
         * */
        if(!$_POST['end_date'])
        {
            $_POST['end_date'] = date('d.m.Y');
        }
        if(!$_POST['first'])
        {
            $_POST['first'] = DEFAULT_DATE ;
        }
   
        $first = date('Y-m-d',strtotime($_POST['first']));
        $end = date('Y-m-d',strtotime($_POST['end_date']));
        $json = explode(',',$_POST['json']);

        $arr=$f->selectForGraff($pdoObj,$utm_m,$utm_s,$json,$first ,$end) ;
        $arr1 = $f->arrayToGraffFormatJsonUTM($arr, $conf['toGraff']);
        echo json_encode($arr1) ;
    }
}
else
{
    if(isset($_POST['first']) || isset($_POST['end_date'])|| isset($_POST['json']))
    {
        $pdoObj = Functional::pdoConn($loc);
        if(!$_POST['end_date'])
        {
            $_POST['end_date'] = date('d.m.Y');
        }
        if(!$_POST['first'])
        {
            $_POST['first'] = '15.06.2013';
        }
        $first = date('Y-m-d',strtotime($_POST['first']));
        $end = date('Y-m-d',strtotime($_POST['end_date']));
        $utm_m='none';
        $utm_s='none';
        $json =($_POST['json']);
        $json = explode(',',$json);

        $arr=$f->selectForGraff($pdoObj,$utm_m,$utm_s,$json,$first ,$end) ;
        $arr3 = $f->arrayToGraffFormatJsonUTM($arr, $conf['toGraff']);
        echo json_encode($arr3) ;
    }
}
/*
 * utm_source
 * подгрузка контента
 * */
if(isset($_POST['queryString']))
{
    $pdoObj = Functional::pdoConn($loc);
    $q = $_POST['queryString'];
    $query = 'SELECT DISTINCT utm_source FROM google_stats  WHERE utm_source LIKE "%'.$q.'%" LIMIT 15';
    $arr_=$f->pdoFetch($query,$pdoObj);
    $str='';
    foreach($arr_ as $key=>$val)
    {
        $str.='<div class="select">'.$val["utm_source"].'</div>';
    }

    echo $str;
}
/*
 * utm_medium
 * подгрузка контента
 * */
if(isset($_POST['input_utm_medium']))
{
    $pdoObj = Functional::pdoConn($loc);
    $q = $_POST['input_utm_medium'];
    $query = 'SELECT DISTINCT utm_medium FROM google_stats  WHERE utm_medium LIKE "%'.$q.'%" LIMIT 15';
    $arr_=$f->pdoFetch($query,$pdoObj);
    $str='';
    foreach($arr_ as $key=>$val)
    {
        $str.='<div class="select1">'.$val["utm_medium"].'</div>';
    }

    echo $str;
}
