
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>MJCET RAS2017</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/jquerycssmenu.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript"  src="js/jquerycssmenu.js"></script>
<link rel="stylesheet" href="menu.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/ss/s3Slider.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="js/ss/ssstyle.css" rel="stylesheet" type="text/css" />
<link href="news/news.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="mainmenu">
<ul id="menu">
</ul>
</div>
<div id="topmain">
  <div id="top">    <img src="images/logo.png" alt="Muffakham Jah College of Engineering and Technology" border="0" class="logo" title="Muffakham Jah College of Engineering and Technology" /> </div>
  <ul class="menu">
        <li class="menuLink"><a href="http://www.mjcollege.ac.in" target="_self" class="testimonial">MJCET Home</a></li>
        <li class="menuLink"><a href="index.php" class="testimonial">HOME</a></li>
        
        
        
        
  </ul>
</div>

<div id="bodyMain">
<div id="body">
<div id="right">

<center>
<h3>Result Analysis System 2017</h3>
</center>
<?php
        $v1=$_POST["year"];
        $v2=$_POST["sem"];
        $v3=$_POST["sec"];
        ?>
       
         <br>
             <form style="overflow:hidden;"><input style="float:right;clear:both; margin-right: 100px;" type="button" value=" Print this page "
onclick="window.print();return false;" /></form> 
        <table align="center" border="3">
  <tr>
      <th align="center"colspan="7">OU Class Wise Result Analysis March 2017</th>
  </tr>
  
    <tr>
      <th >Class :</th>
    <td  align="center">B . E  ( <?php echo htmlspecialchars($_POST["year"]);?> / 4 )  I T D </td>
    <th>Section: </th>
     <td align="center"> <?php echo htmlspecialchars($_POST["sec"]);?></td>
  
    <th>Sem: </th>
    <td align="center"><?php echo htmlspecialchars($_POST["sem"]);?></td>
  </tr>
  <tr>
      <th>S.no</th>
      <th colspan="3">Result</th>
      <th colspan="2">Total Number Students</th>
  </tr>
        <?php
        $con= mysqli_connect("localhost","root","","ras2017");
        if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sql="select sresult, count(sresult)as res
                from results_info_it
                where rno in (select rno from student_list where section in ('$v3') and year=$v1)
                and year=$v1 and sem=$v2
                group by sresult
                having sresult in ('PASSED','FAILED','ABSENT')"; 
        $result= mysqli_query($con, $sql);
        $i=1;
        
    ?>
    
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <?php 
     echo 
        "<tr>
        <td align=\"center\">{$i}</td>
        <td colspan=\"3\" align=\"center\">{$row["sresult"]}</td>
        <td colspan=\"3\" align=\"center\">{$row["res"]}</td>
        </tr>";
    ?>
    <?php $i++ ?>
    <?php endwhile;?>
  <tr>
      <th>Total Students</th>
   <?php
        $con= mysqli_connect("localhost","root","","ras2017");
        if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sq1="select count(rno)as count from student_list where year=$v1 and sem=$v2 and section in ('$v3')"; 
        $rs1= mysqli_query($con, $sq1);
        $i=1;   
    ?>
   <?php while ($row = mysqli_fetch_assoc($rs1)): ?>
    <?php  echo"<td align=\"center\">{$row["count"]}</td>";?>
    <?php $i++ ?>
    <?php endwhile;?>   
      
      <th>Passed Percentage :</th>
      <?php
        $con= mysqli_connect("localhost","root","","ras2017");
        if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sp="select  round((count(sresult)/count)*100,2) as res
                from (select count(rno)as count from student_list where year=$v1 and sem=$v2 and section in ('$v3')) as TAB,results_info_it
                where rno in (select rno from student_list where section in ('$v3') and year=$v1 )
                and year=$v1 and sem=$v2
                group by sresult
                having sresult in ('PASSED')"; 
        $rp= mysqli_query($con, $sp);
        $i=1;   
    ?>
   <?php while ($row = mysqli_fetch_assoc($rp)): ?>
    <?php  echo"<td align=\"center\">{$row["res"]} % </td>";?>
    <?php $i++ ?>
    <?php endwhile;?>  
      
      <th>Failed Percentage :</th>
      <?php
        $con= mysqli_connect("localhost","root","","ras2017");
        if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sf="select  round((count(sresult)/count)*100,2) as res
                from (select count(rno)as count from student_list where year=$v1 and sem=$v2 and section in ('$v3')) as TAB,results_info_it
                where rno in (select rno from student_list where section in ('$v3') and year=$v1)
                and year=$v1 and sem=$v2
                group by sresult
                having sresult in ('FAILED','ABSENT')"; 
        $rf= mysqli_query($con, $sf);
        $i=1;   
    ?>
   <?php while ($row = mysqli_fetch_assoc($rf)): ?>
    <?php  echo"<td align=\"center\">{$row["res"]} % </td>";?>
    <?php $i++ ?>
    <?php endwhile;?>  
      
  </tr>
  
        </table>
<form style="overflow:hidden;"><input style="float:right;clear:both; margin-right: 100px;" type="button" value=" Print this page "
onclick="window.print();return false;" /></form> 
</div>
<br class="spacer" />
</div>

<br class="spacer" />
</div>

<div id="footerMain">
  <div id="footer">
    <p class="copyright">Muffakham Jah College of Engineering and Technology, Copyright ©   2017. All Rights Reserved.</p>
   <p class="design">&nbsp;</p>
  </div>
</div>
</body>
</html>
