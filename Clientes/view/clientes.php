<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../../include/headers.html' ?>

    <title>CLIENTES</title>
</head>

<body>
<div class="container d-flex justify-content-center align-items-center" style=" margin-top:100px;">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSave" id="btn-abrirSave">
        Guardar Cliente
    </button>
</div>
<modalGuardar></modalGuardar>
    <div class="containerDataTable my-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table" id="datatable_users">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Direccion</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            <th>CP</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody_users">

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script type="module" src="../js/clientes.js"></script>
</body>

</html>