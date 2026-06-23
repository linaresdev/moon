<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <style>
        body{
            background: #f3f3f3;
        }
        h4{
            font-size: 28px;
            margin: 0 0 10px 0;
        }
        p{
            margin: 0 0 3px 0;
        }
        small{
            color: #996;
        }
        .container {
            background: #ffff;
            border: 1px solid #444;
            padding: 20px 15px;
            width: 70%;
            margin: 10% 0 0 15%;
            text-align: center;
        }
        .block{
            padding: 0 0 15px 0;
        }
        .btn {
            background: #fff;
            border: 1px solid #999;
            color: #222;
            display: inline-block;
            font-size: 14px;
            padding: 10px 13px;
            text-decoration: none;            
        }
        .btn:hover{
            opacity: .8;
        }
    </style>
</head>
<body>
    <section class="container">

        <header style="padding-top: 20px;">
            <div class="block">
                <h4>
                    <svg style="width; 32px; height:32px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>weather-night</title><path d="M17.75,4.09L15.22,6.03L16.13,9.09L13.5,7.28L10.87,9.09L11.78,6.03L9.25,4.09L12.44,4L13.5,1L14.56,4L17.75,4.09M21.25,11L19.61,12.25L20.2,14.23L18.5,13.06L16.8,14.23L17.39,12.25L15.75,11L17.81,10.95L18.5,9L19.19,10.95L21.25,11M18.97,15.95C19.8,15.87 20.69,17.05 20.16,17.8C19.84,18.25 19.5,18.67 19.08,19.07C15.17,23 8.84,23 4.94,19.07C1.03,15.17 1.03,8.83 4.94,4.93C5.34,4.53 5.76,4.17 6.21,3.85C6.96,3.32 8.14,4.21 8.06,5.04C7.79,7.9 8.75,10.87 10.95,13.06C13.14,15.26 16.1,16.22 18.97,15.95M17.33,17.97C14.5,17.81 11.7,16.64 9.53,14.5C7.36,12.31 6.2,9.5 6.04,6.68C3.23,9.82 3.34,14.64 6.35,17.66C9.37,20.67 14.19,20.78 17.33,17.97Z" /></svg>    
                    MOON
                </h4> 
            </div> 
            <div class="block">
                <p>
                    {{__("Luna V-1.0 es un aplicativo de gestión enfocado en aplicaciones simple y complejas.")}}
                </p>
                <p>{{__("Al iniciar la instalación aceptas las politicas y observaciones de uso.")}}</p>
            </div>
        </header>

        <article>
            <a class="btn" href="https://github.com/linaresdev/moon/blob/master/POLICIES.md" target="_blank">
                <svg style="width; 20px; height:20px; float:left;margin: 0 3px 0 0;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>eye-outline</title><path d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" /></svg>
                {{__("Politicas")}}
            </a>
            <a class="btn" href="https://github.com/linaresdev/moon" target="_blank">
                <svg style="width; 20px; height:20px; float:left;margin: 0 3px 0 0;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>progress-wrench</title><path d="M13,2.03V2.05L13,4.05C17.39,4.59 20.5,8.58 19.96,12.97C19.5,16.61 16.64,19.5 13,19.93V21.93C18.5,21.38 22.5,16.5 21.95,11C21.5,6.25 17.73,2.5 13,2.03M11,2.06C9.05,2.25 7.19,3 5.67,4.26L7.1,5.74C8.22,4.84 9.57,4.26 11,4.06V2.06M4.26,5.67C3,7.19 2.25,9.04 2.05,11H4.05C4.24,9.58 4.8,8.23 5.69,7.1L4.26,5.67M2.06,13C2.26,14.96 3.03,16.81 4.27,18.33L5.69,16.9C4.81,15.77 4.24,14.42 4.06,13H2.06M7.1,18.37L5.67,19.74C7.18,21 9.04,21.79 11,22V20C9.58,19.82 8.23,19.25 7.1,18.37M16.82,15.19L12.71,11.08C13.12,10.04 12.89,8.82 12.03,7.97C11.13,7.06 9.78,6.88 8.69,7.38L10.63,9.32L9.28,10.68L7.29,8.73C6.75,9.82 7,11.17 7.88,12.08C8.74,12.94 9.96,13.16 11,12.76L15.11,16.86C15.29,17.05 15.56,17.05 15.74,16.86L16.78,15.83C17,15.65 17,15.33 16.82,15.19Z" /></svg>
                {{__("Soporte")}}
            </a>
            <a class="btn" href="{{__url('install/confirm')}}">
                <svg style="width; 20px; height:20px; float:left;margin: 0 3px 0 0;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>registered-trademark</title><path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12.25,13.27H10.81V16.5H9V7.71H12.26C13.29,7.71 14.09,7.94 14.66,8.4C15.22,8.87 15.5,9.5 15.5,10.36C15.5,10.96 15.37,11.46 15.11,11.86C14.85,12.26 14.46,12.58 13.93,12.81L15.83,16.4V16.5H13.89L12.25,13.27M10.81,11.81H12.27C12.72,11.81 13.07,11.69 13.32,11.46C13.57,11.23 13.69,10.91 13.69,10.5C13.69,10.09 13.58,9.77 13.34,9.53C13.11,9.29 12.75,9.18 12.26,9.18H10.81V11.81Z" /></svg>
                {{__("Aceptar e iniciar instalación")}}
            </a>
        </article>

    </section>
</body>
</html>