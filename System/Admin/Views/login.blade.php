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

    <body role="moon" class="{{$skin->css('body')}}">

        <article class="{{$skin->css('wrapper')}}">  
            
            @if( auth()->check() )

            <section class="{{$skin->css('account', 'auth')}}" 
                style="max-width:480px;">

                <header class="account-header ">
                    <h5 class="fs-5">
                        <span class="mdi mdi-lock-open-outline mdi-24px"></span>
                        {{__("auth.authenticated")}}
                    </h5>
                </header>

                <article class="account-body">

                    <a href="#" class="btn btn-success rounded-0">
                        <span class="mdi mdi-reply-outline"></span>
                        {{__("take.back")}}
                    </a>

                    <a href="{{__url('/')}}" class="btn btn-danger rounded-0">
                        <span class="mdi mdi-close"></span>
                        {{__("words.close")}}
                    </a>

                </article>

            </section>
            
            @else
            <section class="{{$skin->css('account', 'auth')}}" 
                style="max-width:480px;">

                <header class="account-header ">
                    <h5 class="fs-5">
                        <span class="mdi mdi-lock-outline mdi-24px"></span>
                        {{$title}}
                    </h5>
                </header>

                <article class="account-body">
                    <form action="{{__url('login')}}" method="POST">

                        @if($errors->any())
                        <ol class="m-0 p-3">
                            @foreach( $errors->all() as $row )
                            <li class="text-danger">{{$row}}</li>
                            @endforeach
                        </ol>
                        @endif

                        <div class="form-floating mb-2">
                            <input type="text" 
                                name="user" 
                                value="{{old('user')}}"
                                id="user"
                                class="form-control rounded-0 @error('user') is-invalid @enderror"
                                placeholder="{{__('auth.field.user')}}"
                                autocomplete="off">

                            <label for="user">{{__("auth.field.user")}}</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" 
                                name="pwd" 
                                value="{{old('pwd')}}"
                                id="pwd"
                                class="form-control rounded-0 @error('pwd') is-invalid @enderror"
                                placeholder="{{__('auth.field.password')}}">

                            <label for="user">{{__("auth.field.password")}}</label>
                        </div>

                        <div class="mb-2">
                            @csrf

                            <button type="submit" class="btn btn-outline-secondary rounded-0">
                                <span class="mdi mdi-login"></span>
                                {{__("Acceder")}}
                            </button>

                            <a href="{{__url('getmembership')}}" 
                                class="btn rounded-0">
                                <span class="mdi mdi-gift-outline"></span>
                                {{__("auth.getmembership")}}
                            </a>
                        </div>
                    </form>
                </article>

            </section>
            
            <section class="{{$skin->css('account', 'auth')}}" 
                style="max-width:480px;">

                <header class="account-header ">
                    <h5 class="fs-5">
                        <span class="mdi mdi-shield-link-variant-outline mdi-24px"></span>
                        {{__("auth.invite")}}
                    </h5>
                </header>

                <article class="account-body">
                    <form action="{{__url('login')}}" method="POST">

                        @if($errors->any())
                        <ol class="m-0 p-3">
                            @foreach( $errors->all() as $row )
                            <li class="text-danger">{{$row}}</li>
                            @endforeach
                        </ol>
                        @endif

                        <div class="form-floating mb-3">
                            <input type="text" 
                                name="invite" 
                                value="{{old('invite')}}"
                                id="invite"
                                class="form-control rounded-0 @error('invite') is-invalid @enderror"
                                placeholder="{{__('words.invite')}}">

                            <label for="user">{{__("words.invite")}}</label>
                        </div>
                    </form>
                </article>

            </section> 

            @endif
            
        </article>
        
    <script src="{{__url('{cdn}/assets/js/jquery-371.min.js')}}"></script>
    <script src="{{__url('{firemoon}/assets/js/bootstrap.bundle.min.js')}}"></script>
    @section("js")
    
    <script src="{{__url('{firemoon}/assets/js/layout.ui.js')}}"></script>        
    @show
        
    </body>
</html>