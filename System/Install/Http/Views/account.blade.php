@extends("install::layout")
    @section("content")
    
        <section class="mt-5 py-5">
            <article class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="bg-white border border-secondary p-4 mb-3">
                    <div class="p-4">
                        <form action="#">

                            <h4 class="fs-4 mb-3">
                                <span class="mdi mdi-progress-star mdi-24px"></span>
                                {{ __("Nombre del proyecto") }}
                            </h4>

                            <div class="form-floating mb-3">
                                <input type="text" 
                                    name="name" 
                                    value="{{old('name', env('APP_NAME'))}}" 
                                    id="name" 
                                    class="form-control"
                                    placeholder="{{__('Nombre')}}">
                                <label for="name">{{__('Nombre')}}</label>
                            </div> 

                            <div class="my-4">
                                <hr>
                            </div> 

                            <h4 class="fs-4 mb-3">
                                <span class="mdi mdi-account-circle-outline mdi-24px"></span>
                                {{ __("Cuenta administrativa") }}
                            </h4>
                        
                            <div class="form-floating mb-3">
                                <input type="text" 
                                    name="name" 
                                    value="{{old('name')}}" 
                                    id="name" 
                                    class="form-control"
                                    placeholder="{{__('Nombre')}}">
                                <label for="name">{{__('Nombre')}}</label>
                            </div>  
                            <div class="form-floating mb-3">
                                <input type="email" 
                                    name="email" 
                                    value="{{old('name')}}" 
                                    id="email" 
                                    class="form-control"
                                    placeholder="{{__('Correo electrónico')}}">
                                <label for="email">{{__('Correo electrónico')}}</label>
                            </div> 
                            <div class="form-floating mb-3">
                                <input type="password" 
                                    name="password" 
                                    value="{{old('password')}}" 
                                    class="form-control"
                                    placeholder="{{__('Contraseña')}}">
                                <label for="password">{{__('Contraseña')}}</label>
                            </div> 
                            
                            <div>
                                <a href="{{__url('/install/database')}}" class="btn btn-outline-secondary rounded-0">
                                    << {{__("Regresar")}}
                                </a>

                                <button type="submit" 
                                    class="btn btn-success rounded-0">
                                    {{__("Finalizar")}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        </section>

    @endsection