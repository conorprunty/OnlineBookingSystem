function validateForm() {
    var entry = document.forms["add"]["area"].value;
    if (entry == null || entry == "") {
        alert("Please enter an area");
        return false;
    }
}