@extends('layouts.app_cosmika')


@section('template_title')
   Revista
@endsection

@section('css_custom')

    <style type="text/css">
      .container {
        height: 93vh;
        width: 100%;
      }

    </style>

<link href="{{asset('assets/user/custom/nosotros.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="primario bg_overley" style="">
    {{-- <div class="container" id="container1"></div> --}}

    <div class="d-flex justify-content-center">
        <iframe src="https://cosmicaskin.com/protocolo/" frameborder="0" class="container" style="margin-top: 6rem"></iframe>
    </div>


</section>

@endsection

@section('js')

    <!-- Scripts necesarios -->
    {{-- <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/html2canvas.min.js')}}"></script>
    <script src="{{asset('js/three.min.js')}}"></script>
    <script src="{{asset('js/pdf.min.js')}}"></script>
    <script src="{{asset('js/3dflipbook.min.js')}}"></script> --}}


    {{-- <script type="text/javascript">

        var template = {
          html: 'templates/default-book-view.html',
          links: [{
            rel: 'stylesheet',
            href: 'css/font-awesome.min.css'
          }],
          styles: [
            'css/short-black-book-view.css'
          ],
          script: 'js/default-book-view.js'
        };

        // Book 1 {
        $('#container1').FlipBook({
          pdf: '{{asset('books/pdf/revista_comprimida.pdf')}}',
          template: template
        });
        // }

        // }

      </script> --}}


@endsection


