
<?php
require_once 'php/index.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <link type="text/css" href="jquery-ui-1.10.3.custom/css/start/jquery-ui-1.10.3.custom.css" rel="stylesheet" />
        <link type="text/css" href="css/jquery.ui.tabs.css" rel="stylesheet" />
        <!-- подгружаем Flot -->
  <script language="javascript" type="text/javascript" src="js/jquery-1.9.1.js"></script>
  <script language="javascript" type="text/javascript" src="flot/jquery.flot.js"></script>
  <script language="javascript" type="text/javascript" src="flot/jquery.flot.stack.js"></script>
  <script language="javascript" type="text/javascript" src="flot/jquery.flot.selection.js"></script>
  <script language="javascript" type="text/javascript" src="flot/jquery.flot.time.js"></script>
  <script language="javascript" type="text/javascript" src="flot/jquery.flot.navigate.js"></script>
  <script language="javascript" type="text/javascript" src="flot/jquery.flot.pie.js"></script>
  <script language="javascript" type="text/javascript" src="flot/excanvas.js"></script>
  <script language="javascript" type="text/javascript" src="js/moment.js"></script>
  <script language="javascript" type="text/javascript" src="js/flashcanvas.js"></script>

  <script language="javascript" type="text/javascript" src="js/jquery.ui.core.js"></script>
   <script language="javascript" type="text/javascript" src="js/jquery.ui.tabs.js"></script>
  <script language="javascript" type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
   <script language="javascript" type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
  <script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.2.custom.min.js"></script>
  <script language="javascript" type="text/javascript" src="js/i18n/jquery-ui-i18n.js"></script>
  <script language="javascript" type="text/javascript" >
  </script>
      </head>
    <body>

   <p><noscript><strong style="color: red;">
    Для отображения данных необходимо включить JavaScript!
  </strong></noscript></p>
    <!-- тут будет выводится график -->
   <div id="placeholder" style="width:1920px;height:500px;"></div>
   <div id="overview" style="margin-top:20px;width:1880px;height:100px"></div>
   <div id="razmerOkna"></div>
   <div id="statistica">
      <div id="stat-text">Статистика <span>&nbsp>>>></span></div>
      <div id="errorDisplay"></div>
      <form action="post"    id="filter">
          <label for="first-data" id="f-data">
              Начальная дата :
          </label>
          <input type="text" class="first-data">
          <label for="last-data" id="last-data">
              Конечная дата :
          </label>
          <input type="text" class="last-data">
          <label for="utm_source" id="utm_s">
              utm_source :
          </label>
          <input type="text" class="utm_source" onkeyup="lookup(this.value);" >
          <label for="utm_medium" id="utm_m">
              utm_medium :
          </label>
          <input type="text" class="utm_medium" onkeyup="lookup1(this.value);">
          <input id="submit" type="button" value="submit" onclick="check();">
