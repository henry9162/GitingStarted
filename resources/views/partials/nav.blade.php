    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
                <div class="navbar-header">                 
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>                       
                    <a class="navbar-brand" href="/">Laravel Blog</a>
                </div>
                
                <div  class="collapse navbar-collapse"  id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/') ? "active" : "" }}"><a href="/">Home<span class="sr-only">(current)</span></a></li>
                        <li class="{{ Request::is('blog') ? "active" : "" }}"><a href="/blog">Blog<span class="sr-only">(current)</span></a></li>
                        <li class="{{ Request::is('about') ? "active" : "" }}"><a href="/about">About</a></li>
                        <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="/contact">contact</a></li>
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hello {{  Auth::user()->name}} <span class="caret"></span>
                                </a>                            
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('posts.index') }}">Posts</a></li>
                                    <li><a href="{{ route('categories.index') }}">Categories</a></li>
                                    <li><a href="{{ route('tags.index') }}">Tags</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('logout') }}">Logout</a></li>

                                </ul>
                            </li>
                        @else

                            <a href="{{ route('login') }}" class="btn btn-default btn-sm" style="margin-top:10px;">Login</a>

                        @endif
                    </ul>
                </div><!-- /navbar collaspe --> 
            </div><!-- /navbar fluid -->
        </nav><!-- end of navbar -->
