<?php 
    include "../includes/conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probando con ajax</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body class="fondo">
    <div class="container">
        <div class="col-md-12">
            <div class="menu" >
                <!-- Título -->
                <div class="titulo">
                    <h3>CRUD MARCAS</h3>
                    <hr style="max-width: 50%;">
                    <h4>Agregar marca</h4>
                    <hr>
                    <br>
                </div>
                <!-- Fin título -->
                <div class="formulario">
                    <form action="procesos/agregar.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de marca">
                        </div><br>    
                        <button type="submit" onclick="agregar()" id="guardar" class="btn btn-block" style="background: black; color:white;">Agregar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Jquery -->
<script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
<!--Enlaces Bootstrap-->    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="assets/js/plugins.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</body>
<script>
    $(document).ready(function() {

        $('form').submit(function(event) {

            $('.form-group').removeClass('has-error'); 
            $('.help-block').remove(); 

            var formData = {
                'nombre': $('input[name=nombre]').val()
            };

            $.ajax({
                    type: 'POST', 
                    url: '../procesos/agregar.php', 
                    data: formData, 
                    dataType: 'json', 
                    encode: true
                })
                .done(function(data) {
                    if (!data.success) {
                        if (data.errors.nombre) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ha ocurrido un error',
                                text: data.errors.nombre
                            })

                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registro exitoso',
                            text: "La marca se ha modificado con éxito",

                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Continuar'
                        }).then((result) => {
                            if (result.value) {
                                //window.history.back();
                                location.href = "../index.php";
                            }
                        })
                    }
                })

                .fail(function(data) {

                    console.log(data);
                });
            event.preventDefault();
        });
    });
</script>
</html>