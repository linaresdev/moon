@extends($skin->path())

    @section("body")  
        
    <article class="container-fluid">
        
        @if( auth()->check() )
        <section class="row">
            <article class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1 py-5">
                <div class="border border-secondary p-3">
                    <div class="px-3 text-success">
                        <h4 class="fs-4 m-0">
                            Ups!
                        </h4>
                        <p class="m-0">
                            {{__("auth.logged")}}
                        </p>
                    </div>

                    <hr class="border-3 border-dark">

                    <div class="p-3">
                        <a href="{{__url('/')}}" class="btn btn-outline-secondary rounded-0">
                            <span class="mdi mdi-close"></span>
                            {{__("close.window")}}
                        </a>

                        <a href="{{__url('logout')}}" class="btn btn-outline-danger rounded-0">
                            <span class="mdi mdi-logout"></span>
                            {{__("auth.logout")}}
                        </a>
                    </div>
                </div>
            </article>
        </section>
        @else
        <section class="row">
            <article class="col-6 bg-success-subtle text-success text-center vh-100">            

                <div class="position-absolute top-50 w-50">
                    <h1 class="fs-1">
                        <span class="mdi mdi-weather-night" style="font-size:128px;"></span>
                    </h1>
                </div>

            </article>

            <article class="col-6 py-5">
                <section class="auth mx-auto py-4 " 
                    style="max-width:480px;">

                    <header class="auth-header ">
                        <h5 class="fs-5">
                            <span class="mdi mdi-lock"></span>
                            {{$title}}
                        </h5>
                    </header>

                    <article class="auth-body">
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
                                    placeholder="{{__('Usuario o Email')}}">

                                <label for="user">{{__("Usuario o Email")}}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" 
                                    name="pwd" 
                                    value="{{old('pwd')}}"
                                    id="pwd"
                                    class="form-control rounded-0 @error('pwd') is-invalid @enderror"
                                    placeholder="{{__('Su clave de acceso')}}">

                                <label for="user">{{__("Su clave de acceso")}}</label>
                            </div>

                            <div class="mb-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary rounded-0">
                                    <span class="mdi mdi-login"></span>
                                    {{__("Acceder")}}
                                </button>

                                <a href="#" class="btn">{{__("Solicitar mi cuenta")}}</a>
                            </div>
                        </form>
                    </article>

                </section>
            </article>
        </section>
    </article>
    @endif
    @endsection