  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          @foreach($navigation as $item)
          @if ($item->navigation == 'main')
          <li>{{HTML::link($item->slug, $item->title)}}</li>
          @endif
          @endforeach
        </ul>

        @foreach($navigation as $item)
        @if ($item->navigation == 'dropdown')
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
            <ul class="dropdown-menu">
              @foreach($navigation as $item)
              @if ($item->navigation == 'dropdown')
              <li>{{HTML::link($item->slug, $item->title)}}</li>
              @endif
              @endforeach
              <!--  <li class="divider"></li> -->
            </ul>
          </li>
        </ul>
        @break
        @endif     
        @endforeach
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>