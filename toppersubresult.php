
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>MJCET RAS2017</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />

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
         <li class="menuLink"><a href="toppersubform.php" class="testimonial">Select Another Subject</a></li>
        
  </ul>
</div>

<div id="bodyMain">
<div id="body">
<div id="right">

<center>
<h3>IT Result Analysis System 2017</h3>
</center>
 <?php
        $v1=$_POST["year"];
        $v2=$_POST["sem"];
        $v3=$_POST["sec"];
        $v4=$_POST["subject"];
        $v5=$_POST["top"];
        
?>
<?php
        $con1= mysqli_connect("localhost","root","","ras2017");
        if (!$con1) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sql1="SELECT sname FROM `subjects` WHERE scode=$v4";
        $res= mysqli_query($con1, $sql1);
?>
    
<form style="overflow:hidden;"><input style="float:right;clear:both; margin-right: 100px;" type="button" value=" Print this page "
onclick="window.print();return false;" /></form>        
    
<table class="component"  border="3">
  <tr>
      <th align="center" colspan="8">OU Subject Wise Topper March-2017 Results</th>
  </tr>
  <tr>
      <th>Subject : </th>
      <?php while ($row = mysqli_fetch_assoc($res)): ?>
      <?php echo "<td colspan=\"2\" align=\"center\">{$row["sname"]}</td>"?>
       <?php endwhile;?>
      <?php
       $s="SELECT bitcode FROM `subjects` WHERE scode=$v4";
        $r= mysqli_query($con1, $s);
        ?>
      <th>BIT CODE : </th>
      <?php while ($row = mysqli_fetch_assoc($r)): ?>
      <?php echo "<td align=\"center\">{$row["bitcode"]}</td>"?>
       <?php endwhile;?>
      <?php
       $s1="SELECT bitcode,stype FROM `subjects` WHERE scode=$v4";
        $r1= mysqli_query($con1, $s1);
        ?>
      <th>Subject Type :</th>
      <?php while ($row = mysqli_fetch_assoc($r1)): ?>
      <?php echo "<td colspan=\"2\" align=\"center\">{$row["stype"]}</td>"?>
       <?php endwhile;?>
      
  </tr>
  <tr>
    <th>Class :</th>
    <td colspan="2" align="center">B . E  ( <?php echo htmlspecialchars($_POST["year"]);?> / 4 )  I T D </td>
    <th>Section: </th>
    <td align="center" >'<?php echo htmlspecialchars($_POST["sec"]);?>'</td>
    <th>Semester : </th>
    <td align="center" colspan="2"><?php echo htmlspecialchars($_POST["sem"]);?></td>
  </tr>
  <tr>
      <th>S.no</th>
      <th>Section</th>
       <th>Roll Number</th>
        <th>Student Name</th>
         <th>Internal Marks</th>
          <th>External Marks</th>
           <th>Total Marks</th>
            <th>Result</th>
  </tr>
   <?php
        $con= mysqli_connect("localhost","root","","ras2017");
        if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $sql="SELECT student_list.rno as rno ,section , name, emarks, imarks, IFNULL(emarks,0)+imarks as total, sresult
            FROM marks_info_it,student_list
            WHERE scode=$v4 
            AND marks_info_it.rno in (select rno from student_list where section in ('$v3') and year=$v1)
            AND student_list.rno=marks_info_it.rno
            ORDER BY total DESC LIMIT $v5"; 
        $result= mysqli_query($con, $sql);
        $i=1;
        ?>
  
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <?php echo "
    </tr>
    <td align=\"center\">{$i}</td>
    <td align=\"center\">{$row["section"]}</td>
    <td>{$row["rno"]}</td>
    <td >{$row["name"]}</td>
    <td align=\"center\">{$row["imarks"]}</td>
    <td align=\"center\">{$row["emarks"]}</td>
    <td align=\"center\">{$row["total"]}</td>
    <td>{$row["sresult"]}</td>
    </tr>";
    ?>
    <?php $i++ ?>
    <?php endwhile;?>
  
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
