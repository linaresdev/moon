<!DOCTYPE html>
<html lang="{{$lang}}">
    <head>
        <meta charset="{{$charset}}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{$title}}</title>
        @section("css")

        <link href="{{__url('{cdn}/assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{__url('{cdn}/assets/css/mdi-6595.min.css')}}" rel="stylesheet">
        <link href="{{__url('{cdn}/assets/css/layout.ui.css')}}" rel="stylesheet">
        @show

    </head>

    <body role="moon">        

        <article class="{{$container}}">

            @includeIF("moon::partial.navbar")

            @yield("body", "Body Content")
            
        </article>

        @section("js")

        <script src="{{__url('{cdn}/assets/js/jquery-371.min.js')}}"></script>
        <script src="{{__url('{cdn}/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{__url('{cdn}/assets/js/layout.ui.js')}}"></script>        
        @show
        
    </body>
</html>