<?php
session_start();
require("site-settings.php");
$type="Week";
$id="parliament";
$minp=1;
$maxp=1;
$title="Youth Parliament";
	if(1==1){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Republica</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/jquery.min.js" type="text/javascript"></script>

	<script type="text/javascript" src='codebase/message.js'></script>
	<link rel="stylesheet" type="text/css" href="codebase/themes/message_default.css" title="Default">
    <!-- Fontawesome core CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- custom CSS here -->
    <link href="css/style1.css" rel="stylesheet" />

      <script type="text/javascript">
    function shwfi(val)
    {
	var str="";
	if(val<1 || document.getElementById("prathap")==undefined){return false;}
	
	for(var i=1;i<=val;i++)
	{
	str=str+"<div class='form-group input-group'><input type='text' class='form-control' maxlength='7' placeholder='ex : N130950' id='stuid"+i+"'/>";
str=str+"<span class='input-group-btn'><button class='btn btn-default' type='button'><i class='fa fa-info-circle'></i>&nbsp;&nbsp;Student "+i+" ID</button></span></div>";
}
str=str+"<div class='form-group input-group'><input type='button' class='btn btn-primary'  onclick=doreg('"+val+"') value='Register'></div>";
document.getElementById("prathap").innerHTML=str;
 }
 
 function notify(msg,cat,time,modal)
{
}
 
 function pick1(iid){
		return document.getElementById(iid).value; 
	 }
notify("Please Enter University ID","error","2000","true");
 
 function doreg(part)
{
var eid="<?php echo $id;?>";
var k,ids="",valid=0;
for(var i=1;i<=part;i++)
{
if(pick1("stuid"+i)=="" || pick1("stuid"+i)==undefined)
{
dhtmlx.alert({type:"alert-error", title:"Enter University ID", text:"Please Enter University ID "+i+""});
break;	
}
else
{
if(i==part){
	k=pick1("stuid"+i);
	k=k.toUpperCase();
	ids=ids+k;}
else{
	
	k=pick1("stuid"+i);
	k=k.toUpperCase();
	ids=ids+k+"~";}	
valid++;
}	
}

if(part==valid){

//confirmation
		if(confirm("Are you sure to Register?")) {
			
					
var datastring="eid="+eid+"&part="+part+"&ids="+ids+"&type="+"<?php echo $type;?>";
$.ajax({
type:"POST",
url:"eventreg-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){$("#loader").show();},
success:function(data){$("#loader").hide();if(data.indexOf("success")!=-1){dhtmlx.alert({type:"alert-success", title:"Registered", text:"Registered Successfully."});setTimeout(function(){location.reload();},1500);}else{dhtmlx.alert({type:"alert-error", title:"Failure", text:data});}}
});

					
				} else {
					return false;
				}
		
	
}	
}
    </script>
  
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SDCAC</a>
            </div>
            <!-- Collect the nav links for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
				
                <ul class="nav navbar-nav">
                    <li><a href="#"><strong>Participants : </strong><?php echo $minp; if($minp!=$maxp){?>- <?php echo $maxp;?><?php } ?></a>
                    </li>
				</ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!--jumbotron-->
    <div class="jumbotron  text-center ">
        <br><a href="#" >&nbsp;<span class="font-big color-red"> <?php echo $title;?></span></a>
        <br>
        <p>The Mock Parliament Club is a unique event being conducted by the SDCAC. <br>
The aim of the event is to conduct the Indian Parliamentary Sessions in the form of a competition. 
This would help students to learn the functioning of the Indian Parliament which would in turn help 
them become great leaders of the future. 
This would get students exposed to real life situations. 
The club also aims at bringing out the ideas (of the youth) on various matters related to different fields of engineering, technology etc. 
This would help our students shape their ideas into reality and flourish in their respective fields of interest.
This year The Mock Indian Parliament is conducted for students as a part of the republica2k18 celebrations.
<br><br>
<b><u>Instructions for Round 1:</u></b><br>
To be a part of this session there is a screening round for the students in the form of a elocution.<br>
Mode of language is <b>English</b><br>

Elocution will be on the spot topic. <br>

Each student will given 3min time to complete his speech warning note will be given at last 30 sec so that he/she
should complete his speech.<br>

The best speakers will be further promoted to the prestigious event of mock parliament.
<br><br>
<b><u>Instructions:</u></b><br>

The youth parliament is a resemblance of the original parliementary session.<br>

So the conduct and decoram of the same session is insisted here.<br>

The Significance and the diction and the style of parliament should be followed by the participants selected in the 
preliminary round.<br>

The participants selected should be in the position of a politicians and should behave as per the political perspective.
<br>
Judges decision will be final.<br>
</p>
    </div>
    <!--End jumbotron-->
    <div class="container">
        
        <div class="row ">
	</p><br>
      

     	
		<div class="col-md-5">
   
   <?php 
   if($minp!=$maxp){
   echo "<select>";
   for($i=$minp;$i<=$maxp;$i++){
   echo "<option value='".$i."'>".$i."</option>";
   }
   echo "</select>";
   }?>
			<!--<h3 style='color:red;'>Registrations are closed</h3>-->
     <div id="loader" style="display:none;"><img src="loading8.gif"></div>
     <div id="prathap"></div>
			<br />
</div>
<div class="col-md-7">
 <div class="jumbotron  text-center ">
 	<div>
 		<script type="text/javascript">
function shw(prathap){

	$("#front").slideUp();
	$("#junior").slideUp();
	$("#senior").slideUp();
	$("#"+prathap).slideDown();
}
</script>
<a onclick="shw('junior')" style="cursor:pointer;text-decoration:none;padding:10px;border-radius:15px;width:300px;background:green;">Click here for Registered Teams</a>
        <br><br>
            <div id="junior" style="height:217px;display:none;word-wrap:break-word;width:550px;overflow-x:hidden;">
                 <?php
//teams
     echo "<center>";
	$kt=mysql_query("SELECT * FROM users WHERE eid='$id'") or die(mysql_error());
	echo "<table border=1 cellpadding='30' style='text-align:center;'><tr>";
    $jun=0;
	if(mysql_num_rows($kt)>0)
	{
	    $kkg=0;
	    $tidd=0;
	while($fkt=mysql_fetch_array($kt))
		{
			$jun++;
			$tidd++;
		$mt=array();
		$mt=$fkt['ids'];
		$super=explode("~",$mt);
		
		if($kkg%7==0)
			echo "</tr><td style='background-color:white'>";
		else
			echo "<td style='background-color:white'>";
		$kkg++;
		$colors=array("660066","990000","6600CC","9900CC","FF0000","FF00CC","CC00CC","003399","006600");
		shuffle($colors);
		echo "&nbsp;<u><b><FONT COLOR=YELLOW style='background-color:black;'>Team : ".$tidd."</FONT></u></B><br>";
                $keka=count($super);
		for($y=0;$y<$keka;$y++)
			echo "<font color=".$colors[0].">".$super[$y]."</font><br>";
		}
		echo "</td>";
		
		
	}
	else
		echo "<center><span class='' style='color:red;'>No Teams Registered</span></center>";
       echo "</tr></table></center>";


?>
				
    </div>


                  <div id="senior" style="height:217px;display:none;word-wrap:break-word;width:550px;overflow-x:hidden;">
                 <?php
//teams
     echo "<center>";
	$kt=mysql_query("SELECT * FROM users WHERE eid='quiz' and (ids LIKE 'N12%' || ids LIKE 'N13%' || ids LIKE 'N14%' || ids LIKE 'N15%')") or die(mysql_error());
	echo "<table border=1 cellpadding='30' style='text-align:center;'><tr>";
    $sen=0;
	if(mysql_num_rows($kt)>0)
	{
	    $kkg=0;
	    $tidd=0;
	while($fkt=mysql_fetch_array($kt))
		{
			$sen++;
			$tidd++;
		$mt=array();
		$mt=$fkt['ids'];
		$super=explode("~",$mt);
		
		if($kkg%7==0)
			echo "</tr><td style='background-color:white'>";
		else
			echo "<td style='background-color:white'>";
		$kkg++;
		$colors=array("660066","990000","6600CC","9900CC","FF0000","FF00CC","CC00CC","003399","006600");
		shuffle($colors);
		echo "&nbsp;<u><b><FONT COLOR=YELLOW style='background-color:black;'>Team : ".$tidd."</FONT></u></B><br>";
                $keka=count($super); 
		for($y=0;$y<$keka;$y++)
			echo "<font color=".$colors[0].">".$super[$y]."</font><br>";
		}
		echo "</td>";
		
		
	}
	else
		echo "<center><span class='' style='color:red;'>No Teams Registered</span></center>";
       echo "</tr></table></center>";


?>
	</div>
	
<div id="front" style="height:217px;word-wrap:break-word;width:550px;overflow-x:hidden;">
	<center>
		<table width="100%" border="1">
			<tr><td  colspan="2" style="background:khaki;"><center><h4><?php echo $title;?></h4></center></td></tr>
			<tr><td style="width:50%;background:#006666;color:#fff;font-weight:bold;"><h5>Registered Teams</h5></td>
<td style="padding-left:30px;"><h4><?php echo $jun;?></h4></td>
			</tr>
			<tr><td style="width:50%;background:#B0E0E6;color:#000;font-weight:bold;"><h5>Participants per team</h5></td>
<td style="padding-left:30px;"><h4><?php echo $minp; if($minp!=$maxp){?>- <?php echo $maxp;?><?php } ?></h4></td>
			</tr>
		</table>
	</center>
            </div>
</div>
</div>
        </div>
        </div>
        


    </div>
    <!-- /.container -->
    <br>
    <br>
    <!--Footer -->
    <div class="col-md-12 top-margin footer-section">
        For Technical Assistance Contact <b>9010932254 or 9398584586</b>
    </div>
    <!--Footer end -->
    <!--Core JavaScript file  -->
    <!--bootstrap JavaScript file  -->
    <script src="js/bootstrap.js"></script>
<script>
<?php if($minp==$maxp){?>
shwfi(''+<?php echo $maxp;?>+'');
<?php } ?>

</script>
</body>
</html>
<?php

}
?>
