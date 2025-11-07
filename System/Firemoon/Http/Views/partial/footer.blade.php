
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