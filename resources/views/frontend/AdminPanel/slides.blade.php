@extends('frontend.AdminPanel.layout.master')

@section('content')

  <div class="panel panel-primary">
      <div class="panel-heading">
          <h5>اسلاید تصاویر</h5>
      </div>
      <div class="panel-body">
              <div id="tabstrip">
                  <ul>
                      @for ($i = 0; $i < sizeof($GLOBALS['languages']) ; $i++)
      
                             <li>{{$GLOBALS['languages'][$i][0]}}</li>

                      @endfor
                  </ul>
              </div>
      </div>
  </div>

<script>

    $(document).ready(function () {      


        $( "#tabstrip ul li:last-child" ).addClass("k-state-active");

        var ts = $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn" } },
            contentUrls: [

                @for ($i = 0; $i < sizeof($GLOBALS['languages']) ; $i++)

                '{{route('cms.AdminPanelSlides').'/'.$GLOBALS['languages'][$i][1].'/view'}}',

                @endfor

        ]}).data('kendoTabStrip');
    });





</script>

<style>
    .wrapper {
        /*height: 455px;*/
        margin: 20px auto;
        padding: 20px 0 0 0;
        /*background: url('../content/web/tabstrip/bmw.png') no-repeat center 60px transparent;*/
    }

    #tabstrip {
        /*max-width: 400px;*/
        float: right;
        margin-bottom: 20px;
    }

        #tabstrip .k-content {
            /*height: 320px;*/
            overflow: auto;
        }

    .specification {
        /*max-width: 670px;*/
        margin: 10px 0;
        padding: 0;
    }

        .specification dt, dd {
            /*max-width: 140px;*/
            float: left;
            margin: 0;
            padding: 5px 0 8px 0;
        }

        .specification dt {
            clear: left;
            width: 100px;
            margin-right: 7px;
            padding-right: 0;
            opacity: 0.7;
        }

        .specification:after, .wrapper:after {
            content: ".";
            display: block;
            clear: both;
            height: 0;
            visibility: hidden;
        }
</style>

@endsection