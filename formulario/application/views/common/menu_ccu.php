<header id="cm-header">
    <div id="navigation" class="notification-panel">
    </div>
    <!-- Topbar -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <div class="logo">
                    <a href="https://formacionccu.cl/index.php"><img title="CCU" class="img-responsive" id="header-logo" src="https://formacionccu.cl/web/css/themes/ccuv2/images/header-logo-custom1.png" alt="CCU"></a>
                </div>
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-5">
                        <ol class="header-ol">
                            <li>
                                <div class="section-notifications">
                                    <ul id="notifications" class="nav nav-pills pull-right"><li class="user-online"><a href="https://formacionccu.cl/whoisonline.php" target="_self" title="Usuarios en línea"><img src="https://formacionccu.cl/main/img/icons/16/user.png" alt="Usuarios en línea" title="Usuarios en línea"> 11</a></li></ul>
                                </div>
                            </li>
                            <li>
                                <div class="resize_font"><div class="btn-group"><a title="Disminuir tamaño de la fuente" href="#" class="decrease_font btn btn-default"><em class="fa fa-font"></em></a><a title="Restaurar tamaño de la fuente" href="#" class="reset_font btn btn-default"><em class="fa fa-font"></em></a><a title="Aumentar tamaño de la fuente" href="#" class="increase_font btn btn-default"><em class="fa fa-font"></em></a></div></div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fixed navbar -->
    <script>
        $(document).ready(function () {
            $.get('https://formacionccu.cl/main/inc/ajax/message.ajax.php?a=get_count_message', function(data) {
                var countNotifications = (data.ms_friends + data.ms_groups + data.ms_inbox);
                if (countNotifications === 0 ) {
                    $("#count_message_li").addClass('hidden');
                } else {
                    $("#count_message_li").removeClass('hidden');
                    $("#count_message").append(countNotifications);
                }
            });
        });
    </script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="homepage nav-item">
                <a class="nav-link" href="https://formacionccu.cl/index.php" title="Página principal">
                    Página principal
                </a>
            </li>
            <li class="my-course nav-item">
                <a class="nav-link" href="https://formacionccu.cl/user_portal.php?nosession=true" title="Mis cursos">
                    Mis cursos
                </a>
            </li>
            <li class="agenda nav-item">
                <a class="nav-link" href="https://formacionccu.cl/main/calendar/agenda_js.php?type=personal" title="Mi agenda">
                    Mi agenda
                </a>
            </li>
            <li class="my-space nav-item">
                <a class="nav-link" href="https://formacionccu.cl/main/mySpace/" title="Informes">
                    Informes
                </a>
            </li>
            <li class="dashboard nav-item">
                <a class="nav-link" href="https://formacionccu.cl/main/dashboard/index.php" title="Panel de control">
                    Panel de control
                </a>
            </li>
            <li class="admin nav-item">
                <a class="nav-link" href="https://formacionccu.cl/main/admin/" title="Administración">
                    Administración
                </a>
            </li>
            <li class="sala-virtualnav-item">
                <a class="nav-link" href="https://formacionccu.cl/sala.php" title="">
                    Sala Virtual
                </a>
            </li>
            <li class="malla-virtual activenav-item">
                <a class="nav-link" href="https://formacionccu.cl/soon.php" title="">
                    Matriz de entrenamiento
                </a>
            </li>

        </ul>
    </div>
</nav>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://formacionccu.cl/">CCU</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">


                <li class="homepage ">
                    <a href="https://formacionccu.cl/index.php" title="Página principal">
                        Página principal
                    </a>
                </li>


                <li class="my-course ">
                    <a href="https://formacionccu.cl/user_portal.php?nosession=true" title="Mis cursos">
                        Mis cursos
                    </a>
                </li>


                <li class="agenda ">
                    <a href="https://formacionccu.cl/main/calendar/agenda_js.php?type=personal" title="Mi agenda">
                        Mi agenda
                    </a>
                </li>


                <li class="my-space ">
                    <a href="https://formacionccu.cl/main/mySpace/" title="Informes">
                        Informes
                    </a>
                </li>


                <li class="dashboard ">
                    <a href="https://formacionccu.cl/main/dashboard/index.php" title="Panel de control">
                        Panel de control
                    </a>
                </li>


                <li class="admin ">
                    <a href="https://formacionccu.cl/main/admin/" title="Administración">
                        Administración
                    </a>
                </li>
                <li class="sala-virtual">
                    <a href="https://formacionccu.cl/sala.php" title="">
                        Sala Virtual
                    </a>
                </li>
                <li class="malla-virtual active">
                    <a href="https://formacionccu.cl/soon.php" title="">
                        Matriz de entrenamiento
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li id="count_message_li" class="">
                    <a href="">
                        <span id="count_message" class="badge badge-warning"></span>
                    </a>
                </li>
                <li class="dropdown avatar-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img class="img-circle" src="https://formacionccu.cl/main/img/icons/32/unknown.png" alt="Gdm, Jarys">
                        <span class="username-movil">Gdm, Jarys</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="user-header">
                            <div class="text-center">
                                <a href="https://formacionccu.cl/main/auth/profile.php">
                                    <img class="img-circle" src="https://formacionccu.cl/main/img/icons/64/unknown.png" alt="Gdm, Jarys">
                                    <p class="name">Gdm, Jarys</p>
                                </a>
                                <p><i class="fa fa-envelope-o" aria-hidden="true"></i> jarys@gdm.cl</p>
                            </div>
                        </li>
                        <li role="separator" class="divider"></li>


                        <li class="user-body">
                            <a title="Mis certificados" href="https://formacionccu.cl/main/gradebook/my_certificates.php">
                                <em class="fa fa-graduation-cap" aria-hidden="true"></em> Mis certificados
                            </a>
                        </li>

                        <li class="user-body">
                            <a id="logout_button" title="Salir" href="https://formacionccu.cl/index.php?logout=logout&amp;uid=3059">
                                <em class="fa fa-sign-out"></em> Salir
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="nav-tools">

</div>
</header>