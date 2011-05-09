function changeImage(itemName)
{
document.getElementById(itemName).style.height='300px';
document.getElementById(itemName).style.width='600px';
}
function changeImageBack(itemName)
{
document.getElementById(itemName).style.height='150px';
document.getElementById(itemName).style.width='300px';
}
function writeSpecial(txt)
{
document.getElementById("desc").innerHTML=txt;
}
function show_alert_empty()
{
alert("Your cart is empty");
}
	
function open_win_gibson() 
{
window.open("http://www.Gibson.com");
}

function startTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
m=checkTime(m);
s=checkTime(s);
document.getElementById('clock').innerHTML=h+":"+m+":"+s;
t=setTimeout('startTime()',500);
}

function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}
function displayDate()
{
document.getElementById("date").innerHTML=Date();
}



