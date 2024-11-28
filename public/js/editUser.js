

Webcam.set({
    width: 350,
    height: 250,
    image_format: 'jpg',
    jpeg_quality: 90,
    flip_horiz: false
});

Webcam.attach('#my_camera');

function take_snapshot() {

    Webcam.snap(function (data_uri) {

        $(".image-tag").val(data_uri);

        document.getElementById('results').innerHTML = '<img src="' + data_uri + '" id="previewimage"/>';
        jQuery(function ($) {
            var p = $("#previewimage");

            $("body").on("change", ".image", function () {
                var imageReader = new FileReader();
                imageReader.readAsDataURL(document.querySelector(".image").files[0]);

                imageReader.onload = function (oFREvent) {
                    p.attr('src', oFREvent.target.result).fadeIn();
                };
            });

            $('#previewimage').imgAreaSelect({
                aspectRatio: '1:1',
                maxWidth: "250",
                onSelectEnd: function (img, selection) {
                    $('input[name="x1"]').val(selection.x1);
                    $('input[name="y1"]').val(selection.y1);
                    $('input[name="w"]').val(selection.width);
                    $('input[name="h"]').val(selection.height);
                }

            });

        });
    });

}
function option(x) {
    //console.log(x)
    if (x === 0) {
        document.getElementById("tutor").classList.remove("d-none");
    }
    if (x === 1) {
        document.getElementById("tutor").classList.add("d-none");
    }
}