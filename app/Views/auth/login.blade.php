<!DOCTYPE html>
<html lang="en" class="coming-soon">

<head>
    <meta charset="utf-8">
    <title>Resto App</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="author" content="KaijuThemes">
    <link rel="icon" href="{{ base_url }}assets/auth/restologo.png" type="image/png" sizes="16x16">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet'
        type='text/css'>
    <link type="text/css" href="{{ base_url }}assets/template/assets/plugins/iCheck/skins/minimal/blue.css"
        rel="stylesheet">
    <link type="text/css" href="{{ base_url }}assets/template/assets/fonts/font-awesome/css/font-awesome.min.css"
        rel="stylesheet">
    <link type="text/css" href="{{ base_url }}assets/template/assets/fonts/themify-icons/themify-icons.css"
        rel="stylesheet"> <!-- Themify Icons -->
    <link type="text/css" href="{{ base_url }}assets/template/assets/css/styles.css" rel="stylesheet">
    <style>
        .login-logo {
            color: #A4A6B3 !important;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px !important;
        }

        .auth-logo {
            margin-top: 120px;
            margin-bottom: -110px;
        }

        body {
            background-color: #fafafa !important;
        }
    </style>
</head>

<body class="focused-form animated-content">


    <div class="container" id="login-form">
        <form class="form-horizontal" id="validate-form">
            <div class="text-center">
                <img src="{{ base_url }}assets/auth/restologo.png" alt="Application logo" class="auth-logo" />
                <a href="#" class="login-logo">CGP</a>
                <h3><b>Log In Ke CGP</b></h3>
                <p style="color: #A4A6B3">Masukan Id dan Password</p>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group mb-md">
                                <div class="col-xs-12">
                                    <label for="email">ID PEGAAWAI</label>
                                    <input type="email" class="form-control" placeholder="ID PEGAAWAI" id="email" required>
                                </div>
                            </div>

                            <div class="form-group mb-md">
                                <div class="col-xs-12">
                                    <label for="password">PASSWORD</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="clearfix">
                                <button type="submit" class="btn btn-primary btn-block">Log in</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!-- Load site level scripts -->

    <script type="text/javascript" src="{{ base_url }}assets/template/assets/js/jquery-1.10.2.min.js"></script> <!-- Load jQuery -->
    <script type="text/javascript" src="{{ base_url }}assets/template/assets/js/jqueryui-1.10.3.min.js"></script> <!-- Load jQueryUI -->
    <script type="text/javascript" src="{{ base_url }}assets/template/assets/js/bootstrap.min.js"></script> <!-- Load Bootstrap -->
    <script type="text/javascript" src="{{ base_url }}assets/template/assets/js/enquire.min.js"></script> <!-- Load Enquire -->

    <script type="text/javascript" src="{{ base_url }}assets/template/assets/plugins/velocityjs/velocity.min.js">
    </script> <!-- Load Velocity for Animated Content -->
    <script type="text/javascript" src="{{ base_url }}assets/template/assets/plugins/velocityjs/velocity.ui.min.js">
    </script>

    <script type="text/javascript" src="{{ base_url }}assets/template/assets/plugins/wijets/wijets.js"></script> <!-- Wijet -->

    <script type="text/javascript" src="{{ base_url }}assets/template/assets/plugins/codeprettifier/prettify.js">
    </script> <!-- Code Prettifier  -->
    <script type="text/javascript"
        src="{{ base_url }}assets/template/assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> <!-- Swith/Toggle Button -->

    <script type="text/javascript"
        src="{{ base_url }}assets/template/assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script> <!-- Bootstrap Tabdrop -->

    <script type="text/javascript"
        src="{{ base_url }}assets/template/assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->
    <script type="text/javascript" src="{{ base_url }}assets/template/assets/js/application.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- End loading site level scripts -->
    <!-- Load page level scripts-->
    <script>
        $('#validate-form').submit(ev => {
            ev.preventDefault()

            let email = $('#email').val()
            let password = $('#password').val()

            $.ajax({
                method: 'post',
                url: '{{ base_url }}doLogin',
                data: {
                    email: email,
                    password: password
                },
                success(data) {
                    data = JSON.parse(data)
                    if (data.status > 0) {
                        toastr.success(`Selamat datang ${data.data.name}`, 'Login Success')

                        setTimeout(() => {
                            location.href = '{{ base_url }}'
                        }, 1000);
                    } else {
                        $('#password').val('')
                        toastr.warning(data.message, 'Login Failure')
                    }
                }
            })
        })
    </script>

    <!-- End loading page level scripts-->
</body>

</html>
