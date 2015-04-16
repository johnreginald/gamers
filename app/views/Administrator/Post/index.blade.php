@extends('Administrator.layout')

@section('content')

@include('Administrator.message')

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Posts Management
        </h3>
    </div>
    <div class="container-fluid">
        <div class="pull-right">
            {{ Form::open(array('url' => 'administrator/post/search', 'method' => 'POST', 'class' => 'form')) }}
            <input class="form-control input-sm" name="search" placeholder="Search Posts" >
            {{ Form::close() }}
        </div>
        <div class="pull-left">
            <a href="{{ URL::to('administrator/post/create') }}" class="btn btn-primary btn-sm">New Post</a>
        </div>    	
    </div>
</div>
<br>
<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#all" data-toggle="tab">All</a></li>
    <li><a href="#publish" data-toggle="tab">Published @if( Post::onlyPublish()->count() > 0 ) <span class="badge">{{ Post::onlyPublish()->count() }}</span> @endif</a></li>
    <li><a href="#draft" data-toggle="tab">Draft @if( Post::onlyDraft()->count() > 0 ) <span class="badge">{{ Post::onlyDraft()->count() }}</span> @endif</a></li>
    <li><a href="#trash" data-toggle="tab">Trash @if( Post::onlyTrashed()->count() > 0 ) <span class="badge badge-danger">{{ Post::onlyTrashed()->count() }}</span> @endif</a></li>
</ul>
<br>
<!-- Tab panes -->
<div class="tab-content">
    <!-- All Tab -->
    <div class="tab-pane active" id="all">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Post</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th class="col-md-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($all as $a)
                <tr>
                    <td>
                        <a href="{{ URL::to('administrator/post/' . $a->id . '/edit') }}">{{ $a->title }}</a> @if ($a->status == 0) <small class="text-muted"> - {{ ucfirst(Post::changeStatus($a->status)) }}</small> @endif
                    </td>
                    <td>{{ $a->author }}</td>
                    <td>{{ $a->created_at }}</td>
                    <td class="col-md-3">
                        <div class="pull-left">
                            {{ Form::open(array('url' => 'administrator/post/' . $a->id, 'method' => 'POST', 'class' => 'form')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            <a href="{{ URL::to('administrator/post/' . $a->id . '/edit') }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                            <a href="{{ URL::to('post/' . $a->id) }}" target="_blank" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span> View</a>                            
                            <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span> Trash</button>
                            {{ Form::close() }}
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>There's no Posts to show.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Publish Tab -->
    <div class="tab-pane" id="publish">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Post</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th class="col-md-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($published as $publish)
                <tr>
                    <td>
                        <a href="{{ URL::to('administrator/post/' . $publish->id . '/edit') }}">{{ $publish->title }}</a>
                    </td>
                    <td>{{ $publish->author }}</td>
                    <td>{{ $publish->created_at }}</td>
                    <td class="col-md-3">
                        <div class="pull-left">
                            {{ Form::open(array('url' => 'administrator/post/' . $a->id, 'method' => 'POST', 'class' => 'form')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            <a href="{{ URL::to('administrator/post/' . $a->id . '/edit') }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                            <a href="{{ URL::to('post/' . $a->id) }}" target="_blank" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span> View</a>                            
                            <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span> Trash</button>
                            {{ Form::close() }}							
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>There's no Posts to show.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Draft Tab -->
    <div class="tab-pane" id="draft">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Post</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th class="col-md-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($drafted as $draft)
                <tr>
                    <td>
                        <a href="{{ URL::to('administrator/post/' . $draft->id . '/edit') }}">{{ $draft->title }}</a>
                    </td>
                    <td>{{ $draft->author }}</td>
                    <td>{{ $draft->created_at }}</td>
                    <td class="col-md-3">
                        <div class="pull-left">
                            {{ Form::open(array('url' => 'administrator/post/' . $a->id, 'method' => 'POST', 'class' => 'form')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            <a href="{{ URL::to('administrator/post/' . $a->id . '/edit') }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                            <a href="{{ URL::to('post/' . $a->id) }}" target="_blank" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span> Preview</a>                            
                            <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span> Trash</button>
                            {{ Form::close() }}						
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>There's no Posts to show.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Trash Tab -->
    <div class="tab-pane" id="trash">
        {{ Form::open(array('url' => 'administrator/post/trash', 'method' => 'POST', 'class' => 'form')) }}
        <input class="btn btn-danger btn-sm" type="submit" value="Empty Trash">
        {{ Form::close() }}
        <br>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Post</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th class="col-md-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($trashed as $trash)
                <tr>
                    <td>
                        {{ $trash->title }}
                    </td>
                    <td>{{ $trash->author }}</td>
                    <td>{{ $trash->deleted_at }}</td>
                    <td class="col-md-3">
                        <div class="pull-left">
                            {{ Form::open(array('url' => 'administrator/post/restore', 'method' => 'POST', 'class' => 'form')) }}
                            {{ Form::hidden('id', $trash->id) }}                            
                            <button class="btn btn-success btn-xs" type="submit"><span class="glyphicon glyphicon-ok-sign"></span> Restore</button>
                            {{ Form::close() }}					
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>There's no Posts in Trash.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop