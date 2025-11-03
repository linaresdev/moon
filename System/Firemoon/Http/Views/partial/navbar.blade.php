        
        <nav class="bg-white fixed-top">

            <div class="navbar navbar-expand-md bg-dark shadow-sm border-botton" data-bs-theme="dark">
                <div class="container"> 

                    <a href="{{__url('{home}')}}" class="navbar-brand">
                        <span class="mdi mdi-progress-wrench"></span> Delta
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
                                <a href="#" class="nav-link dropdown-toggle py-0" data-bs-toggle="dropdown">
                                    <span class="mdi mdi-power-plug-outline mdi-24px"></span>
                                    {{__("words.connected")}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{__url('logout')}}" class="dropdown-item">
                                        <span class="mdi mdi-power-plug-off-outline mdi-18px"></span>
                                        {{__("words.disconnected")}}
                                    </a>
                                </div>
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>              
            </div>    
        </nav>