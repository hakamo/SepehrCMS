<div class="navbar-wrapper">
    <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">{{$configuration["SiteName"]}}</a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">

                         {{ $menues->get_menu_html(0,"class=\"nav navbar-nav\"","class=\"dropdown\"") }}

                          <form class="navbar-form navbar-left" action="{{route('cms.SearchPages')}}">
                              <div class="form-group">
                                  <input name="search-value" type="text" class="form-control" placeholder="جستجو در سایت">
                                  <input name="language" type="text" hidden="hidden" value="{{$language}}" >
                              </div>
                              <button type="submit" class="btn btn-default">شروع</button>
                          </form>
                </div>

            </div>
        </nav>

    </div>
</div>
