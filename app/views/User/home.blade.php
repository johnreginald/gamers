@extends('User.layout')

@section('content')

@include('User.carousel')

<div class="container wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                @foreach($featured as $f)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            @if ($f->image == 'NULL')
                            <img data-src="holder.js/210x150/sky" alt="...">
                            @else
                            <img src="{{ URL::to('uploads/products') }}/{{ $f->image }}">
                            @endif
                            <div class="caption">
                                <a href="{{ URL::to('item') }}/{{ $f->id }}">{{ $f->name }}</a>
                                <p>Price: {{ $f->price }}</p>
                            </div>
                        </div>
                    </div>      
                @endforeach
            </div> <!-- Featured Area -->

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Announcements and News</h3>
                        </div>
                        @include('User.ajax_post')
                    </div>             
                </div> <!-- COL-MD-7 -->
            </div>
        </div> <!-- Left Area End -->

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Our Partners</h3>
                </div>
                <div class="panel-body">
                    @forelse($sponsors as $sponsor)
                        <img src="uploads/{{ $sponsor->url }}" class="img-thumbnail"><br><br>
                    @empty
                        Nothing Here Yet
                    @endforelse
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Advertisement Area</h3>
                </div>
                <div class="panel-body">
                    @forelse($advertisements as $advertisement)
                        <img src="uploads/{{ $advertisement->url }}" class="img-thumbnail"><br><br>
                    @empty
                        Nothing Here Yet
                    @endforelse
                </div>
            </div>

        </div> <!-- ADVERTISEMENT AREA END -->
    </div> <!-- ROW END -->
</div> <!-- Wrapper End -->

<script src="{{ URL::to('assets/js/holder.js') }}"></script>

<script>
$(window).on('hashchange', function () {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            getPosts(page);
        }
    }
});

$(document).ready(function () {
    $(document).on('click', '.pagination a', function (e) {
        getPosts($(this).attr('href').split('page=')[1]);
        e.preventDefault();
    });
});

function getPosts(page) {
    $.ajax({
        url: '?page=' + page,
        dataType: 'json',
    }).done(function (data) {
        $('.posts').html(data);
        location.hash = page;
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
}

</script>

@stop