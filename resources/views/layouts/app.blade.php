<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- @yield('asset__01') --}}

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/pdf_js_lib/pdf.js') }}"></script>

    <link href="{{asset('css/loader_css/loader_style.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('css/cover_page28jul.css')}}" rel="stylesheet"> --}}
    <script src="{{asset('js/sakura_.js')}}"></script>

    <link rel="stylesheet" href="{{ asset('css/input_field.css') }}">
    @yield('asset_addition')

    <style>
        canvas {
            padding:0;
            margin:0;
        }
        div.btnbg {
            position:fixed;
            left:0;
            top:0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);

        }

    </style>

</head>
<body>
    <div class="loading_container">
        <div class="sk-cube-grid">
            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>
          </div>
    </div>

    <canvas id="sakura"></canvas>
    <div class="btnbg">



    {{-- <div class="cover28jul_container" id="closeCover28jul">
        <div class="cover28jul_minicontainer">
            <a href="https://web.ocsc.go.th/forking" style="width: 100%">
                <img class="cover28jul_img" src="https://www.ocsc.go.th/sites/default/files/field/image/forking-create-02-tn.jpg" />
            </a>
            <div class="divclosebtn">
                <button class="closebtn" onclick="closeCover28jul()">เข้าสู่เว็บไซต์</button>
            </div>
        </div>
    </div> --}}



    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</div>

