

<nav class="navbar navbar-default" style="background-color:#BEBEBE;">
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>

    <div class="collapse navbar-collapse js-navbar-collapse " >

        <ul class="nav navbar-nav navbar-left" >	

            <li class="dropdown mega-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Collection  <span class="caret"></span></a>				
                <ul class="dropdown-menu mega-dropdown-menu row">
                    <li class="col-sm-3">
                        <ul>
                            <li class="dropdown-header">New in Stores</li>                            
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <a href="#"><img src="http://placehold.it/254x150/3498db/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 1"></a>
                                        <h4><small>Summer dress floral prints</small></h4>                                        

                                    </div><!-- End Item -->
                                    <div class="item">
                                        <a href="#"><img src="http://placehold.it/254x150/ef5e55/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 2"></a>
                                        <h4><small>Gold sandals with shiny touch</small></h4>                                        

                                    </div><!-- End Item -->
                                    <div class="item">
                                        <a href="#"><img src="http://placehold.it/254x150/2ecc71/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 3"></a>
                                        <h4><small>Denin jacket stamped</small></h4>                                        

                                    </div><!-- End Item -->                                
                                </div><!-- End Carousel Inner -->
                            </div><!-- /.carousel -->
                            <li class="divider"></li>
                            <li><a href="#">View all Collection <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul>
                            <li class="dropdown-header">Dresses</li>
                            <li><a href="#">Unique Features</a></li>
                            <li><a href="#">Image Responsive</a></li>
                            <li><a href="#">Auto Carousel</a></li>
                            <li><a href="#">Newsletter Form</a></li>
                            <li><a href="#">Four columns</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Tops</li>
                            <li><a href="#">Good Typography</a></li>
                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul>
                            <li class="dropdown-header">Jackets</li>
                            <li><a href="#">Easy to customize</a></li>
                            <li><a href="#">Glyphicons</a></li>
                            <li><a href="#">Pull Right Elements</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Pants</li>
                            <li><a href="#">Coloured Headers</a></li>
                            <li><a href="#">Primary Buttons & Default</a></li>
                            <li><a href="#">Calls to action</a></li>
                        </ul>
                    </li>
                    <li class="col-sm-3">
                        <ul>
                            <li class="dropdown-header">Accessories</li>
                            <li><a href="#">Default Navbar</a></li>
                            <li><a href="#">Lovely Fonts</a></li>
                            <li><a href="#">Responsive Dropdown </a></li>							
                            <li class="divider"></li>
                            <li class="dropdown-header">Newsletter</li>
                            <form class="form" role="form">
                                <div class="form-group">
                                    <label class="sr-only" for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email">                                                              
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                            </form>                                                       
                        </ul>
                    </li>
                </ul>

            </li>	

        </ul>




        @if (Route::has('login'))
        @guest

        <ul class="nav navbar-nav navbar-right" >
            <li class="dropdown ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">login <span class="caret"></span></a>				
                <ul class="dropdown-menu ">   

                    <form  method="POST" action="{{ route('login') }} " >
                        {{ csrf_field() }}
                        <div class="form-group mb-2 {{ $errors->has('login') ? ' has-error' : '' }}">    
                            <input class="form-control" type="text"  name="login" placeholder="E-Mail/User" required autofocus>

                            @if ($errors->has('email'))
                            <strong>{{ $errors->first('login') }}</strong>
                            @endif
                        </div>

                        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input class="form-control" type="password" placeholder="Password" name="password" required> 
                            @if ($errors->has('password'))
                            <strong>{{ $errors->first('password') }}</strong>
                            @endif

                        </div>
                        <button class="btn btn-primary " type="submit">Login</button>    


                    </form>
                    <button style=" position: absolute;bottom: 5px;right: 0px;" class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</button>

                </ul>
            </li>
        </ul>

        @else
        <ul class="nav navbar-nav navbar-right" >  
            <li class="dropdown "> 
                
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                <ul class="dropdown-menu ">  
                    @if(Auth::user()->isAdmin == 1)
                    <li>
                        <a href="{{ route('admin') }}">ProfileAd</a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('UserProfile') }}">Profile</a>
                    </li>

                    @endif
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

        @endguest


        @endif


    </div><!-- /.nav-collapse -->
</nav>



