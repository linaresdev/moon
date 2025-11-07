        
        <nav class="bg-white fixed-top">

            <div class="navbar {{ style('navbar') }} navbar-expand-md shadow-sm border-bottom py-1">
                <div class="{{style('wrapper')}} my-0 py-0"> 

                    <a href="{{__url('/')}}" class="navbar-brand">
                        <span class="mdi mdi-progress-wrench"></span> 
                        {{env("APP_NAME")}}
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
                                <a href="#" class="nav-link dropdown-toggle p-0" 
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="{{__url($login->getAvatar())}}"                                    
                                        class="avatar avatar-circle" 
                                        style="max-width:36px;"
                                        alt="@">
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{__url('admin')}}" class="dropdown-item">
                                        <span class="mdi mdi-cog mdi-18px"></span>
                                        {{__("manage.app")}}
                                    </a>
                                    <a href="{{__url('logout')}}" class="dropdown-item">
                                        <span class="mdi mdi-logout mdi-18px"></span>
                                        {{__("words.logout")}}
                                    </a>
                                </div>
                            </li>
                        </ul>
                        @endif

                    </div>
                </div>              
            </div>    
            
        </nav>