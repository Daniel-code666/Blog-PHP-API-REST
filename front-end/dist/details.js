var commForm = document.getElementById("commentForm")

if (commForm) {
    commForm.addEventListener('submit', function (e) {
        e.preventDefault()

        var datos = new FormData(commForm)

        if (datos.get("comentario") == '') {
            alert("No hay nada para enviar")
            return false
        } else {
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/Cosas/blog_api/back-end/api/comments/createComm.php",
                data: JSON.stringify({
                    "art_id": datos.get('art_id'),
                    "user_id": datos.get('user_id'),
                    "comm_text": datos.get('comentario')
                }),
                "headers": {
                    "Content-Type": "application/json"
                },
                success: function (res) {
                    if (res.msg) {
                        window.location.reload()
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