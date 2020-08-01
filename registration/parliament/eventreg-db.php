<?php
session_start();
require("site-settings.php");
if(isset($_POST['eid']) && !empty($_POST['eid']) && isset($_POST['part']) && !empty($_POST['part']) && isset($_POST['ids']) && !empty($_POST['ids'])  && isset($_POST['type']) && !empty($_POST['type']))
{ 
$type=htmlspecialchars(htmlentities(trim(strip_tags($_POST['type']))));
$id=htmlspecialchars(htmlentities(trim(strip_tags($_POST['eid']))));
$ids=htmlspecialchars(htmlentities(trim(strip_tags($_POST['ids']))));
$part=htmlspecialchars(htmlentities(trim(strip_tags($_POST['part']))));

$type="Week";
$id="parliament";
$minp=1;
$maxp=1;
$title="Youth Parliament";		
	if(1==1){
if(($part<$minp) || $part>$maxp){echo "Invalid Number of participants";exit;}
//main code
$tids=array();
$tids=explode("~",$ids);	

//function for duplicate checking
function showDups($array)
{
  $array_temp = array();

   foreach($array as $val)
   {
     if (!in_array($val, $array_temp))
     {
       $array_temp[] = $val;
     }
     else
     {
       echo 'Following are Repeating ' . $val . '<br />';
       exit;
     }
   }
}

//checking duplicates
showDups($tids);


//checking whether user is real
$err="";
$valid=0;
$regco=0;
for($i=0;$i<count($tids);$i++)
{
if(mysql_num_rows(mysql_query("SELECT * FROM data WHERE id='".$tids[$i]."'"))<1){$err=$err.$tids[$i].", ";$regco++;}
else{$valid++;}	
}
if($regco!=0){$ty=($regco==1)?"is":"are";$err=$err." $ty invalid";echo $err;exit;}

//checking whether both seniors and juniors are in same time
$junior=0;
$senior=0;
for($i=0;$i<count($tids);$i++)
{
$qu=mysql_fetch_array(mysql_query("SELECT * FROM data WHERE id='".$tids[$i]."'"));
if($qu['year']=='N_P1' || $qu['year']=='N_P2' || $qu['year']=='S_P1' || $qu['year']=='S_P2'){$junior++;}
if($qu['year']=='E1' || $qu['year']=='E2' || $qu['year']=='E3' || $qu['year']=='E4'){$senior++;}
}

if($junior>0 && $senior>0){echo "Team contains both juniors and seniors.<br>Please change Team members";exit;}


//checking whether already registered
$err="";
$valid=0;
$regco=0;
$mine=mysql_query("SELECT ids FROM users WHERE eid='$id'");
	while($p2=mysql_fetch_array($mine))
		{
		$spl=explode("~",$p2['ids']);
		for($k=0;$k<count($tids);$k++)
			{
			if(in_array($tids[$k],$spl))
				{
				$err=$err.$tids[$k].", ";$regco++;
				
				}	
			}
			}
			if($regco!=0){$ty=($regco==1)?"is":"are";$err=$err." $ty Already Registered";echo $err;exit;}

$teamid=0;
$t=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE eid='$id' ORDER BY sno DESC"));
$teamid=$t['teamid'];
$teamid=(int)$teamid;
$teamid=$teamid+1;

if(mysql_query("INSERT INTO users(`eid`, `eventname`,`teamid`,`ids`,`ip`) VALUES ('$id','$title', '$teamid','$ids','$ip')"))
{
echo "success";
}
else
{
echo "Query failed";
}
	
}
else
{
echo "No such Event exists";	
}
}
?>
