@extends('Administrator.layout')

@section('content')
    <button class="btn btn-primary" id="add">New Sponsor</button>
    <hr>
    <!-- New Slider Form - Hidden on Window Load -->
    <div class="row" id="newform">
        {{ Form::open(array('url' => 'administrator/slider', 'method' => 'POST', 'class' => 'form')) }}
        <div class="col-md-9">
            
            <div class="form-group">
                @include('File.basic-form')
                <input type="hidden" name="url" id="url">
            </div>

            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Slider Name" required>
            </div>

            <div class="form-group">
                <label>Select Slider Order</label>
                <select class="form-control" name="order">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="form-group">
                <textarea name="description" rows="10" class="form-control" placeholder="Description..."></textarea>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success" />Add Slider</button>
            </div>

        </div>
        {{ Form::close() }}
    </div>

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
            @foreach($slider as $s)
            <tr>    
                <td class="col-md-1"><img src="{{ URL::to('/') }}/{{ $s->url }}" style="height: 93px;"></td>
                <td>{{ $s->title }}</td>
                <td>{{ $s->description }}</td>
                <td>{{ $s->order }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#newform').hide();

            $('#add').click(function(){
                $('#newform').toggle();
            });
        });
    </script>
@include('File.basic-script')    
@stop