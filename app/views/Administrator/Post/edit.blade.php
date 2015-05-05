@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Edit Post</h1>
</section>

<section class="content">
@include('Administrator.message')
<div class="row">
    {{ Form::open(array('url' => 'administrator/post/' . $content->id, 'method' => 'POST', 'class' => 'form')) }}
    {{ Form::hidden('_method', 'PUT') }}
    <div class="col-md-9">
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Enter Title Here..." value ="{{ $content->title }}" required autofocus>
        </div>

        <div class="form-group">
            <textarea id="ide" name="content">{{ $content->content }}</textarea>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">Post Options</div>

            <div class="panel-body">
                <p>Post Status : <a href="#" id="edit" style="text-transform: capitalize;">{{ ucfirst(Post::changeStatus($content->status)) }}</a></p>
                <div id="edit-show">
                    <select id="status" class="form-control input-sm">
                        <option value="0">Draft</option>
                        <option value="1">Publish</option>
                    </select>
                    <br>
                    <a class="btn btn-primary btn-sm" id="edit-ok">OK</a>
                    <a class="btn btn-primary btn-sm" id="edit-cancel">Cancel</a>
                </div> 
                <hr>
                <input type="submit" class="btn btn-success btn-sm" value="Update">
                <div class="pull-right">
                    <a href="{{ URL::to('administrator/post/preview/' . $content->id) }}" target="_blank" class="btn btn-info btn-sm">View Post</a> 
                </div>
            </div>
            {{ Form::close() }}
            <div class="panel-footer">
                {{ Form::open(array('url' => 'administrator/post/' . $content->id, 'method' => 'POST', 'class' => 'form')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                <input class="btn btn-danger btn-sm" type="submit" value="Move to Trash">
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
</section>

@include('Administrator.script')
<script type="text/javascript">
    var geturl = "{{ URL::to('administrator/post/' . $content->id) }}";

    $('#edit-show').hide();

    $('#edit').click(function () {
        $('#edit-show').toggle();
    });

    $('#edit-ok').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'PUT',
            url: geturl,
            data: {
                id: '{{ $content->id }}',
                status: $('#status option:selected').val(),
            },
            dataType: 'html',
            success: function (html, textStatus) {
                $('#edit-show').hide();
                $('a#edit').text($('#status option:selected').text());
            }
        });
    });
</script>
@stop