{{-- ************************************************************************************ --}}
    <script>
        $(document).ready(function() {
            setTimeout(function(){
                $(".loading_container").fadeOut("slow");
                    },1200);
        });
        function closeCover28jul() {
            document.getElementById("closeCover28jul").style.display = "none";
        }
    </script>

    <!-- sakura shader -->
    <script id="sakura_point_vsh" type="x-shader/x_vertex">
    uniform mat4 uProjection;
    uniform mat4 uModelview;
    uniform vec3 uResolution;
    uniform vec3 uOffset;
    uniform vec3 uDOF;  //x:focus distance, y:focus radius, z:max radius
    uniform vec3 uFade; //x:start distance, y:half distance, z:near fade start

    attribute vec3 aPosition;
    attribute vec3 aEuler;
    attribute vec2 aMisc; //x:size, y:fade

    varying vec3 pposition;
    varying float psize;
    varying float palpha;
    varying float pdist;

    //varying mat3 rotMat;
    varying vec3 normX;
    varying vec3 normY;
    varying vec3 normZ;
    varying vec3 normal;

    varying float diffuse;
    varying float specular;
    varying float rstop;
    varying float distancefade;

    void main(void) {
        // Projection is based on vertical angle
        vec4 pos = uModelview * vec4(aPosition + uOffset, 1.0);
        gl_Position = uProjection * pos;
        gl_PointSize = aMisc.x * uProjection[1][1] / -pos.z * uResolution.y * 0.5;

        pposition = pos.xyz;
        psize = aMisc.x;
        pdist = length(pos.xyz);
        palpha = smoothstep(0.0, 1.0, (pdist - 0.1) / uFade.z);

        vec3 elrsn = sin(aEuler);
        vec3 elrcs = cos(aEuler);
        mat3 rotx = mat3(
            1.0, 0.0, 0.0,
            0.0, elrcs.x, elrsn.x,
            0.0, -elrsn.x, elrcs.x
        );
        mat3 roty = mat3(
            elrcs.y, 0.0, -elrsn.y,
            0.0, 1.0, 0.0,
            elrsn.y, 0.0, elrcs.y
        );
        mat3 rotz = mat3(
            elrcs.z, elrsn.z, 0.0,
            -elrsn.z, elrcs.z, 0.0,
            0.0, 0.0, 1.0
        );
        mat3 rotmat = rotx * roty * rotz;
        normal = rotmat[2];

        mat3 trrotm = mat3(
            rotmat[0][0], rotmat[1][0], rotmat[2][0],
            rotmat[0][1], rotmat[1][1], rotmat[2][1],
            rotmat[0][2], rotmat[1][2], rotmat[2][2]
        );
        normX = trrotm[0];
        normY = trrotm[1];
        normZ = trrotm[2];

        const vec3 lit = vec3(0.6917144638660746, 0.6917144638660746, -0.20751433915982237);

        float tmpdfs = dot(lit, normal);
        if(tmpdfs < 0.0) {
            normal = -normal;
            tmpdfs = dot(lit, normal);
        }
        diffuse = 0.4 + tmpdfs;

        vec3 eyev = normalize(-pos.xyz);
        if(dot(eyev, normal) > 0.0) {
            vec3 hv = normalize(eyev + lit);
            specular = pow(max(dot(hv, normal), 0.0), 20.0);
        }
        else {
            specular = 0.0;
        }

        rstop = clamp((abs(pdist - uDOF.x) - uDOF.y) / uDOF.z, 0.0, 1.0);
        rstop = pow(rstop, 0.5);
        //-0.69315 = ln(0.5)
        distancefade = min(1.0, exp((uFade.x - pdist) * 0.69315 / uFade.y));
    }
    </script>
    <script id="sakura_point_fsh" type="x-shader/x_fragment">
    #ifdef GL_ES
    //precision mediump float;
    precision highp float;
    #endif

    uniform vec3 uDOF;  //x:focus distance, y:focus radius, z:max radius
    uniform vec3 uFade; //x:start distance, y:half distance, z:near fade start

    const vec3 fadeCol = vec3(0.08, 0.03, 0.06);

    varying vec3 pposition;
    varying float psize;
    varying float palpha;
    varying float pdist;

    //varying mat3 rotMat;
    varying vec3 normX;
    varying vec3 normY;
    varying vec3 normZ;
    varying vec3 normal;

    varying float diffuse;
    varying float specular;
    varying float rstop;
    varying float distancefade;

    float ellipse(vec2 p, vec2 o, vec2 r) {
        vec2 lp = (p - o) / r;
        return length(lp) - 1.0;
    }

    void main(void) {
        vec3 p = vec3(gl_PointCoord - vec2(0.5, 0.5), 0.0) * 2.0;
        vec3 d = vec3(0.0, 0.0, -1.0);
        float nd = normZ.z; //dot(-normZ, d);
        if(abs(nd) < 0.0001) discard;

        float np = dot(normZ, p);
        vec3 tp = p + d * np / nd;
        vec2 coord = vec2(dot(normX, tp), dot(normY, tp));

        //angle = 15 degree
        const float flwrsn = 0.258819045102521;
        const float flwrcs = 0.965925826289068;
        mat2 flwrm = mat2(flwrcs, -flwrsn, flwrsn, flwrcs);
        vec2 flwrp = vec2(abs(coord.x), coord.y) * flwrm;

        float r;
        if(flwrp.x < 0.0) {
            r = ellipse(flwrp, vec2(0.065, 0.024) * 0.5, vec2(0.36, 0.96) * 0.5);
        }
        else {
            r = ellipse(flwrp, vec2(0.065, 0.024) * 0.5, vec2(0.58, 0.96) * 0.5);
        }

        if(r > rstop) discard;

        vec3 col = mix(vec3(1.0, 0.8, 0.75), vec3(1.0, 0.9, 0.87), r);
        float grady = mix(0.0, 1.0, pow(coord.y * 0.5 + 0.5, 0.35));
        col *= vec3(1.0, grady, grady);
        col *= mix(0.8, 1.0, pow(abs(coord.x), 0.3));
        col = col * diffuse + specular;

        col = mix(fadeCol, col, distancefade);

        float alpha = (rstop > 0.001)? (0.5 - r / (rstop * 2.0)) : 1.0;
        alpha = smoothstep(0.0, 1.0, alpha) * palpha;

        gl_FragColor = vec4(col * 0.5, alpha);
    }
    </script>
    <!-- effects -->
    <script id="fx_common_vsh" type="x-shader/x_vertex">
    uniform vec3 uResolution;
    attribute vec2 aPosition;

    varying vec2 texCoord;
    varying vec2 screenCoord;

    void main(void) {
        gl_Position = vec4(aPosition, 0.0, 1.0);
        texCoord = aPosition.xy * 0.5 + vec2(0.5, 0.5);
        screenCoord = aPosition.xy * vec2(uResolution.z, 1.0);
    }
    </script>
    <script id="bg_fsh" type="x-shader/x_fragment">
    #ifdef GL_ES
    //precision mediump float;
    precision highp float;
    #endif

    uniform vec2 uTimes;

    varying vec2 texCoord;
    varying vec2 screenCoord;

    void main(void) {
        vec3 col;
        float c;
        vec2 tmpv = texCoord * vec2(0.8, 1.0) - vec2(0.95, 1.0);
        c = exp(-pow(length(tmpv) * 1.8, 2.0));
        col = mix(vec3(0.02, 0.0, 0.03), vec3(0.96, 0.98, 1.0) * 1.5, c);
        gl_FragColor = vec4(col * 0.5, 1.0);
    }
    </script>
    <script id="fx_brightbuf_fsh" type="x-shader/x_fragment">
    #ifdef GL_ES
    //precision mediump float;
    precision highp float;
    #endif
    uniform sampler2D uSrc;
    uniform vec2 uDelta;

    varying vec2 texCoord;
    varying vec2 screenCoord;

    void main(void) {
        vec4 col = texture2D(uSrc, texCoord);
        gl_FragColor = vec4(col.rgb * 2.0 - vec3(0.5), 1.0);
    }
    </script>
    <script id="fx_dirblur_r4_fsh" type="x-shader/x_fragment">
    #ifdef GL_ES
    //precision mediump float;
    precision highp float;
    #endif
    uniform sampler2D uSrc;
    uniform vec2 uDelta;
    uniform vec4 uBlurDir; //dir(x, y), stride(z, w)

    varying vec2 texCoord;
    varying vec2 screenCoord;

    void main(void) {
        vec4 col = texture2D(uSrc, texCoord);
        col = col + texture2D(uSrc, texCoord + uBlurDir.xy * uDelta);
        col = col + texture2D(uSrc, texCoord - uBlurDir.xy * uDelta);
        col = col + texture2D(uSrc, texCoord + (uBlurDir.xy + uBlurDir.zw) * uDelta);
        col = col + texture2D(uSrc, texCoord - (uBlurDir.xy + uBlurDir.zw) * uDelta);
        gl_FragColor = col / 5.0;
    }
    </script>
    <!-- effect fragment shader template -->
    <script id="fx_common_fsh" type="x-shader/x_fragment">
    #ifdef GL_ES
    //precision mediump float;
    precision highp float;
    #endif
    uniform sampler2D uSrc;
    uniform vec2 uDelta;

    varying vec2 texCoord;
    varying vec2 screenCoord;

    void main(void) {
        gl_FragColor = texture2D(uSrc, texCoord);
    }
    </script>
    <!-- post processing -->
    <script id="pp_final_vsh" type="x-shader/x_vertex">
    uniform vec3 uResolution;
    attribute vec2 aPosition;
    varying vec2 texCoord;
    varying vec2 screenCoord;
    void main(void) {
        gl_Position = vec4(aPosition, 0.0, 1.0);
        texCoord = aPosition.xy * 0.5 + vec2(0.5, 0.5);
        screenCoord = aPosition.xy * vec2(uResolution.z, 1.0);
    }
    </script>
    <script id="pp_final_fsh" type="x-shader/x_fragment">
    #ifdef GL_ES
    //precision mediump float;
    precision highp float;
    #endif
    uniform sampler2D uSrc;
    uniform sampler2D uBloom;
    uniform vec2 uDelta;
    varying vec2 texCoord;
    varying vec2 screenCoord;
    void main(void) {
        vec4 srccol = texture2D(uSrc, texCoord) * 2.0;
        vec4 bloomcol = texture2D(uBloom, texCoord);
        vec4 col;
        col = srccol + bloomcol * (vec4(1.0) + srccol);
        col *= smoothstep(1.0, 0.0, pow(length((texCoord - vec2(0.5)) * 2.0), 1.2) * 0.5);
        col = pow(col, vec4(0.45454545454545)); //(1.0 / 2.2)

        gl_FragColor = vec4(col.rgb, 1.0);
        gl_FragColor.a = 1.0;
    }
    </script>
</body>
</html>
