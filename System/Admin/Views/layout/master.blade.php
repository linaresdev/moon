<!DOCTYPE html>
<html lang="{{$lang}}">
    <head>
        <meta charset="{{$charset}}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{$title}}</title>

        <link href="{{__url('{firemoon}/assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{__url('{cdn}/assets/css/mdi-6595.min.css')}}" rel="stylesheet">
        @section("css")

        <link href="{{__url('{firemoon}/assets/css/layout.ui.css')}}" rel="stylesheet">
        @show

    </head>

    <body role="moon" class="{{style('body')}}">

        <article class="">  
            <nav class="bg-white fixed-top">

                <div class="navbar {{ style('navbar') }} navbar-expand-md shadow-sm border-bottom py-1">
                    <div class="{{style('wrapper')}} my-0 py-0"> 

                        <a href="{{__url('/')}}" class="navbar-brand">
                            <span class="mdi mdi-progress-wrench"></span> 
                            {{env("APP_NAME")}}
                        </a>

                        <button class="btn navbar-toggler p-0 ms-auto" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#mainNavBar" 
                                aria-controls="mainNavBar" 
                                aria-expanded="false" 
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <div id="mainNavBar" class="moon-navbar-body collapse navbar-collapse"> 

                            @if( auth("web")->check() )                        
                            <ul class="nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle p-0" 
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="{{__url($login->getAvatar())}}"                                    
                                            class="avatar avatar-circle" 
                                            style="max-width:36px;"
                                            alt="@">
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{__url('admin')}}" class="dropdown-item">
                                            <span class="mdi mdi-cog mdi-18px"></span>
                                            {{__("manage.app")}}
                                        </a>
                                        <a href="{{__url('logout')}}" class="dropdown-item">
                                            <span class="mdi mdi-logout mdi-18px"></span>
                                            {{__("words.logout")}}
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            @endif

                        </div>
                    </div>              
                </div>                
            </nav>       

            @yield("body", "Body Content")

            <footer class="pb-4 pt-3">
                <article class="{{style('wrapper')}}">

                    <section class="d-flex  border-bottom">                    
                        <article class="flex-fill">
                            <div class="nav">
                                <a href="#" class="nav-link link-dark">
                                    {{__("words.help")}}
                                </a>
                                <a href="#" class="nav-link link-dark">
                                    {{__("words.contact")}}
                                </a>
                                <a href="#" class="nav-link link-dark">
                                    {{__("words.security")}}
                                </a>
                            </div>
                        </article>  
                        <article class=" pe-3">
                            {{ $metalang->slug }} | <img class="avatar" src="{{__url($metalang->flag)}}" 
                            style="width:24px;"
                            alt="FLAG">
                        </article>              
                    </section>
                
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="text-dark py-2 ps-3">
                                @2006-2025 | Republica Dominicana
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="">
                                <div class="nav flex-row-reverse">
                                    <a href="#" class="nav-link link-dark">
                                        {{__("words.accessibility")}}
                                    </a>
                                    <a href="#" class="nav-link link-dark">
                                        {{__("words.privacy")}}
                                    </a>
                                    <a href="#" class="nav-link link-dark">
                                        {{__("words.cookies")}}
                                    </a>
                                    <a href="#" class="nav-link link-dark">
                                        {{__("legal.agreements")}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </footer>
            
        </article>
        
    <script src="{{__url('{cdn}/assets/js/jquery-371.min.js')}}"></script>
    <script src="{{__url('{firemoon}/assets/js/bootstrap.bundle.min.js')}}"></script>
    @section("js")
    
    <script src="{{__url('{firemoon}/assets/js/layout.ui.js')}}"></script>        
    @show
        
    </body>
</html>