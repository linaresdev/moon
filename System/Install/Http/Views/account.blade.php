@extends("install::layout")
    @section("content")
    
        <section class="mt-5 py-5">
            <article class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="bg-white border border-secondary p-4 mb-3">
                    <div class="p-4">
                        <form action="{{__url(request()->path())}}" method="POST">

                            <h4 class="fs-4 mb-3">
                                <span class="mdi mdi-progress-pencil mdi-24px"></span>
                                {{ __("Formulario") }}
                            </h4>

                            @if( $errors->any())
                            <div class="alert alert-danger p-2 rounded-0">
                                @foreach($errors->all() as $message)
                                <p class="m-0"> -- {{$message}}</p>
                                @endforeach
                            </div>
                            @endif

                            <div class="my-4">
                                <hr>
                            </div> 


                            <h4 class="fs-4 mb-3">
                                <span class="mdi mdi-progress-star mdi-24px"></span>
                                {{ __("Nómbre del proyecto") }}
                            </h4>

                            <div class="form-floating mb-3">
                                <input type="text" 
                                    name="appname" 
                                    value="{{old('appname')}}" 
                                    id="appname" 
                                    class="form-control @error('appname') is-invalid @enderror"
                                    placeholder="{{__('Nombre para el aplpicativo')}}">
                                <label for="appname">{{__('Nómbre del aplicativo')}}</label>
                            </div> 
                            <div class="form-floating mb-3">
                                <input type="text" 
                                    name="slogan" 
                                    value="{{old('slogan')}}" 
                                    id="slogan" 
                                    class="form-control @error('slogan') is-invalid @enderror"
                                    placeholder="{{__('Descripcion corta para el aplicativo')}}">
                                <label for="slogan">{{__('Descripción corta del aplicativo')}}</label>
                            </div> 

                            <div class="my-4">
                                <hr>
                            </div> 

                            <h4 class="fs-4 mb-3">
                                <span class="mdi mdi-account-circle-outline mdi-24px"></span>
                                {{ __("Cuenta administrativa") }}
                            </h4>
                        
                            <div class="d-flex">
                                <div class="flex-fill me-1">
                                    <div class="form-floating mb-3">
                                        <input type="text" 
                                            name="firstname" 
                                            value="{{old('firstname')}}" 
                                            id="firstname" 
                                            class="form-control @error('firstname') is-invalid @enderror"
                                            placeholder="{{__('Nombre')}}">
                                        <label for="firstname">{{__('Nómbre')}}</label>
                                    </div>
                                </div>
                                <div class="flex-fill">
                                    <div class="form-floating mb-3">
                                        <input type="text" 
                                            name="lastname" 
                                            value="{{old('lastname')}}" 
                                            id="lastname" 
                                            class="form-control @error('lastname') is-invalid @enderror"
                                            placeholder="{{__('Apellidos')}}">
                                        <label for="lastname">{{__('Apellidos')}}</label>
                                    </div>
                                </div>
                            </div>  
                            <div class="form-floating mb-3">
                                <input type="email" 
                                    name="email" 
                                    value="{{old('email')}}" 
                                    id="email" 
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="{{__('Correo electrónico')}}">
                                <label for="email">{{__('Correo electrónico')}}</label>
                            </div> 
                            <div class="form-floating mb-3">
                                <input type="password" 
                                    name="password" 
                                    value="{{old('password')}}" 
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="{{__('Contraseña')}}">
                                <label for="password">{{__('Contraseña')}}</label>
                            </div> 
                            
                            <div>
                                @csrf
                                <a href="{{__url('/install/database')}}" class="btn btn-outline-secondary rounded-0">
                                    << {{__("Regresar")}}
                                </a>

                                <button type="submit" 
                                    class="btn btn-success rounded-0">
                                    <span class="mdi mdi-camera-iris"></span>
                                    {{__("Finalizar")}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        </section>

    @endsection