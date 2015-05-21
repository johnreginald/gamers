@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Advertisement Management</h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <a href="{{ URL::to('administrator/advertisement/create') }}" class="btn btn-primary btn-sm" >New Advertisement</a>
        </div>

        <div class="box-body">
            <!-- Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>  
                        <th>Name</th>
                        <th>Description</th>
                        <th>Order</th>
                        <th>Actions</th>                        
                    </tr>
                </thead>

                <tbody>
                    @forelse($advertisement as $a)
                    <tr>    
                        <td class="col-md-1"><img src="{{ URL::to('/uploads/') }}/250x75_{{ $a->url }}"></td>
                        <td>{{ $a->title }}</td>
                        <td>{{ $a->description }}</td>
                        <td>{{ $a->order }}</td>
                        <td>
                            {{ Form::open(array('url' => 'administrator/advertisement/delete/' . $a->id, 'method' => 'POST', 'class' => 'form')) }}
                                <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                            {{ Form::close() }}
                        </td>  
                    </tr>
                    @empty
                    <tr>
                        <td>Not Advertisement Yet!</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div> <!-- Box Body end -->
    </div> <!-- Box End -->
</section>
@stop