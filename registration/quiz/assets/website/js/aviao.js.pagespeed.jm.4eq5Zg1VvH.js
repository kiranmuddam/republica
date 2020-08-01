var planeMoved=false;var planeTime=20000;$(init);function init()
{planeMove();}
function planeMove()
{if(!planeMoved)
{$("#plane")
.css("left",$("#plane").offset().left)}
$("#plane")
.animate({left:$("#wrapper").width()},planeTime,"linear",function()
{$(this)
.css("left",-parseInt($(this).css("width")))
planeMoved=true;planeMove();})}