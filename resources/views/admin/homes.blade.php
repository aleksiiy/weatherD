@extends('admin.index')
@section('styles')
<style>
    .hit-the-floor {
        color: #fff;
        font-size: 10em;
        font-weight: bold;
        font-family: Helvetica;
        text-shadow: 0 1px 0 #ccc, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 0 5px 0 #aaa, 0 6px 1px rgba(0,0,0,.1), 0 0 5px rgba(0,0,0,.1), 0 1px 3px rgba(0,0,0,.3), 0 3px 5px rgba(0,0,0,.2), 0 5px 10px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.2), 0 20px 20px rgba(0,0,0,.15);
    }

    .hit-the-floor {
        text-align: center;
    }

    body {
        background-color: #f1f1f1;
    }
</style>
@endsection
@section('content')
    <main>
        <body onload="show_text();">
            <p style="display:none" id="pageTextSource">Добро пожаловать!</p>
            <p id="pageText" class="hit-the-floor"></p>
        </body>
    </main>
@endsection
@section('scripts')
    <script>
        var source,dest,len,now=0,delay=200,letters=1;
        function show_text()
        {
            source = document.getElementById("pageTextSource");
            dest = document.getElementById("pageText");
            len = source.innerHTML.length;
            show();
        }

        function show()
        {
            dest.innerHTML += source.innerHTML.substr(now,letters);
            now+=letters;

            if(now<len)
                setTimeout("show()",delay);
        }
    </script>
@endsection