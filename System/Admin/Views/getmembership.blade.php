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

        <article class="{{$skin->css('wrapper')}} py-3">  
            
            <section class="{{$skin->css('account', 'account')}}">

                <header class="account-header">
                    <h5 class="fs-5 mb-3">
                        <span class="mdi mdi-gift-outline mdi-24px"></span>
                        {{$title}}
                    </h5>
                </header>

                <article class="{{$skin->css('account-header', 'account-header')}}">
                    <form action="{{__url('getmembership')}}" method="POST">

                        @if($errors->any())
                        <ol class="m-0 p-3">
                            @foreach( $errors->all() as $row )
                            <li class="text-danger">{{$row}}</li>
                            @endforeach
                        </ol>
                        @endif

                        <div class="form-floating mb-2">
                            <input type="text" 
                                name="fullname" 
                                value="{{old('fullname')}}"
                                id="lastname"
                                class="form-control rounded-0 @error('fullname') is-invalid @enderror"
                                placeholder="{{__('words.lastname')}}"
                                autocomplete="off">

                            <label for="fullname">{{__("words.fullname")}}</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" 
                                name="email"
                                value="{{old('email')}}"
                                id="email"
                                class="form-control rounded-0 @error('email') is-invalid @enderror"
                                placeholder="{{__('words.email')}}"
                                autocomplete="off">

                            <label for="email">{{__("words.email")}}</label>
                        </div>                       

                        <div class="mb-2">
                            @csrf
                            <input type="hidden" name="type" value="getmembership">

                            <button type="submit" class="btn btn-outline-secondary rounded-0">
                                <span class="mdi mdi-send-outline"></span>
                                {{__("send.request")}}
                            </button>
                            
                            <a href="{{__url('login')}}" 
                                class="btn btn-outline-danger rounded-0">
                                <span class="mdi mdi-reply-outline"></span>
                                {{__("words.back")}}
                            </a>
                        </div>
                    </form>
                </article>

            </section>
            
        </article>
        
    <script src="{{__url('{cdn}/assets/js/jquery-371.min.js')}}"></script>
    <script src="{{__url('{firemoon}/assets/js/bootstrap.bundle.min.js')}}"></script>
    @section("js")
    
    <script src="{{__url('{firemoon}/assets/js/layout.ui.js')}}"></script>        
    @show
        
    </body>
</html>