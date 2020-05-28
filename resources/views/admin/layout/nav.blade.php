<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="{{asset('admin')}}/images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="{{asset('admin')}}/images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{route('back.index')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    @canany(['index-permissions','all'])
                    <a href="{{route('permission.index')}}"> <i class="menu-icon fa fa-dashboard"></i>Permissions </a>
                    @endcan
                    @canany(['index-roles','all'])
                    <a href="{{route('role.index')}}"> <i class="menu-icon fa fa-dashboard"></i>Roles </a>

                    @endcan
                       @canany(['index-authors','all'])
                       <a href="{{route('author.index')}}"> <i class="menu-icon fa fa-dashboard"></i>Authors </a>

                    @endcan

                    @canany(['index-categories','all'])
                    <a href="{{route('category.index')}}"> <i class="menu-icon fa fa-dashboard"></i>Categories </a>

                 @endcan

                 @canany(['index-post','all'])
                 <a href="{{route('post.index')}}"> <i class="menu-icon fa fa-dashboard"></i>Posts </a>

              @endcan

              @canany(['system-settings','all'])
              <a href="{{route('settings.index')}}"> <i class="menu-icon fa fa-dashboard"></i>Settings </a>

           @endcan



                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
