var updtUserForm = document.getElementById("updtUserForm");

if (updtUserForm) {
    updtUserForm.addEventListener('submit', function (e) {
        e.preventDefault()

        var datos = new FormData(updtUserForm)

        $.ajax({
            type: "PUT",
            url: "http://localhost:8080/Cosas/blog_api/back-end/api/users/updtUser.php",
            data: JSON.stringify({
                "user_id": datos.get('user_id'),
                "user_name": datos.get('nombre'),
                "user_email": datos.get('email'),
                "user_rol_id": datos.get('rol')
            }),
            "headers": {
                "Content-Type": "application/json"
            },
            success: function (res) {
                if (res.msg) {
                    window.location.replace("http://localhost:8080/Cosas/blog_api/front-end/admin/usuarios.php")
                } else {
                    $('#mensajes').html("Hubo un error");
                }
            },
            error: function () {
                alert("error")
            }
        })
    })
}

var createUserForm = document.getElementById("createUserForm");

if (createUserForm) {
    createUserForm.addEventListener('submit', function (e) {
        e.preventDefault()

        var datos = new FormData(createUserForm)

        if (datos.get('nombre') == '' || datos.get('email') == '' || datos.get('password') == '') {
            alert("Hay campos vacios")
            return false
        } else {
            if (datos.get('password') != datos.get('confirmar_password')) {
                alert("Las contraseñas no coinciden")
                return false
            } else {
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/Cosas/blog_api/back-end/api/users/createUser.php",
                    data: JSON.stringify({
                        "user_name": datos.get('nombre'),
                        "user_email": datos.get('email'),
                        "user_password": datos.get('password')
                    }),
                    "headers": {
                        "Content-Type": "application/json"
                    },
                    success: function (res) {
                        if (res.msg) {
                            window.location.replace("http://localhost:8080/Cosas/blog_api/front-end/acceder.php")
                        } else {
                            $('#mensajes').html("Hubo un error");
                        }
                    },
                    error: function () {
                        alert("error")
                    }
                })
            }
        }
    })
}

var loginForm = document.getElementById("loginForm")

if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
        e.preventDefault()

        var datos = new FormData(loginForm)

        if (datos.get('email') == '' || datos.get('password') == '') {
            alert("Hay campos vacios")
            return false
        } else {
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/Cosas/blog_api/back-end/api/users/login.php",
                data: JSON.stringify({
                    "user_email": datos.get('email'),
                    "user_password": datos.get('password')
                }),
                "headers": {
                    "Content-Type": "application/json"
                },
                success: function (res) {
                    if (res.msg) {
                        window.location.replace("http://localhost:8080/Cosas/blog_api/front-end/index.php")
                    } else {
                        $('#mensajes').html("Hubo un error");
                    }
                },
                error: function () {
                    alert("error")
                }
            })
        }
    })
}