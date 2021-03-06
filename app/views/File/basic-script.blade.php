<!-- CSS START HERE -->
<!-- Generic page styles -->
<link rel="stylesheet" href="{{ URL::to('/') }}/file/css/style.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="{{ URL::to('/') }}/file/css/jquery.fileupload.css">

<!-- JAVASCRIPT START HERE -->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{{ URL::to('/') }}/file/js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{ URL::to('/') }}/file/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="{{ URL::to('/') }}/file/js/jquery.fileupload.js"></script>
<script>
$('#progress').hide();

$(document).ready(function(){
	$('#fileupload').change(function(){
		$('#progress').show();
	});
});
	
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'upload_basic';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<img/>').attr({
                    src: file.name,
                    class: 'img-thumbnail'
                }).appendTo('#files');
                $('#progress').remove();
                $('#uploadbutton').remove();
                $('#spacing').remove();
                $('#url').val(file.name);
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>