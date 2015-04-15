{{ HTML::style('assets/css/summernote.css') }}
{{ HTML::script('assets/js/summernote.js') }}

<script type="text/javascript">
	$('#ide').summernote({
	        onImageUpload: function(files, editor, welEditable) {
	            sendFile(files[0], editor, welEditable);
	        }
	});

	// send the file

	function sendFile(file, editor, welEditable) {
	        data = new FormData();
	        data.append("file", file);
	        $.ajax({
	            data: data,
	            type: 'POST',
	            xhr: function() {
	                var myXhr = $.ajaxSettings.xhr();
	                if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
	                return myXhr;
	            },
	            url: 'http://127.0.0.1/administrator/upload_ide',
	            cache: false,
	            contentType: false,
	            processData: false,
	            success: function(url) {
	                editor.insertImage(welEditable, url);
	            }
	        });
	}

    // update progress bar
    function progressHandlingFunction(e){
        if(e.lengthComputable){
            $('progress').attr({value:e.loaded, max:e.total});
            // reset progress on complete
            if (e.loaded == e.total) {
                $('progress').attr('value','0.0');
            }
        }
    }
</script>