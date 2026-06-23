@extends("install::layout")
    @section("content")
    <section class="mt-5 py-5">
           <aricle class="">
                <div class="col-lg-8 offset-lg-2 col-md-6 col-md-3 col-sm-12">
                    <div class="bg-white border border-secondary p-4 mb-3">
                        <h4 class="fs-4">
                            <span class="mdi mdi-database"></span>
                            {{__("Migraciones")}}
                        </h4>

                        <div class="px-3 mb-3">
                            <div class="d-flex">
                                <div class="col-2">
                                    <strong>Conexion</strong>
                                </div>
                                <div>
                                    : {{env("DB_CONNECTION")}}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-2">
                                    <strong>Host</strong>
                                </div>
                                <div>
                                    : {{env("DB_HOST")}}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-2">
                                    <strong>Puerto</strong>
                                </div>
                                <div>
                                    : {{env("DB_PORT")}}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-2">
                                    <strong>Base de datos</strong>
                                </div>
                                <div>
                                    : {{env("DB_DATABASE")}}
                                </div>
                            </div>
                        </div> 

                        {!! Alert::listener("system", "install::alerts.system") !!}
                        
                        <div>
                            <div class="">
                                <a href="{{__url('/install/env')}}" class="btn btn-outline-secondary rounded-0">
                                    << {{__("Regresar")}}
                                </a>
                                @if($ismigrate)
                                <a href="{{__url('install/database/migrate')}}" 
                                    class="btn btn-secondary rounded-0">
                                    Migrar entidades
                                </a>
                                @else
                                <a href="{{__url('install/database/migrate/refresh')}}" 
                                    class="btn btn-outline-secondary rounded-0">
                                    <span class="mdi mdi-database-refresh-outline"></span>
                                    Refrescar
                                </a>

                                <a href="{{__url('install/database/migrate/reset')}}" 
                                    class="btn btn-outline-secondary rounded-0">
                                    <span class="mdi mdi-database-remove-outline"></span>
                                    Reset
                                </a>

                                <a href="{{__url('/install/account')}}" class="btn btn-outline-secondary rounded-0">
                                    {{__("Siguiente")}} >>
                                </a>
                                @endif
                            </div>
                        </div>                       
                    </div>                    
                </div>
           </aricle>
        </section>
    @endsection