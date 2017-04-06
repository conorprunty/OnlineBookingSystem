function createRan() {
    //generates a random number as the booking reference
    var test = Math.floor(Math.random() * 1000000);
    document.getElementById("ranNum").value = test;
};