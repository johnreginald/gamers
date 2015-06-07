@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Prepaid Code Management</h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
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

        <div class="box-body">
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
        </div>
    </div>
</section>
@stop