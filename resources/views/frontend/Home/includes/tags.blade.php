<style>
    .tags {
        border: solid 1px;
        border-color: #c3be9d;
        background-color: #eee8c3;
        padding: 4px;
        margin: 1px;
        border-radius: 3px;
        display: inline-block;
        font-size: small;
        color: #580303;
        overflow: hidden;
    }

    .tag-container a:hover {
        text-decoration: none;
        text-decoration-skip: none;
        text-orientation: sideways-left;
        color: #369cbd;
        border-color: #a5a2a7;
    }

    .tagColor {
        color: #2390d8;
    }
</style>


<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">تگ های مطالب</h3>
    </div>

    <div class="tag-container" style="margin: 1em;">

        @php
           $tags = explode("-", $configuration["SiteSEOtag"]);
        @endphp

        @foreach ($tags as $tag)
         <a class="tags" href="http://petbaz.com/admin/gallery/تگ های سئو">{{$tag}} <i class="glyphicon glyphicon-tags tagColor"></i></a>
        @endforeach

    </div>

</div>






