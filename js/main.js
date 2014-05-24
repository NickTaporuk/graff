/**
 * выезжающий див слева на право
 * css
 * .myClass {
width: 600px;
height: 150px;
margin-top: 20px;
background: #c4fdc7;
border: 2px solid #2d8440;
position: absolute;
top: 200px;
left: -620px;
}
 <div class="myClass" style="left: -620px;"></div>
 */
$(document).ready(function(){
    $('#btn').toggle(
        function(){
            $('.myClass').animate({'left':'200'},400);
$(this).val('Cкрыть блок');
},
function(){
    $('.myClass').animate({'left':'-620'},400);
$(this).val('Показать блок');
});
});/*end  ready*/
    /*
    * посчёт false чекетов и переброс на серверную часть
    * */
    function check(redrawTable,numberPage)
    {
//        jQuery.noConflict();
        var i = 0 ;
        var j = 0 ;
        var arr=[];
        jQuery('.chk-chk').prop('checked', function(el, oldVal){

            if(oldVal==false) { ++j;arr[j]=i ;}
            ++i;
        });
        jQuery('.chk1-chk1').prop('checked', function(el, oldVal){

            if(oldVal==false) {++j;arr[j]=i ;}
            ++i;
        });
        jQuery('.chk2-chk2').prop('checked', function(el, oldVal){

            if(oldVal==false) {++j; arr[j]=i ;}
            ++i;
        });
        jQuery('.chk3-chk3').prop('checked', function(el, oldVal){
            if(oldVal==false) {++j;arr[j]=i ;}
            ++i;

        });
        jQuery('.chk4-chk4').prop('checked', function(el, oldVal){
            if(oldVal==false) {++j;arr[j]=i ;}
            ++i;
        });
        jQuery('.chk5-chk5').prop('checked', function(el, oldVal){
            if(oldVal==false) {++j;arr[j]=i ;}
            ++i;
        });
        jQuery('.chk6-chk6').prop('checked', function(el, oldVal){
            if(oldVal==false) {++j;arr[j]=i;}
            ++i;
        });
        jQuery('.chk7-chk7').prop('checked', function(el, oldVal){
            if(oldVal==false) {++j;arr[j]=i;}
            ++i;
        });
        jQuery('.chk8-chk8').prop('checked', function(el, oldVal){
            if(oldVal==false) {++j;arr[j]=i;}
            ++i;
        });
        arr.splice(0,1);
//работа с фитьтрами
        var utm_s = jQuery('.utm_source').val();
        var utm_m = jQuery('.utm_medium').val();

//работа с датами
        var start_date = '15.06.2013' ;
        var first_date = jQuery('.first-data').val()?jQuery('.first-data').val(): start_date ;
        var end_date = jQuery('.last-data').val()?jQuery('.last-data').val(): moment().format("DD.MM.YYYY") ;
        var mom = moment(first_date,"DD.MM.YYYY").format("YYYY/MM/DD");
        var mom1 = moment(end_date,"DD.MM.YYYY").format("YYYY/MM/DD");
        mom1 = moment(mom1).add('days',1);
        mom1 = moment(mom1,"MM/DD/YYYY").format("YYYY/MM/DD");

        jQuery.ajax({
               beforeSend: function(){
// Действия, которые будут выполнены перед выполнением этого ajax-запроса
               jQuery('#placeholder').html('<div id="img_loader"><img src="img/476.gif"><h1>Идёт загрузка... </h1></img></div>');
               jQuery('#img_loader').css({
                            position: "absolute",
                            display: "none",
                            width:"300px",
                            height:"200px",
                            top: "33%",
                            left: "43%",
                            opacity: 0.80
                        }).appendTo("body").fadeIn(200);
               jQuery('#overview').hide();
               },
            type: "POST",
            url:"php/ajax.php",
            data:"first="+ first_date+'&end_date='+end_date+"&json="+ arr +'&utm_s='+utm_s+'&utm_m='+utm_m,
            success:function(res){
                jQuery('#overview').show();
                jQuery('#img_loader').remove();

                if(res){
                    try {
                        var object = jQuery.parseJSON(res);
                    }
                    catch ( e ) {
                        alert( " ERROR: " + e );
                    }
                    
                    var all_data = object;
//                    alert(res);
//работа с таб навигатором          
var string =[], string1 =[];var string2 =[];var string3 =[];var string4 =[];var string5 =[];var string6 =[];var string7 =[];var string8 =[];
var q=0;var w=0;var e=0;var r=0;var t=0;var y=0;var u=0;var i=0;var o=0;var p=0;
        for(var i=0;i<all_data.length;i++)
        {
            //elegia
            if(all_data[i]['color']<=8)
                {
                    string[i] =all_data[i];
                }
            //nanna    
            if(all_data[i]['color']>8 && all_data[i]['color']<=14)
                {
                    string1[q]=(all_data[i]);q++;
                }
            //elice
            if(all_data[i]['color']>14 && all_data[i]['color']<=23)
                {
                    string2[w] = (all_data[i]);w++;
                }
            //libria    
            if(all_data[i]['color']>23 && all_data[i]['color']<=32)
                {
                    string3[e] = (all_data[i]);e++;
                }
            //gloria    
            if(all_data[i]['color']>32 && all_data[i]['color']<=38)
                {
                    string4[r] = (all_data[i]);r++;
                }
            //lionna    
            if(all_data[i]['color']>38 && all_data[i]['color']<=44)
                {
                    string5[t] = (all_data[i]);t++;
                }
            //legacy    
            if(all_data[i]['color']>44 && all_data[i]['color']<=50)
                {
                    string6[y] = (all_data[i]);y++;
                }
            //luna    
            if(all_data[i]['color']>50 && all_data[i]['color']<=59)
                {
                    string7[u] = (all_data[i]);u++;
                }
            //общий показатель
            if(all_data[i]['color']>59 && all_data[i]['color']<=62)
                {
                    string8[o] = (all_data[i]);o++;
                }
        }
//===================================================================================================================            
        if(redrawTable==='#tabs-1')
            {
                insert_table('#tabs-1',string,8,8,numberPage);    
            } else insert_table('#tabs-1',string,8,8);
        if(redrawTable==='#tabs-2')
            {
                insert_table('#tabs-2',string1,14,5,numberPage);
            } else insert_table('#tabs-2',string1,14,5);
        if(redrawTable==='#tabs-3')
            {
                insert_table('#tabs-3',string2,23,8,numberPage);
            } else insert_table('#tabs-3',string2,23,8);
        if(redrawTable==='#tabs-4')
            {
                insert_table('#tabs-4',string3,32,8,numberPage);
            } else insert_table('#tabs-4',string3,32,8);
        if(redrawTable==='#tabs-5')
            {
                insert_table('#tabs-5',string4,38,5,numberPage);
            } else insert_table('#tabs-5',string4,38,5);
        if(redrawTable==='#tabs-6')
            {
                insert_table('#tabs-6',string5,44,5,numberPage);
            } else insert_table('#tabs-6',string5,44,5);
        if(redrawTable==='#tabs-7')
            {
                insert_table('#tabs-7',string6,50,5,numberPage);
            } else insert_table('#tabs-7',string6,50,5);
        if(redrawTable==='#tabs-8')
            {
                insert_table('#tabs-8',string7,59,8,numberPage);
            } else insert_table('#tabs-8',string7,59,8);
        if(redrawTable==='#tabs-9')
            {
                insert_table('#tabs-9',string8,62,2,numberPage);
            } else insert_table('#tabs-9',string8,62,2);
 
//===================================================================================================================    
                    // выделенная область
                    var today = new Date();
                    var selection = [mom, mom1];
                    // все данные
                    // цвета задавать обязательно, иначе они будут все время меняться при удалении/добавлении рядов
                    // какие данные скрываем - заполняем позже
                    var hide = [];
                    for(var j = 0; j < all_data.length; ++j) {
                        hide.push(false); // не скрываем j-ый ряд. пока что.
                        for(var i = 0; i < all_data[j].data.length; ++i){
                            all_data[j].data[i][0] = Date.parse(all_data[j].data[i][0]);
                        }
                    }
                    for(var i = 0; i < selection.length; ++i)
                        selection[i] = Date.parse(selection[i]);

                    var overview; // "обзор" всех данных внизу страницы
                    var plot; // график крупным планом
                    var show_bars = false; // показывать столбики или линии
                    var plot_conf = {
                        series: {
                            stack: null,
                            lines: {
                                show: true,
                                lineWidth: 2,
//                                fill: true,
//                                steps: true
                            },
                            /*bars:{
                                show: true
                               // barWidth: 5 ,
                                //align:  "center",
                                 //horizontal: true
                            },*/
                            points:{show:true}
                        },
                        xaxis: {
                            mode: "time",
                            timeformat: "%d %b %Y",
                            monthNames: ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"],
                            min: selection[0],
                            max: selection[1]
                        },

                        grid: {
                            backgroundColor: '#5a5a5a',
                            tickColor: "#dddddd",
                            borderWidth:2,
                            hoverable:true,
                            clickable:true,
                            autoHighlight: true,
                            mouseActiveRadius: 10
                        },
                        legend: {
                            container: jQuery("#legend7")
                        }
                    };

                    var overview_conf = {
                        series: {
                            lines: {
                                show: true,
                                lineWidth: 1
                            },
                            shadowSize: 1
                        },
                        xaxis: {
                            ticks: []
                        },
                        yaxis: {
                            ticks: []
                        },
                        selection: {
                            mode: "x"
                        },
                        legend: {
                            show: false
                        }
                    };

                    // меняем вид - столбики или линии
                    function switch_show() {
                        show_bars = !show_bars; // изменяем тип диаграм

                        var new_conf = {
                            series: {
                                stack: show_bars ? true : null,
                                lines: { show: !show_bars },
                                bars: { show: show_bars }
                            }
                        };

                        // обновляем конфиг
                        $.extend(true, plot_conf, new_conf);
                        $.extend(true, overview_conf, new_conf);

                        // перерисовываем
                        redraw();
                    }

                    // перерисовываем все и вся
                    function redraw() {
                        var data = [];
                        for(var j = 0; j < all_data.length; ++j)
                            if(!hide[j])
                                data.push(all_data[j]);
//                              console.log(all_data[j]);

                        plot = jQuery.plot(jQuery("#placeholder"), data, plot_conf);
                        overview = jQuery.plot(jQuery("#overview"), data, overview_conf);

                        // легенду рисуем только один раз
                        plot_conf.legend.show = false;

                        // последний аргумент - чтобы избежать рекурсии
                        overview.setSelection({ x1: selection[0], x2: selection[1] }, true);
                    }

                    // вычисляем ширину колонки в соответствии с новой областью выделения
                    function calc_bar_width() {
                        // поскольку по оси OX откладывается время,
                        // ширина столбцов в гистограмме вычисляется в 1/1000-ых секунды
                        // при масштабировании эту величину следует пересчитать
                        var r = plot_conf.xaxis;
                        // вычисляем, сколько столбцов попало в интервал
                        var bars_count = 0;
                        for(var i = 0; i < all_data[0].data.length; ++i)
                            if(all_data[0].data[i][0] >= r.min &&
                                all_data[0].data[i][0] <= r.max)
                                bars_count++;

                        // изменяем ширину столбцов
                        var new_conf = {
                            series: {
                                bars: { // умножаем на два, чтобы оставалось место между столбцами
                                    barWidth: (r.max - r.min)/((bars_count + 1 /* на ноль не делим */) * 2)
                                }
                            }
                        };
                        $.extend(true, plot_conf, new_conf);
                    }

                    // вычисляем ширину столбцов в гистограмме
                    calc_bar_width();
                    // рисуем графики в первый раз
                    redraw();

                    // событие - новое выделение на overview
                    jQuery("#overview").bind("plotselected", function (event, ranges) {
                        var r = ranges.xaxis;
                        // сохраняем координаты выделенной области
                        selection = [r.from, r.to];

                        // перемещаем обзор в новую область
                        var new_conf = {
                            xaxis: {
                                min: r.from,
                                max: r.to
                            }
                        };
                        $.extend(true, plot_conf, new_conf);

                        calc_bar_width();
                        redraw();
                    });

                    function showTooltip( x, y, contents) {
//                        if(jQuery('#tooltip').width()<100)
//                            { console.log('guyjgui');}
//                        else
//                        {
                        jQuery("<div id='tooltip'>" + contents + "</div>").css({
                            position: "absolute",
                            display: "none",
                            top: y + 5,
                            left: x+5,
                            border: "1px solid #fdd",
                            padding: "2px",
                            "background-color": "#fee",
                            opacity: 0.80
                        }).appendTo("body").fadeIn(200);
                        jQuery('#tooltip').mousemove(function (e){
                           // console.log('e.pageX');
                        });
//                        alert(jQuery(window).width()+'----'+jQuery('#tooltip').width());
//                            var wind=jQuery(window).width();
//                            var tool=jQuery('#tooltip').width();
//                            alert(wind-1);
////                        }
                    }

                    jQuery("#placeholder").bind("plothover",function(event,pos,item){
                        $("#tooltip").remove();
                        if(item)
                        {
                            var x = item.datapoint[0].toFixed(2),  y = item.datapoint[1].toFixed(2);
                            var time = new Date((x*10)/10);
                            showTooltip( item.pageX, item.pageY ,'Сервер : '+item.series.label +' дата : '+time.toLocaleDateString('ru')+ "  количество переходов : " + y);
                        }
                    });

                    jQuery("#placeholder").bind("plotclick",function(event,pos,item){
                        if(item)
                        {
                            //если нужна работа с кликом
//                            alert("item no" +item.dataIndex+" in "+item.datapoint[1]+" y " + item.series.label + " clicked");
//                            plot.highlight(item.series,item.datapoint);
                        }
                    });


                }
            }
        });


    }
