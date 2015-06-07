@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Reseller Application</h1>
</section>

<section class="content">
    @include('Administrator.message')
    <div class="box">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Application ID</th>
                    <th>Reseller Name</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($resellers as $reseller)
                <tr>
                    <td>{{ $reseller->id }}</td>
                    <td>{{ $reseller->username }}</td>
                    <td class="col-md-2">
                        <div class="pull-left">
                        {{ Form::open(array('url' => 'administrator/reseller/accept/' . $reseller->id, 'method' => 'POST', 'class' => 'form')) }}
                            <input type="submit" class="btn btn-success btn-xs" value="Accept">
                        {{ Form::close() }}
                        </div>
                        <div class="pull-right">
                        {{ Form::open(array('url' => 'administrator/reseller/cancel/' . $reseller->id, 'method' => 'POST', 'class' => 'form')) }}
                            <input type="submit" class="btn btn-danger btn-xs" value="Cancel">
                        {{ Form::close() }}  
                        </div>                      
                    </td>
                </tr>
                @empty
                <tr>
                    <td>No Application Yet</td> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>   
    </div>
</section>
@stop