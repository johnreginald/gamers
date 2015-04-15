@extends('User.layout')

@section('content')

@include('User.carousel')

<div class="container wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="assets/img/1.jpg" alt="...">
                        <div class="caption">
                            <a href="#">Item 1</a>
                            <p>Test Item 1</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="assets/img/3.jpg" alt="...">
                        <div class="caption">
                            <a href="#">Item 2</a>
                            <p>Test Item 2</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="assets/img/2.jpg" alt="...">
                        <div class="caption">
                            <a href="#">Item 3</a>
                            <p>Test Item 3</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="assets/img/1.jpg" alt="...">
                        <div class="caption">
                            <a href="#">Item 4</a>
                            <p>Test Item 4</p>
                        </div>
                    </div>
                </div>                                
            </div> <!-- Featured Area -->

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
                        <div class="panel-body">
                            foreach ($contents as $c)
                            <h4> $c->post_title </h4>
                            <p> $c->post_content </p>
                            <hr>
                            endforeach
                        </div>
                    </div>
                </div> <!-- COL-MD-7 -->
            </div>
        </div> <!-- Left Area End -->

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Advertisement Area</h3>
                </div>
                <div class="panel-body">
                    This is Advertisement
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Advertisement Area</h3>
                </div>
                <div class="panel-body">
                    This is Advertisement
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Advertisement Area</h3>
                </div>
                <div class="panel-body">
                    This is Advertisement
                </div>
            </div>                              
        </div> <!-- ADVERTISEMENT AREA END -->
    </div> <!-- ROW END -->
</div> <!-- Wrapper End -->
@stop