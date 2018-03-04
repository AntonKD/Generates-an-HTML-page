<!DOCTYPE html>
<html lang="ru">
<head>
        <title>Test task</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">



</head>
<body>
    <?php
$arr =  array(
            array(
                'text'    => "Test1",
                'cells'   => '1,2,3,4',
                'align'   => 'right',
                'valign'  => 'top',
                'color'   => 'red',
                'bgcolor' => 'blue'
                ),
            array(
                'text'    => "Test2",
                'cells'   => '7,8,9',
                'align'   => 'center',
                'valign'  => 'middle',
                'color'   => 'blue',
                'bgcolor' => 'red'
                ),
    );
    function getTable(array $arr){
    // Создаю массив из номеров ячеек
    // ключем cells и тутже его сортирую в порядке возрастания 
        for($i = 0;$i < count($arr);$i++)
        {
            $delimiter =',';
            $arr_cells[] = explode($delimiter, $arr[$i]['cells']);
            sort($arr_cells[$i]);
        }

        $size =3; // Размер Таблицы = $size*$size.

                
        static $k=1;
//Под каждый элемент создаю отдельный массив
        $colspan = array();
        $rowspan = array();
        $width   = array();
        $height  = array();
        $class   = array();
        $color   = array();
        $bgcolor = array();
        $text    = array();
    for($i=1; $i <= $size*$size; $i++)
    {
        $width[] = '100';
        $height[] = '100';
        $colspan[] = '1';
        $rowspan[] = '1';
        $text[] = $i;
    }
//Основной код программы

    for($i=0;$i<count($arr_cells); $i++)
    {
        //запоминая для каждой группы ячеек нужные данные
        $color[$arr_cells[$i][0]-1]   = $arr[$i]['color'];
        $bgcolor[$arr_cells[$i][0]-1] = $arr[$i]['bgcolor'];
        $text[$arr_cells[$i][0]-1]    = $arr[$i]['text'];
        $align[$arr_cells[$i][0]-1]   = $arr[$i]['align'];
        $valign[$arr_cells[$i][0]-1]  = $arr[$i]['valign'];

        $count =count($arr_cells[$i]);
        $row=1;
        for($s= $count-2 ,$j=1;$j<$count,$s >= 0; $j++, $s--)
        {
            $class[$arr_cells[$i][$j]-1] = 'hidden';
            //Устанавливаю число ячеек, которые должны быть объединены по вертикали.
            if(($arr_cells[$i][$count -$j] - $arr_cells[$i][$s]) != 1 )
            {
                $row++;
            } 
        }
        $col =$count/$row;//Устанавливаю число ячеек, которые должны быть объединены по горизонтали
        $colspan[$arr_cells[$i][0]-1] = $col;
        $rowspan[$arr_cells[$i][0]-1] = $row;
        // Проверка того если номера ячеек идут подряд
        for($l=1;$l<$count;$l++)
	{
            if((max($arr_cells[$i])-min($arr_cells[$i])) == $l*$size-1)
            {
		$rowspan[$arr_cells[$i][0]-1] = $count/$size;
		$colspan[$arr_cells[$i][0]-1] = $size; 
            }
	}
        // КОНЕЦ Проверки того если номера ячеек идут подряд
    }

 ?>  
    
    
    
<div class=" container-fluid">
    <div class=" row">
        <div class=" col-lg-<?php echo$size?>">
            <table class="table table-bordered">
                <?php for($i=0;$i<$size;$i++)
                        {?>
                <tr>
                    <?php  for($j=0;$j<$size;$j++,$k++){ ?>
                    <td colspan="<?php echo $colspan[$k-1]?>" 
                        rowspan="<?php echo $rowspan[$k-1]?>"  
                        class="<?php echo $class[$k-1]?>"  
                        style="
                                width: <?php echo $colspan[$k-1]*$width[$k-1].'px';?>; 
                                height: <?php echo $rowspan[$k-1]*$height[$k-1].'px';?>; 
                                background: <?php echo $bgcolor[$k-1]?>; 
                                color: <?php echo $color[$k-1]?>; 
                                text-align: <?php echo $align[$k-1]?>; 
                                vertical-align: <?php echo $valign[$k-1]?>; 
                                ">
                    <?php echo $text[$k-1];?></td>
                                                <?php }?>
                </tr>
                <?php  }?>
            </table>
        </div>
    </div>
</div>
    
<?php }?>
    
    <?php getTable($arr); ?><!-- Вызов функции getTable($arr)-->    
</body>
</html>
