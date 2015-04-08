@extends('Administrator.layout')

@section('content')
<div id="ass"></div>


<form method="POST" action="http://127.0.0.1/administrator/upload" accept-charset="UTF-8" class="form" id="upload" enctype="multipart/form-data">
                <input name="file" type="file">
                <input type="submit" value="Upload">                
            </form>



<script type="text/javascript">
$(document).ready(function() {
    $('#upload').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ URL::to('administrator/upload') }}',
            dataType: 'html',
            success: function(html, textStatus) {
                $('#ass').append(html);
            },
            error: function(xhr, textStatus, errorThrown) {
                alert('error');
            }
        });
    });
});
</script>
@stop