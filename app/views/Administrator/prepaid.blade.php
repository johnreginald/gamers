@extends('Administrator.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Prepaid Code Management
        </h3>
    </div>
    <div class="container-fluid">
        <div class="pull-left">
            {{ Form::open(array('url' => 'administrator/prepaid/generate', 'method' => 'POST', 'class' => 'form')) }}
            <input type="submit" class="btn btn-primary btn-sm" value="Generate New Prepaid Code">
            {{ Form::close() }}
        </div>
        <div class="pull-right">
            {{ Form::open(array('url' => 'administrator/prepaid/search', 'method' => 'POST', 'class' => 'form')) }}
            <input class="form-control input-sm" name="search" placeholder="Search Prepaid">
            {{ Form::close() }}
        </div>		    	
    </div>
</div><hr>
{{ $prepaid->links() }}
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Serial Number</th>
            <th>Prepaid Code</th>
            <th>Date</th>
            <th>Used By</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody class="">
        @forelse ($prepaid as $p)
        <tr>
            <td>{{ $p->serial }}</td>
            <td>{{ $p->code }}</td>
            <td>{{ $p->created_at }}</td>
            <td>{{ $p->used_by }}</td>
            <td>{{ $p->status }}</td>
        </tr>
        @empty
        <tr>
            <td>Nothing Here Yet. Generate Some Prepaid Code.</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforelse
    </tbody>
</table>
@stop