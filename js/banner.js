function setBanner() {
    //used to display the banner
    if (icon == 1) {
        document.getElementById("icon").innerHTML =
            "<img id='iconSize' src='images/football.jpg'/>";
    } else if (icon == 2) {
        document.getElementById("icon").innerHTML =
            "<img id='iconSize' src='images/swimming.jpg'/>";

    } else if (icon == 3) {
        document.getElementById("icon").innerHTML =
            "<img id='iconSize' src='images/tennis.jpg'/>";
    } else if (icon == 4) {
        document.getElementById("icon").innerHTML =
            "<img id='iconSize' src='images/basketball.jpg'/>";
    }
    document.getElementById('iconSize').height = "100";
    document.getElementById('iconSize').width = "1500";
};