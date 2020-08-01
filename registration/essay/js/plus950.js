function pick(field)
		{
			return document.getElementById(field).value;
		}
		

function login()
{
	var uid=pick("uid");
	var passwd=pick("passwd");

 if(uid.length==7 && passwd.length>=1)
{
	dhtmlx.message("Authenticating <b>"+uid+"</b>...");
	$.post("login_check.php",{uid:uid,passwd:passwd},function(data){if(data.indexOf("invalid")!=-1){dhtmlx.message({ type:"error", text:"Invalid Credentials" })} else if(data.indexOf("success")!=-1){dhtmlx.message("<font style='color:green;font-weight:bold;'>Login successful</font>");location.reload();}else if(data.indexOf("not a student")!=-1){dhtmlx.message({ type:"error", text:"Not a CSE Student" })} });

}
else
{
	dhtmlx.message({ type:"error", text:"*All fields are required" });
	return false;
}
}

function givefeed(sno,year,sub)
{
var fac=pick(sno+"facname");	
if(sno!="" && sno!=undefined && isNaN(sno)==false && fac!="" && fac!=undefined && isNaN(fac)==true && year!="" && year!=undefined && isNaN(year)==true && sub!="" && sub!=undefined && isNaN(sub)==true)
{
var datastring="year="+year+"&sub="+sub+"&fac="+fac;
$.ajax({
type:"POST",
url:"showfeedform.php",
data:datastring,
cache:false,
async:true,	
beforeSend:function(data){$("#"+sno+"but").html("<img src='ajax-loading.gif'>");},
success:function(data){$("#loadi").html(data);}	
});
}
else
{
dhtmlx.alert({type:"alert-error", title:"CSE FEEDBACK", text:"Please choose faculty"})
return false;	
}

}


function postfed(year,sub,fac)
{
if(year!="" && year!=undefined  && sub!="" && sub!=undefined  && fac!="" && fac!=undefined && isNaN(fac)==true)
{
var qns="";
if($('input[name=que1]:checked').val()!=undefined){qns=qns+"&que1="+$('input[name=que1]:checked').val();}
else{qns=qns+"&que1=NULL";}
for(var i=2;i<=10;i++)
{
var ter=$('input[name=que'+i+']:checked').val();
if(ter==undefined){qns=qns+"&que"+i+"=NULL";}
else{qns=qns+"&que"+i+"="+ter;}	
}

qns=qns+"&que11="+pick("que11");
qns=qns+"&que12="+pick("que12");

var datastring="year="+year+"&sub="+sub+"&fac="+fac+qns;

$.ajax({
type:"POST",
url:"postfeedform.php",
data:datastring,
cache:false,
async:true,	
beforeSend:function(data){$("#subm").hide();$("#load").show();},
success:function(data){if(data.indexOf("sent")!=-1){dhtmlx.alert({title:"Message", text:"Feedback Successfully Submitted"});window.location='index.php';}else{dhtmlx.message({ type:"error", text:data });$("#subm").show();$("#load").hide();}}
});

}
else
{
dhtmlx.alert({type:"alert-error", title:"CSE FEEDBACK", text:"Some error Occured"})
return false;	
}
	
}