//===================================================================================================================        
    /*
    * работа с чекетами
    * */
	function chk_chk(name_hight_checked,name_checked)
    {
        if(jQuery(name_hight_checked).prop('checked'))
        {
            jQuery(name_checked).each(function(){
                this.checked = true ;
                });
        }
        else
        {
            jQuery(name_checked).each(function(){
                this.checked = false ;
                });
        }
    }    
//===================================================================================================================    
    function lookup1(inputString)
    {
        if(inputString.length == 0)
        {
            jQuery('#ajax_utm_medium').fadeOut(); // Скрываем поле предложений
        }
        else
        {
             jQuery.post("php/ajax.php", {input_utm_medium: ""+inputString+""}, function(data) { // Выполняем запрос AJAX
             if(data==0)
                 {
                     jQuery('#ajax_utm_medium').fadeIn(); // Выводим поле предложений
                     jQuery('#ajax_utm_medium').html('Нет данных по вашему запросу');
//                 alert(data);
                 }
             else
             {
             jQuery('#ajax_utm_medium').fadeIn(); // Выводим поле предложений
             jQuery('#ajax_utm_medium').html(data); // Заполняем поле предложений

             jQuery( ".select1" ).bind( "click", function(){
                 jQuery('.utm_medium').val(jQuery(this).html());
                     jQuery('#ajax_utm_medium').fadeOut();
                 });
             }
             });

        }
    }
