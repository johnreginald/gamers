@extends('User.layout')

@section('content')

@include('User.carousel')

<div class="container wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Featured Items</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img data-src="holder.js/210x150/sky" alt="...">
                                <div class="caption">
                                    <a href="#">Item 2</a>
                                    <p>Test Item 2</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img data-src="holder.js/210x150/sky" alt="...">
                                <div class="caption">
                                    <a href="#">Item 2</a>
                                    <p>Test Item 2</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img data-src="holder.js/210x150/sky" alt="...">
                                <div class="caption">
                                    <a href="#">Item 3</a>
                                    <p>Test Item 3</p>
                                </div>
                            </div>
                        </div>                             
                    </div> <!-- Featured Area -->
                </div>
            </div> 

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#top" data-toggle="tab">Top Stories</a></li>
                                <li><a href="#news" data-toggle="news">Profile</a></li>
                            </ul>
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
                    <img data-src="holder.js/320x150/lava" alt="Example Company">
                    <hr>
                    <img data-src="holder.js/320x150/sky" alt="Example Company">
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Advertisement Area</h3>
                </div>
                <div class="panel-body">
                    <img data-src="holder.js/320x150/lava" alt="Example Company">
                    <hr>
                    <img data-src="holder.js/320x150/sky" alt="Example Company">
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Advertisement Area</h3>
                </div>
                <div class="panel-body">
                    <img data-src="holder.js/320x150/lava" alt="Example Company">
                    <hr>
                    <img data-src="holder.js/320x150/sky" alt="Example Company">
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