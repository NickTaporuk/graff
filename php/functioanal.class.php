<?php

class Observer
{

    static function pdoConn($arr)
    {
        //$driver,$hostPref,$host,$dbPref,$dbName,$pass,$usrName
        $dsn=$arr[0].$arr[1].$arr[2].';'.$arr[3].$arr[4];
        try {
            $conn = new PDO($dsn,$arr[6],$arr[5]);
        } catch (Exception $exc) {
            echo 'Нет данных для загрузки';//сделать перенапрвление на страницу 404
        }
        return $conn ;

     }
     public function pdoFetch($query,$pdoObj)
     {
         try {
             $res=$pdoObj->query($query);
             
         } catch (Exception $exc) {
             echo 'Нет данных';//сделать перенапрвление на страницу 404
         }
         if(!$res){echo 'Нет данных'; exit;}

         else $result=$res->fetchAll(PDO::FETCH_ASSOC );
         $res = null;
         return $result;
     }
    private function insertPdo($query,$pdoObj)
    {
        try {
            $pdoObj->query($query);

        } catch (Exception $exc) {
            echo 'Нет данных';//сделать перенапрвление на страницу 404
        }
    }
    /*
     * @-
     *
     *
     * */
    public function selectForStattika($toStatic,$pdoObj)
    {
        $toStatic = '"'.$toStatic.'"' ;
        $query = 'SELECT concat(group_concat(T.cnt)) AS string_count
        FROM (
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign = 1  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign = 1 AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =1  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =1  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =1  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t  
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =1  AND o.action="Transfer"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =1 AND o.days=3  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =1 AND o.days=7  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =1 AND o.days=30  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'

        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =3   AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =3  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =3  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =3  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =3  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t  
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =3  AND o.action="Transfer"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 

        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =4   AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =4  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =4  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =4  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =4  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t  
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =4  AND o.action="Transfer"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =4 AND o.days=3  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =4 AND o.days=7  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =4 AND o.days=30  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'

        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =5   AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =5  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =5  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =5  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =5  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t  
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =5  AND o.action="Transfer"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =5 AND o.days=3  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =5 AND o.days=7  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =5 AND o.days=30  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'

        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =6   AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =6  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =6  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =6  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =6  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t  
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =6  AND o.action="Transfer"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'

        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =7   AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =7 AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =7  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =7  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =7  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t  
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =7  AND o.action="Transfer"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 


        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =8   AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =8 AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =8  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =8  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =8  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t  
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =8  AND o.action="Transfer"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'  


        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =9   AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =9 AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =9  AND o.action="Register"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =9  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(*) FROM (SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =9  AND o.action="PromoRegister"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' GROUP BY account_email) as t  
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
        AND g.utm_campaign =9  AND o.action="Transfer"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =9 AND o.days=3  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =9 AND o.days=7  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.'
        UNION  all
        SELECT COUNT(o.time ) as cnt  FROM webserver.operations_succes o JOIN webserver.google_analytics g ON g.utm_ga_id = o.utm_ga_id
         AND g.utm_campaign =9 AND o.days=30  AND o.action="PremiumAccount"  AND DATE(FROM_UNIXTIME(o.time))='.$toStatic.' 
) AS T';

            $collector_statistik['count'] = $this->pdoFetch($query,$pdoObj);
        return $collector_statistik ;
    }
    public function insertToStatistika($dateToStatistika,$stringToStatistika,$pdoObj)
    {
//                $query='INSERT INTO webserver.la2_Statistika(date_count,count) VALUES("'.$dateToStatistika.'","'.$stringToStatistika.'")';
                $query='INSERT INTO statistika_lineage.la2_Statistica(date_count,count) VALUES("'.$dateToStatistika.'","'.$stringToStatistika.'")';
                echo $query.'<br>';
                $this->insertPdo($query,$pdoObj);
        }

    public function explodeArrayToGraff($arr=array())
    {
            for($i=0;$i<count($arr);$i++)
            {
                $arr[$i]['count'] = explode(',',$arr[$i]['count']);
                for($j=0;$j<count($arr[$i]['count']);$j++)
                {
                    $arr[$i][$j]= $arr[$i]['count'][$j] ;
                }
                unset($arr[$i]['count']);
            }

        return $arr ;
    }
    public function runUp($arr,$serverName)
    {
        $all=array();
        $points=array() ;
        for($j=0;$j<count($serverName);++$j)
        {
            for($i=0;$i<count($arr);++$i)
            {
                $points[$i]= array($arr[$i]['date_count'],$arr[$i][$j]) ;

            }
            $all[] = $points;
        }

        return $all;
    }

    public function arrayToGraffFormatJson($arr,$serverName,$unsetFromArr)
    {
        $arr1=array();
        $arr2=array();
        $c = 0;
        for($i=0;$i<count($serverName);++$i)
        {

            $arr1[]=array(
                'color'=>$i,
                'label'=>$serverName[$i],
                'data'=>$arr[$i]
            );
            for($j=0;$j<count($unsetFromArr);++$j)
            {
                if($i==$unsetFromArr[$j])
                {
                    unset($arr1[$i]); continue;
                }

            }
            if(!empty($arr1[$i]))
            {
                $arr2[$c]= $arr1[$i];
                ++$c;
            }
        }
        if(empty($arr2))
        {
            $arr2[0]=array(
                'color'=>0,
                'label'=>'нет данных',
                'data'=>$arr[0]=array(array(0,0)),
            );
        }
        return $arr2;
    }
/*
 * функция для utm фильтров
 * которая создаёт запрос к базе и его выполняет делая строку счётчиков по дням 
 */
    public function selectForGraff($pdoObj,$utm_m,$utm_s,$json,$date_first,$date_end)
    {
        $str='';
        if(!empty($utm_m))
        {
            $str.= ' AND utm_medium="'.$utm_m.'"';
        }
        else $str.= ' AND utm_medium="none"';
        if(!empty($utm_s))
        {
            $str.= ' AND utm_source="'.$utm_s.'"';
        }
        else $str.= ' AND utm_source="none"';
        if($date_first!=''&&$date_end!='')
        {
            $str.= 'AND date between "'.$date_first.'" AND "'.$date_end.'"';
        }
        $range=range(0,64);
        $result = array_diff($range,$json);
    $query=array(
    //elegia
    'SELECT date,utm_acount  FROM google_stats WHERE utm_campaign = 1',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=1 AND utm_action="Register"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=1 AND utm_action="Register"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=1 AND utm_action="Promoregister"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=1 AND utm_action="Promoregister"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=1 AND utm_action="Transfer"  AND utm_type="none"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=1 AND utm_action="PremiumAccount"  AND utm_type="3"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=1 AND utm_action="PremiumAccount"  AND utm_type="7"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=1 AND utm_action="PremiumAccount"  AND utm_type="30"',
    //nanna
    'SELECT date,utm_acount  FROM google_stats WHERE utm_campaign = 3',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=3 AND utm_action="Register"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=3 AND utm_action="Register"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=3 AND utm_action="Promoregister"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=3 AND utm_action="Promoregister"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=3 AND utm_action="Transfer"  AND utm_type="none"',

    //elice
    'SELECT date,utm_acount  FROM google_stats WHERE utm_campaign = 4',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=4 AND utm_action="Register"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=4 AND utm_action="Register"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=4 AND utm_action="Promoregister"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=4 AND utm_action="Promoregister"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=4 AND utm_action="Transfer"  AND utm_type="none"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=4 AND utm_action="PremiumAccount"  AND utm_type="3"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=4 AND utm_action="PremiumAccount"  AND utm_type="7"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=4 AND utm_action="PremiumAccount"  AND utm_type="30"',
    //libria
    'SELECT date,utm_acount  FROM google_stats WHERE utm_campaign = 5',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=5 AND utm_action="Register"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=5 AND utm_action="Register"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=5 AND utm_action="Promoregister"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=5 AND utm_action="Promoregister"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=5 AND utm_action="Transfer"  AND utm_type="none"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=5 AND utm_action="PremiumAccount"  AND utm_type="3"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=5 AND utm_action="PremiumAccount"  AND utm_type="7"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=5 AND utm_action="PremiumAccount"  AND utm_type="30"',
    //gloria
    'SELECT date,utm_acount  FROM google_stats WHERE utm_campaign = 6',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=6 AND utm_action="Register"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=6 AND utm_action="Register"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=6 AND utm_action="Promoregister"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=6 AND utm_action="Promoregister"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=6 AND utm_action="Transfer"  AND utm_type="none"',
    //lionna
    'SELECT date,utm_acount  FROM google_stats WHERE utm_campaign = 7 ',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=7 AND utm_action="Register"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=7 AND utm_action="Register"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=7 AND utm_action="Promoregister"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=7 AND utm_action="Promoregister"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=7 AND utm_action="Transfer"  AND utm_type="none"',
    //legacy
    'SELECT date,utm_acount  FROM google_stats WHERE utm_campaign = 8',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=8 AND utm_action="Register"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=8 AND utm_action="Register"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=8 AND utm_action="Promoregister"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=8 AND utm_action="Promoregister"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=8 AND utm_action="Transfer"  AND utm_type="none"',
    //luna
    'SELECT date,utm_acount  FROM google_stats WHERE utm_campaign = 9',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=9 AND utm_action="Register"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=9 AND utm_action="Register"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=9 AND utm_action="Promoregister"  AND utm_type="all"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=9 AND utm_action="Promoregister"  AND utm_type="unique"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=9 AND utm_action="Transfer"  AND utm_type="none"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=9 AND utm_action="PremiumAccount"  AND utm_type="3"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=9 AND utm_action="PremiumAccount"  AND utm_type="7"',
    'SELECT date,utm_acount  FROM google_stats_data WHERE  utm_campaign=9 AND utm_action="PremiumAccount"  AND utm_type="30"',
    //Обший показатели
    'SELECT date,utm_acount FROM google_stats_data WHERE utm_campaign = 0 AND utm_action="Register" AND utm_type="all"',
    'SELECT date,utm_acount FROM google_stats_data WHERE utm_campaign = 0 AND utm_action="Register" AND utm_type="unique"',
    'SELECT date,utm_acount FROM google_stats_data WHERE utm_campaign = 0 AND utm_action="Activated" AND utm_type="reg" ',
  );

$addNullToArray=array();    
$addNullToArray1=array();    
$collector_statistik=array();
$raznost_dat=1+floor((strtotime($date_end)-strtotime($date_first))/86400);

            for($i=0;$i<count($query);$i++)
            {
                if(isset($result[$i]))
                {    
                if(!empty($query[$result[$i]]))
                {
                    $collector_statistik[$i]= $this->pdoFetch($query[$i].$str, $pdoObj);
                    //1. если пустой массив вернул забиваем его 0
                    if(empty($collector_statistik[$i]))
                    {
                    
                    for($z=0;$z<$raznost_dat;$z++)
                        {
                            $collector_statistik[$i][$z]= array('date'=>date('Y-m-d',(strtotime($date_first)+($z*86400))),'utm_acount'=>0);
                        }
                    }
                    //3.если 0 елемент есть но не все попарядку даты
                    if($collector_statistik[$i][0]['date']==$date_first)
                    {
                        $addNullToArray1[]=$collector_statistik[$i];
                        for($x=0;$x<$raznost_dat;$x++)
                        { 
                           $collector_statistik[$i][$x]=array('date'=>date('Y-m-d',(strtotime($date_first)+($x*86400))),'utm_acount'=>0);
                        }
                                                
                        for($y=0;$y<count($addNullToArray1);$y++)
                        {
                            
                            for($v=0;$v<count($addNullToArray1[$y]);$v++)
                            {
                               $q = (strtotime($addNullToArray1[$y][$v]['date'])- strtotime($date_first))/86400;
                               $collector_statistik[$i][$q]=$addNullToArray1[$y][$v]  ;
                            }
                        }
                        unset($addNullToArray1);
                    }

                    //2. если 0 елемент не равен начальной дате и массиве даты не по порядку
                    //   то забираю весь массив и корректирую его    
                    if($collector_statistik[$i][0]['date']!==$date_first)
                    {
                       $addNullToArray[]= $collector_statistik[$i];
                       unset($collector_statistik[$i]);
                        $collector_statistik[$i][0]=array('date'=>$date_first,'utm_acount'=>0);

                        for($x=0;$x<$raznost_dat;$x++)
                        { 
                           $collector_statistik[$i][$x]=array('date'=>date('Y-m-d',(strtotime($date_first)+($x*86400))),'utm_acount'=>0);
                        }
                        
                        for($y=0;$y<count($addNullToArray);$y++)
                        {
                            for($v=0;$v<count($addNullToArray[$y]);$v++)
                            {

                               $q = (strtotime($addNullToArray[$y][$v]['date'])- strtotime($date_first))/86400;
                               $collector_statistik[$i][$q]=$addNullToArray[$y][$v]  ;
                            }
                        }
                        unset($addNullToArray);
                    }
                    
                }
                    else continue;
                }
            } 
                        return $collector_statistik ;
    }
    
public function arrayToGraffFormatJsonUTM($arr,$serverName)
    {
        $all=array();
        $points=array() ;
        foreach ($arr as $key => $value) 
        {
            foreach ($value as $key => $val) 
            {
                $points[$key]= array($val['date'],$val['utm_acount']) ;
            }
            $all[] = $points;
        }
        $arr1=array();
        $c = 0;
        foreach ($arr as $key => $value) 
        {
                $arr1[$c]=array(
                    'color'=>$key,
                    'label'=>$serverName[$key],
                    'data'=>$all[$c],
                );
                ++$c;
        }
        if(empty($arr1))
        {
            $arr1[0]=array(
                'color'=>0,
                'label'=>'нет данных',
                'data'=>$arr[0]=array(array(0,0)),
            );
        }
        return $arr1;
    }    
}

?>
