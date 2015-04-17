<!-- Carousel -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php 
            $slider = Slider::All();
            $i = 0;
            while ($i < count($slider)) { 
        ?>
        <li data-target="#myCarousel" data-slide-to="{{ $i }}" @if($i == 1) class="active" @endif ></li>
        <?php $i++; } ?>
    </ol>
    <div class="carousel-inner">
        @foreach($slider as $s)
            <div class="item @if($s->order == 1) active @endif">
                <img src="{{ URL::to('/uploads/') }}/slider_{{ $s->url }}" alt="">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>{{ $s->title }}</h1>
                        <p>{{ $s->description }}</p>
                    </div>
                </div>
            </div>          
        @endforeach   
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>