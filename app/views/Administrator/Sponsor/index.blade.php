@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Sponsor Management</h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <a href="{{ URL::to('administrator/sponsor/create') }}" class="btn btn-primary btn-sm" >New Sponsor</a>
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
                    @forelse($sponsor as $s)
                    <tr>    
                        <td class="col-md-1"><img src="{{ URL::to('/uploads/') }}/250x75_{{ $s->url }}"></td>
                        <td>{{ $s->title }}</td>
                        <td>{{ $s->description }}</td>
                        <td>{{ $s->order }}</td>
                        <td>
                            {{ Form::open(array('url' => 'administrator/sponsor/delete/' . $s->id, 'method' => 'POST', 'class' => 'form')) }}
                                <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                            {{ Form::close() }}
                        </td>                        
                    </tr>
                    @empty
                    <tr>
                        <td>Not Sponsor Yet!</td>
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