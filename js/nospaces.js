$(function() {
    //function for not allowing the space key to be pressed
    $('#entry').on('keypress', function(e) {
        if (e.which == 32)
            return false;
    });
});