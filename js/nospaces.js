$(function() {
            $('#entry').on('keypress', function(e) {
                if (e.which == 32)
                    return false;
            });
        });