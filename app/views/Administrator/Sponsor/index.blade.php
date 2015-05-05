@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Image Slider Code Management</h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <a href="{{ URL::to('administrator/slider/create') }}" class="btn btn-primary btn-sm" >New Slider</a>
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
                    </tr>
                </thead>

                <tbody>
                    @forelse($slider as $s)
                    <tr>    
                        <td class="col-md-1"><img src="{{ URL::to('/uploads/') }}/250x75_{{ $s->url }}"></td>
                        <td>{{ $s->title }}</td>
                        <td>{{ $s->description }}</td>
                        <td>{{ $s->order }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td>Not Slider Yet!</td>
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