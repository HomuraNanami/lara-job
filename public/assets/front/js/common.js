bsCustomFileInput.init();

$(".profile input[type=file]").on('change', function() {
    var input = $(this);
    var files = !!this.files ? this.files : [];
    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    if (/^image/.test( files[0].type)){ // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file
        reader.onloadend = function(){ // set image data as background of div
            input.parent().parent().find('.icon').css("background-image", "url("+this.result+")");
        }
    }
});

