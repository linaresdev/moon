@extends("install::layout")
    @section("content")

        <section class="mt-5 py-5">
            <article class="col-lg-10 offset-lg-1 cl-md-12">
                <div class="bg-white border border-secondary p-4">
                     <h4 class="fs-4">
                         <span class="mdi mdi-cog"></span>
                         Env
                     </h4>
     
                     <p class="mb-2">
                         <span class="mdi mdi-laravel"></span>
                         Ambiente de trabajo de Laravel
                     </p>
                     <div>
                         <form action="{{__url('install/env')}}" method="POST">
                             <div class="mb-2 p-3">
                                 <textarea class="form-control my-2"
                                     name="editor" 
                                     placeholder="Editor" 
                                     id="editor" 
                                     style="min-height: 300px">{{$env}}</textarea>
                             </div>
                             <div>
                                 @csrf
                                 <a href="{{__url('/install')}}" class="btn btn-outline-secondary rounded-0">
                                     << {{__("Regresar")}}
                                 </a>
                                 <button type="submit" 
                                     class="btn btn-outline-secondary rounded-0">
                                     Actualizar
                                 </button>
     
                                 <a href="{{__url('install/env/publish')}}" class="btn btn-outline-secondary rounded-0">
                                     {{__("Publicar ficheros")}}
                                 </a>
     
                                 <a href="{{__url('install/database')}}" class="btn btn-outline-secondary rounded-0">
                                     {{__("Siguiente")}} >>
                                 </a>
                             </div>
                         </form>
     
                     </div>
                </div>

            </article>
        </section>
    @endsection