//===================================================================================================================    
    function lookup(inputString)
    {
        if(inputString.length == 0)
        {
            jQuery('#ajax_utm_source').fadeOut(); // Скрываем поле предложений
        }
        else
        {
            jQuery.post("php/ajax.php", {queryString: ""+inputString+""}, function(data) { // Выполняем запрос AJAX
                if(data==0)
                 {
                     jQuery('#ajax_utm_source').fadeIn(); // Выводим поле предложений
                     jQuery('#ajax_utm_source').html('Нет данных по вашему запросу');
                 }
             else
             {
                jQuery('#ajax_utm_source').fadeIn(); // Выводим поле предложений
                jQuery('#ajax_utm_source').html(data); // Заполняем поле предложений

                jQuery( ".select" ).bind( "click", function(){
                    jQuery('.utm_source').val(jQuery(this).html());
                    jQuery('#ajax_utm_source').fadeOut();
                });
             }
            });

        }
    }   
    jQuery('.utm_source').focusout(function(){
        jQuery('#ajax_utm_source').fadeOut();
    });
    jQuery('.utm_medium').focusout(function(){
        jQuery('#ajax_utm_medium').fadeOut();
    });
//===================================================================================================================     
//datapicker
    jQuery(document).ready(function() {
        jQuery.datepicker.setDefaults(
        jQuery.extend($.datepicker.regional["ru"])
        );
        var today = new Date()
        jQuery('.first-data').datepicker({showButtonPanel:true,maxDate:today,minDate:'15.06.2013',showAnim:'show'});
        jQuery('.last-data').datepicker({showButtonPanel:true,maxDate:today,minDate:'15.06.2013',showAnim:'show'});
      });
