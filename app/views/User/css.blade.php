    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/assets/css/bootstrap.{{ Config::get('settings.theme') }}.min.css">
    {{ HTML::style('assets/css/custom.css') }}
    {{ HTML::style('assets/css/font-awesome.min.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- JQuery -->
    {{ HTML::script('assets/js/jquery.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    {{ HTML::script('assets/js/holder.js') }}
    
    {{ HTML::style('assets/css/jbootstrap.css') }}
    {{ HTML::script('assets/js/jasny-bootstrap.min.js') }}