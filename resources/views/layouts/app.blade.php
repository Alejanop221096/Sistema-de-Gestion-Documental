<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema Archivo')</title>
    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }
        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-size: 15px;
        }
        .sidebar a:hover {
            background: #495057;
            color: #fff;
        }
        .sidebar .title {
            color: #fff;
            font-size: 20px;
            padding-left: 20px;
            margin-bottom: 20px;
        }
        .content {
            margin-left: 230px;
            padding: 25px;
        }
        .escudo {
            width: 120px;
            height: 120px;
            display: block;
            margin: auto;
        }
        .title{
            text-align: center;
        }
        .editar{
            background-color:#343a40;
            padding: 10px;
            height: 300px;
            display: flex;
            flex-direction: column;
            align-items:center;
                justify-content: space-evenly;
        }
    </style>

</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="title">Archivo General Municipal</div>
        <img class="escudo" src="https://www.zinacantepec.gob.mx/img/escudo.png">

        <a href="/panel">Inicio</a>
        <a href="/usuarios">Usuarios</a>
        <a href="/archivo_historico">Archivo Historico</a>
        

        <hr class="text-white">

        <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-danger w-75 ms-3 mt-2">Cerrar sesión</button>
        </form>
    </div>

    <!-- CONTENIDO -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>
