<?php
require_once 'library/html.php';
require_once 'library/models.php';

?>
<?php htmlStart("Welcome to RadGuitars!"); ?>
<body>
<?php htmlNav(); ?>

<h1>Welcome to Rad guitars!</h1>
<p id="date">click for todays date.</p>
<button type="button" onclick="displayDate()">Display Date</button>
</br>
</br>

<img src='./images/guitarImages/wierd.jpg' id='image' width ="300" height ="150"
     onmouseover='changeImage("image")' onmouseout='changeImageBack("image")'>

</br>

<img id = "special" src ="./images/guitarImages/special1.jpg" width ="145" height ="126" alt="Planets" usemap="#guitarDeal" />
<map name="guitarDeal">
<area shape ="rect" coords ="0,0,73.5,126"
onmouseover="writeSpecial('Deal 1 today is fender guitar pack. Click for image')"
href ="./images/guitarImages/fender2.jpg" target ="_blank" alt="pack1" />

<area shape ="rect" coords ="126,120,0,0"
onmouseover="writeSpecial('Deal 2 today is Gibson strings. Click for image')"
href ="./images/guitarImages/gibsonStrings.jpg" target ="_blank" alt="pack2" />

</map> 
<p id="desc">Mouse over for todays special.</p>

<p>please vist our gibson supplier</P>
<form>
<input type=button value="Gibson" onclick="open_win_gibson()">
</form>


</body>

<?php htmlEnd(); ?>