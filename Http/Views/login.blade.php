@extends($skin->path())

    @section("body")
        
    <article class="container-fluid">
        <section class="row">
            <article class="border-start col-lg-6 offset-lg-6 col-md-8 offset-md-2 col-sm-10 offset-sm-1 pt-5 vh-100">
                <section class="auth bg-white border border-secondary mx-auto p-4 rounded-2 shadow" 
                    style="max-width:480px;">

                    <header class="auth-header ">
                        <h5 class="fs-5">
                            <span class="mdi mdi-lock"></span>
                            {{$title}}
                        </h5>
                    </header>

                    <article class="auth-body">
                        <form action="#">
                            <div class="form-floating mb-2">
                                <input type="text" 
                                    name="user" 
                                    value="{{old('user')}}"
                                    id="user"
                                    class="form-control"
                                    placeholder="{{__('Usuario o Email')}}">

                                <label for="user">{{__("Usuario o Email")}}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" 
                                    name="pwd" 
                                    value="{{old('pwd')}}"
                                    id="pwd"
                                    class="form-control"
                                    placeholder="{{__('Su clave de acceso')}}">

                                <label for="user">{{__("Su clave de acceso")}}</label>
                            </div>

                            <div class="mb-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary">
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
    @endsection