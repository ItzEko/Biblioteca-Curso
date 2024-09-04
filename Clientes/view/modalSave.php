<div class="modal" id="modalSave">
    <div class="modal-dialog">
        <div class="modal-content d-flex  align-items-center">
            <div class="w-50">
                <form class="text-center">
                    <h2>Registro de Usuarios</h2>
                    <div class="mb-3 text-start">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <div id="nombreError" class="text-danger" style="display: none;"></div>
                        <input type="text" class="form-control" id="Nombre">
                    </div>

                    <div class="mb-3 text-start">
                        <label for="Apellido" class="form-label">Apellido</label>
                        <div id="apellidoError" class="text-danger" style="display: none;"></div>
                        <input type="text" class="form-control" id="Apellidos">
                    </div>

                    <div class="mb-3 text-start">
                        <label for="Direccion" class="form-label">Dirección</label>
                        <div id="direccionError" class="text-danger" style="display: none;"></div>
                        <input type="text" class="form-control" id="Direccion">
                    </div>

                    <div class="mb-3 text-start">
                        <label for="Ciudad" class="form-label">Ciudad</label>
                        <div id="ciudadError" class="text-danger" style="display: none;"></div>
                        <input type="text" class="form-control" id="Ciudad">
                    </div>

                    <div class="mb-3 text-start">
                        <label for="Estado" class="form-label">Estado</label>
                        <div id="estadoError" class="text-danger" style="display: none;"></div>
                        <input type="text" class="form-control" id="Estado">
                    </div>

                    <div class="mb-3 text-start">
                        <label for="CP" class="form-label">CP</label>
                        <div id="cpError" class="text-danger" style="display: none;"></div>
                        <input type="text" class="form-control" id="CP">
                    </div>

                    <div>
                        <button type="button" class="btn btn-success" id="save" disabled>Guardar Cliente</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>