//===================================================================================================================          
function insert_table(name_jquery,arr,max,step,numberToPage)
{
if(!numberToPage){numberToPage=1}    
var step_page=31;    
var page =step_page*numberToPage;
var prePage=page-step_page;
var first = '<tr>';
var end = '</tr>';
var c='';
var d='';
//массив заголовка таблицы

if(name_jquery=='#tabs-9')
    {
       var th=[
            '<th>Всего регистраций</th>',
            '<th>Уникальных регистраций</th>',
            '<th>Всего активаций</th>',
        ];
    }
    else  th=[
    '<th>Обшее количество посешений</th>',
    '<th>Обшее количество регистраций</th>',
    '<th>Уникальные регистраций</th>',
    '<th>Промо регистраций</th>',
    '<th>Уникальные промо регистрации</th>',
    '<th>Введёные монеты</th>',
    '<th>Преимиум аккаунты 3 дня</th>',
    '<th>Преимиум аккаунты 7 дней</th>',
    '<th>Преимиум аккаунты 30 дней</th>'];

//работа с таблицей
var f ='<div id="grid" ><table id="table" ><thead><tr><th>№строки</th><th>Дата</th>';
var g='</tr></thead><tbody>';
var h='</tbody></table></div>';
var all_count=0,z='<td id="sum">Итого :</td><td id="sum">за выбранный период дат</td>';
var j='';
//работа с пагинатором
var pagination ='<div id="pagination">Страница : </div>', col_page=0,x='',b='';
if(arr!=0) {
    col_page=arr[0].data.length/step_page;
    for(var j=0;j<Math.ceil(col_page);j++)
     {
         if(j==(numberToPage-1)){x+='<div id="page-activ" onclick="check('+'&#39;'+name_jquery+'&#39;'+','+(j+1)+');">' + (j+1) + '</div>' ;}
         else x+='<div id="page" onclick="check('+'&#39;'+name_jquery+'&#39;'+','+(j+1)+');">' + (j+1) + '</div>' ;
     }
     b = pagination+x+'<div style="clear:both"></div>';
    for(var j=0;j<arr.length;j++)
     {  
         f+=th[Math.abs((max-arr[j]['color'])-step)];
         for(var c= 0;c<arr[0].data.length;c++)
        {
            all_count+=1*arr[j].data[c][1];
        }
        z+='<td id="sum">' + all_count+'</td>';
        all_count=0;
     }
    for(var i = 0;i<arr[0].data.length;i++)
    {
        if(i>=prePage&&i<page)
            {
        c = '<td>'+(i+1)+'.'+'</td>';
        c+='<td>'+arr[0].data[i][0]+'</td>';
        for(var j=0;j<arr.length;j++)
        {
            c+='<td>'+arr[j].data[i][1]+'</td>';
        }
       d+=first+c+end;
            }
            else  continue;
    }
    j=f+g+d+z+h+b;
    jQuery(name_jquery).html(j);
}
else jQuery(name_jquery).html('Нет данных');
}
