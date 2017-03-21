function setIcon() { 
	var selectDd = document.getElementById("optionChoice");
  if(selectDd.value === "1")
  	document.getElementById("icon").innerHTML = 
             "<img id='iconSize' src='images/football.jpg'/>"; 
  else if(selectDd.value === "2")
  	document.getElementById("icon").innerHTML = 
             "<img id='iconSize' src='images/swimming.jpg'/>";
  else if(selectDd.value === "3")
  	document.getElementById("icon").innerHTML = 
             "<img id='iconSize' src='images/tennis.jpg'/>";
  else if(selectDd.value === "4")
  	document.getElementById("icon").innerHTML = 
             "<img id='iconSize' src='images/basketball.jpg'/>";
  else if(selectDd.value === "0")
  	document.getElementById("icon").innerHTML = 
             "Banner will be removed";
    document.getElementById('iconSize').height = "300";
    document.getElementById('iconSize').width = "1500";

}; 