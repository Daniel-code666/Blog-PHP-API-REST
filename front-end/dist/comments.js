var updtCommForm = document.getElementById("updtCommForm");

if(updtCommForm){
    updtCommForm.addEventListener('submit', function (e) {
        e.preventDefault()

        var datos = new FormData(updtCommForm)

        $.ajax({
            type: "PUT",
            url: "http://localhost:8080/Cosas/blog_api/back-end/api/comments/updtComm.php",
            data: JSON.stringify({
                "comm_id":datos.get('comm_id'),
                "comm_estate":datos.get('cambiarEstado')
            }),
            "headers": {
                "Content-Type": "application/json"
            },
            success: function(res){
                if(res.msg){
                    window.location.replace("http://localhost:8080/Cosas/blog_api/front-end/admin/comentarios.php")
                }else{
                    $('#mensajes').html("Hubo un error")
                }
            }, 
            error: function () {
                alert("error")
            }
        })
    })
}