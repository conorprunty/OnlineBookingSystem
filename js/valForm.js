function validateForm() {
    //this ensures something is entered in the text area to add a new area - otherwise return false
    var entry = document.forms["add"]["area"].value;
    if (entry == null || entry == "") {
        alert("Please enter an area");
        return false;
    }
}

function notEmpty() {
    //this ensures something is entered in the text area to add a new area - otherwise return false
    var entry = document.forms["userChoice"]["cost"].value;
    if (entry == null || entry == "") {
        alert("Cost cannot be blank");
        return false;
    }
}