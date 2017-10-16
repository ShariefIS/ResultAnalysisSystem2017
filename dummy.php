<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $con= mysqli_connect("localhost","root","","ras2017");
        if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
        }?>
         <?php $sq1="SELECT  sem FROM `student_list` where rno=160414737040";
                $res1= mysqli_query($con, $sq1);?>
         <?php while ($row = mysqli_fetch_assoc($res1)): ?>
                  <?php $v1= $row["sem"];?>
                    <?php endwhile;?>
     <?php $sq="SELECT  year FROM `student_list` where rno=160414737040";
                $res= mysqli_query($con, $sq);?>
         <?php while ($row = mysqli_fetch_assoc($res)): ?>
                  <?php $v2= $row["year"];?>
                    <?php endwhile;?>   
    <?php echo $v1 ;
    echo $v2 ;?>
    
    </body>
</html>
