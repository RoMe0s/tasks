/**
 * Created by rome0s on 15.05.17.
 */
$("input#image-input").on("change", function() {

    if(this.files[0] !== undefined && this.files[0] !== null) {

        var $preview = $('div.thumbnail'),
            reader = new FileReader();

        reader.onload = function (e) {
            var src;
            src = e.target.result;
            return $preview.find('img').attr('src', src);
        };

        reader.readAsDataURL(this.files[0]);

    }

});