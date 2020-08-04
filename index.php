<?php 
    include "includes/conexion.php";

    $sql = "SELECT * FROM marca";
    $resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probando con ajax</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
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
                    <h4>Listado de marcas</h4>
                    <br>
                </div>
                <!-- Fin título -->

                <!-- Inicio tabla -->
                <table class="table table-bordered" id="tabla_marcas">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($resultado->num_rows>0){
                            while($marcas = $resultado->fetch_assoc()){
                                
                        ?>
                        <tr>
                            <td><?php echo $marcas['nombre_marca'] ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                         <a href="vistas/updateMarca.php?id_marca=<?php echo $marcas['id_marca']?>" class="btn btn-block" style="background: black; color:white;">Modificar</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" onclick="confirmar(<?php echo $marcas['id_marca']?>)" id="eliminar" class="btn btn-block" style="background: black; color:white;">Eliminar</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php }
                        }?>
                    </tbody>
                </table>
                <br>
                <!-- Fin tabla -->
                <div class="agregar">
                <a href="vistas/addMarca.php" class="btn btn-block" style="background: black; color:white;">Agregar marca</a>
            </div>
            </div>
            
        </div>
    </div>

<!--Enlaces Bootstrap-->    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#tabla_marcas').DataTable({
                language: {
                    search: "Buscar:",
                    paginate: {
                        first: "Primer",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Último"
                    },
                    info: "Mostrando del _START_ al _END_ de _TOTAL_ resultados disponibles",
                    emptyTable: "No existen elementos para mostrar en la tabla",
                    infoEmpty: "Mostrando del 0 al 0 de 0 resultados",
                    infoFiltered: "(Filtrado de _MAX_ resultados)",
                    lengthMenu: "Mostrando _MENU_ resultados",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    zeroRecords: "No se encontraron resultados",
                    aria: {
                        sortAscending: ": Ordenado de forma ascendente",
                        sortDescending: ": Ordenado de forma descendente"
                    }

                }
            });
        });
    </script>

<script>
    function confirmar(id_marca){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '¿Está seguro de eliminar?',
        text: "No podrá recuperar la marca!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            eliminar(id_marca)
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelado',
            'La marca no se eliminará',
            'error'
            )
        }
        })
    }

	function eliminar(id_marca) {
		cadena = "id_marca="+id_marca;
        //console.log(cadena)

		$.ajax({
			type: "POST",
			url: "procesos/eliminar.php",
			data: cadena,
			success: function(r) {
				if (r == 1) {
					Swal.fire({
						icon: 'success',
						title: 'Eliminación exitosa',
						text: "Eliminado",

						showCancelButton: false,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Continuar'
					}).then((result) => {
						if (result.value) {
							location.reload();
						}
					})

				} else {
					Swal.fire({
						icon: 'error',
						title: 'No se ha podido eliminar',
						text: 'Ocurrió un error interno'
					})
				}
			}
		})
	}
</script>

</body>
</html>