<!--          <a href="#" onclick="switch_show(); return false;">Сменить вид</a>-->

          <div id="checkAdd">
              <div id="menu1">
                  <div id="check2">
                      <div>
                          <div id="legend" style="float: left;">
                              <table style="font-size: smaller;color: rgb(84, 84, 84);border-collapse: collapse;" ><caption>Elegia</caption>
                                  <thead style="background: #fc0;cellspacing:2px"><tr><td><input class="chk" type="checkbox" onclick='chk_chk(".chk",".chk-chk");'></td><td>цвет</td><td>Название серверов</td></tr></thead>
                                  <tbody>
                                  <?php
                                  for($i=0;$i<count($conf['toGraff']);$i++)
                                  {
                                      if($i<9)
                                      {
                                          ?>
                                          <tr>
                                              <td><input class="chk-chk" type="checkbox">
                                                  </input>
                                              </td>
                                              <td class="legendColorBox"><div style="padding:1px;">
                                                      <div style="width:4px;height:0;border:5px solid rgb(<?php echo $conf['color'][$i]; ?>);overflow:hidden">

                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="legendLabel" >
                                                  <?php echo $conf['toGraff'][$i]; ?>
                                              </td>
                                          </tr>
                                      <?php
                                      }
                                      else continue ;
                                  }
                                  ?>
                                  </tbody>
                                  </table>
                          </div>
                        
                          <div id="legend1" style="float: left">
                              <table style="font-size: smaller;color: rgb(84, 84, 84);border-collapse: collapse;" ><caption>Nanna</caption>
                                  <thead style="background: #fc0;cellspacing:0"><tr><td><input class="chk1" type="checkbox" onclick='chk_chk(".chk1",".chk1-chk1");'></td><td>цвет</td><td>Название серверов</td></tr></thead>
                                  <tbody>
                                  <?php
                                  for($i=0;$i<count($conf['toGraff']);$i++)
                                  {
                                      if(($i>=9)&&($i<15))
                                      {
                                          ?>
                                          <tr>
                                              <td><input class="chk1-chk1" type="checkbox">
                                                  </input>
                                              </td>
                                              <td class="legendColorBox"><div style="padding:1px">
                                                      <div style="width:4px;height:0;border:5px solid rgb(<?php echo $conf['color'][$i]; ?>);overflow:hidden">

                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="legendLabel">
                                                  <?php echo $conf['toGraff'][$i]; ?>
                                              </td>
                                          </tr>
                                      <?php
                                      }
                                      else {continue ;}
                                  }
                                  ?>
                                  </tbody>
                              </table>
                          </div>

                          <div id="legend2" style="float: left">
                              <table style="font-size: smaller;color: rgb(84, 84, 84);border-collapse: collapse;" ><caption>Elice</caption>
                                  <thead style="background: #fc0;cellspacing:0"><tr><td><input class="chk2" onclick='chk_chk(".chk2",".chk2-chk2");' type="checkbox"></td><td>цвет</td><td>Название серверов</td></tr></thead>
                                  <tbody>
                                  <?php
                                  for($i=0;$i<count($conf['toGraff']);$i++)
                                  {
                                      if(($i>=15)&&($i<=23))
                                      {
                                          ?>
                                          <tr>
                                              <td><input class="chk2-chk2" type="checkbox">
                                                  </input>
                                              </td>
                                              <td class="legendColorBox"><div style="padding:1px">
                                                      <div style="width:4px;height:0;border:5px solid rgb(<?php echo $conf['color'][$i]; ?>);overflow:hidden">

                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="legendLabel">
                                                  <?php echo $conf['toGraff'][$i]; ?>
                                              </td>
                                          </tr>
                                      <?php
                                      }
                                      else {continue ;}
                                  }
                                  ?>
                                  </tbody>
                              </table>
                           </div>

                          <div id="legend3" style="float: left">
                              <table style="font-size: smaller;color: rgb(84, 84, 84);border-collapse: collapse;" ><caption>Libria</caption>
                                  <thead style="background: #fc0;cellspacing:0"><tr><td><input class="chk3" onclick='chk_chk(".chk3",".chk3-chk3");' type="checkbox"></td><td>цвет</td><td>Название серверов</td></tr></thead>
                                  <tbody>
                                  <?php
                                  for($i=0;$i<count($conf['toGraff']);$i++)
                                  {
                                      if(($i>=24)&&($i<=32))
                                      {
                                          ?>
                                          <tr>
                                              <td><input class="chk3-chk3" type="checkbox">
                                                  </input>
                                              </td>
                                              <td class="legendColorBox"><div style="padding:1px">
                                                      <div style="width:4px;height:0;border:5px solid rgb(<?php echo $conf['color'][$i]; ?>);overflow:hidden">

                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="legendLabel">
                                                  <?php echo $conf['toGraff'][$i]; ?>
                                              </td>
                                          </tr>
                                      <?php
                                      }
                                      else {continue ;}
                                  }
                                  ?>
                                  </tbody>
                              </table>

                          </div>
                          <div id="legend4" style="float: left">
                              <table style="font-size: smaller;color: rgb(84, 84, 84);border-collapse: collapse;" ><caption>Gloria</caption>
                                  <thead style="background: #fc0;cellspacing:0"><tr><td><input class="chk4" onclick='chk_chk(".chk4",".chk4-chk4");' type="checkbox"></td><td>цвет</td><td>Название серверов</td></tr></thead>
                                  <tbody>
                                  <?php
                                  for($i=0;$i<count($conf['toGraff']);$i++)
                                  {
                                      if(($i>=33)&&($i<=38))
                                      {
                                          ?>
                                          <tr>
                                              <td><input class="chk4-chk4" type="checkbox">
                                                  </input>
                                              </td>
                                              <td class="legendColorBox"><div style="padding:1px">
                                                      <div style="width:4px;height:0;border:5px solid rgb(<?php echo $conf['color'][$i]; ?>);overflow:hidden">

                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="legendLabel">
                                                  <?php echo $conf['toGraff'][$i]; ?>
                                              </td>
                                          </tr>
                                      <?php
                                      }
                                      else {continue ;}
                                  }
                                  ?>
                                  </tbody>
                              </table>

                          </div>
                        
                          <div id="legend7" style="float: left;display: none"></div>
                          <div style="clear: both ;"></div>
                            <div id="legend5" style="float: left">
                              <table id="table1" style="font-size: smaller;color: rgb(84, 84, 84);border-collapse: collapse;" ><caption>Lionna</caption>
                                  <thead style="background: #fc0;cellspacing:0"><tr><td><input class="chk5" id="chk5" onclick='chk_chk(".chk5",".chk5-chk5");' type="checkbox"></td><td>цвет</td><td>Название серверов</td></tr></thead>
                                  <tbody>
                                  <?php
                                  for($i=0;$i<count($conf['toGraff']);$i++)
                                  {
                                      if(($i>=39)&&($i<=44))
                                      {
                                          ?>
                                          <tr>
                                              <td><input class="chk5-chk5" name="chk5" type="checkbox">
                                                  </input>
                                              </td>
                                              <td class="legendColorBox"><div style="padding:1px">
                                                      <div style="width:4px;height:0;border:5px solid rgb(<?php echo $conf['color'][$i]; ?>);overflow:hidden">

                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="legendLabel">
                                                  <?php echo $conf['toGraff'][$i]; ?>
                                              </td>
                                          </tr>
                                      <?php
                                      }
                                      else {continue ;}
                                  }
                                  ?>
                                  </tbody>
                              </table>

                          </div>
                        <div id="legend6" style="float: left">
                            <table style="font-size: smaller;color: rgb(84, 84, 84);border-collapse: collapse;" ><caption>Legacy</caption>
                                <thead style="    background: #fc0; cellspacing:0;"><tr><td><input class="chk6" onclick='chk_chk(".chk6",".chk6-chk6");' type="checkbox"></td><td>цвет</td><td>Название серверов</td></tr></thead>
                                <tbody>
                                <?php
                                for($i=0;$i<count($conf['toGraff']);$i++)
                                {
                                    if($i>=45&&$i<=50)
                                    {
                                        ?>
                                        <tr>
                                            <td><input class="chk6-chk6" type="checkbox">
                                                </input>
                                            </td>
                                            <td class="legendColorBox"><div style="padding:1px">
                                                    <div style="width:4px;height:0;border:5px solid rgb(<?php echo $conf['color'][$i]; ?>);overflow:hidden">

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="legendLabel">
                                                <?php echo $conf['toGraff'][$i]; ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    else {continue ;}
                                }
                                ?>
                                </tbody>
                            </table>

                        </div>
                        <div id="legend7" style="float: left">
                            <table style="font-size: smaller;color: rgb(84, 84, 84);border-collapse: collapse;" ><caption>Luna</caption>
                                <thead style="    background: #fc0; cellspacing:0;"><tr><td><input class="chk7" onclick='chk_chk(".chk7",".chk7-chk7");' type="checkbox"></td><td>цвет</td><td>Название серверов</td></tr></thead>
                                <tbody>
                                <?php
                                for($i=0;$i<count($conf['toGraff']);$i++)
                                {
                                    if($i>=51&&$i<=59)
                                    {
                                        ?>
                                        <tr>
                                            <td><input class="chk7-chk7" type="checkbox">
                                                </input>
                                            </td>
                                            <td class="legendColorBox"><div style="padding:1px">
                                                    <div style="width:4px;height:0;border:5px solid rgb(<?php echo $conf['color'][$i]; ?>);overflow:hidden">

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="legendLabel">
                                                <?php echo $conf['toGraff'][$i]; ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    else {continue ;}
                                }
                                ?>
                                </tbody>
                            </table>

                        </div>
                        <div id="legend8" style="float: left">
                            <table style="font-size: smaller;color: rgb(84, 84, 84);border-collapse: collapse;" ><caption>Обший показатели</caption>
                                <thead style="    background: #fc0; cellspacing:0;"><tr><td><input class="chk8" onclick='chk_chk(".chk8",".chk8-chk8");' type="checkbox"></td><td>цвет</td><td>Название серверов</td></tr></thead>
                                <tbody>
                                <?php
                                for($i=0;$i<count($conf['toGraff']);$i++)
                                {
                                    if($i>=60&&$i<=62)
                                    {
                                        ?>
                                        <tr>
                                            <td><input class="chk8-chk8" type="checkbox">
                                                </input>
                                            </td>
                                            <td class="legendColorBox"><div style="padding:1px">
                                                    <div style="width:4px;height:0;border:5px solid rgb(<?php echo $conf['color'][$i]; ?>);overflow:hidden">

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="legendLabel">
                                                <?php echo $conf['toGraff'][$i]; ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    else {continue ;}
                                }
                                ?>
                                </tbody>
                            </table>

                        </div>
                        <div style="clear: both ;"></div>
                      </div>
                  </div>

              </div>

          </div>
      </form>

  </div>
   <!-- таблица -->
 
   <div id="ajax_utm_source"></div>
   <div id="ajax_utm_medium"></div>
   <script type="text/javascript"> 
jQuery(function(){ 
  jQuery("#tabs").tabs(); 
}); 
</script> 

<div id="tabs"> 
  <ul> 
    <li><a href="#tabs-1">Elegia</a></li> 
    <li><a href="#tabs-2">Nanna</a></li>
    <li><a href="#tabs-3">Elice</a></li>
    <li><a href="#tabs-4">Libria</a></li> 
    <li><a href="#tabs-5">Gloria</a></li>
    <li><a href="#tabs-6">Lionna</a></li>
    <li><a href="#tabs-7">Legacy</a></li>
    <li><a href="#tabs-8">Luna</a></li>
    <li><a href="#tabs-9">Обший показатель</a></li>
  </ul> 
  <div id="tabs-1"></div> 
  <div id="tabs-2"></div> 
  <div id="tabs-3"></div> 
  <div id="tabs-4"></div> 
  <div id="tabs-5"></div> 
  <div id="tabs-6"></div>
  <div id="tabs-7"></div>
  <div id="tabs-8"></div>
  <div id="tabs-9"></div>
</div> 

 <script language="javascript" type="text/javascript" src="js/main.js"></script>
    </body>
</html>