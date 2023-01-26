var editArtForm = document.getElementById("editArtForm");

if (editArtForm) {
    editArtForm.addEventListener('submit', function (e) {
        e.preventDefault();

        var datos = new FormData(editArtForm);

        if (datos.get('titulo') == '' || datos.get('texto') == '') {
            $('#mensajes').html("Error, hay campos vacíos");
            $('#titulo').val("");
            $('#texto').val("");
            return false;
        } else {
            $.ajax({
                url: "http://localhost:8080/Cosas/blog_api/back-end/api/articles/updtArticle.php",
                type: "POST",
                data: datos,
                processData: false,  // tell jQuery not to process the data
                cache: false,
                contentType: false,   // tell jQuery not to set contentType
                success: function (res) {
                    if (res.msg == true) {
                        window.location.replace("http://localhost:8080/Cosas/blog_api/front-end/admin/articulos.php")
                    } else {
                        console.log("no terminó bien")
                    }
                }
            })
            return false
        }
    });
}

$(document).ready(function (e) {
    $("#createArtForm").on('submit', function (e) {
        e.preventDefault()

        var datos = new FormData(document.getElementById("createArtForm"))

        if (datos.get('titulo') == '' || datos.get('texto') == '') {
            $('#mensajes').html("Error, hay campos vacíos");
            $('#titulo').val("");
            $('#texto').val("");
            return false;
        } else {
            $.ajax({
                url: "http://localhost:8080/Cosas/blog_api/back-end/api/articles/createArticle.php",
                type: "POST",
                data: datos,
                processData: false,  // tell jQuery not to process the data
                cache: false,
                contentType: false,   // tell jQuery not to set contentType
                success: function (res) {
                    if (res.msg == true) {
                        window.location.replace("http://localhost:8080/Cosas/blog_api/front-end/admin/articulos.php")
                    } else {
                        console.log("no terminó bien")
                    }
                }
            })
            return true
        }
    })
})

// var createArtForm = document.getElementById("createArtForm");

// if(createArtForm){
//     editArtForm.addEventListener('submit', function (e) {
//         e.preventDefault();

//         var datos = new FormData(editArtForm);

//         if (datos.get('titulo') == '' || datos.get('texto') == '') {
//             $('#mensajes').html("Error, hay campos vacíos");
//             $('#titulo').val("");
//             $('#texto').val("");
//             return false;
//         } else {
//             $.ajax({
//                 url:"http://localhost:8080/Cosas/blog_api/back-end/api/articles/createArticle.php",
//                 type: "POST",
//                 data: datos,
//                 success: function(res){
//                     if(res.msg){
//                         console.log(res.data)
//                         // window.location.replace("http://localhost:8080/Cosas/blog_api/front-end/admin/articulos.php")
//                     }else{
//                         alert("Hubo un error")
//                     }
//                 }
//             })
//         }
//     });
// }