import { validation, checkValidacion } from '../../assets/helpers/validations.js';
import { valCP, valDirection, valString } from '../../assets/helpers/regex.js';
import { alertsSave } from '../../assets/helpers/messages.js';
const saveClientes = () => {

    $("#Nombre").on("keyup", () => {
        validation($('#Nombre'), $('#nombreError'), valString, "Nombre no es valido");
    });
    $("#Apellidos").on("keyup", () => {
        validation($('#Apellidos'), $('#apellidoError'), valString, "Apellido no es valido");
    });
    $("#Direccion").on("keyup", () => {
        validation($('#Direccion'), $('#direccionError'), valDirection, "Direccion no es valido");
    });
    $("#Ciudad").on("keyup", () => {
        validation($('#Ciudad'), $('#ciudadError'), valString, "Ciudad no es valido");
    });
    $("#Estado").on("keyup", () => {
        validation($('#Estado'), $('#estadoError'), valDirection, "Estado no es valido");
    });
    $("#CP").on("keyup", () => {
        validation($('#CP'), $('#cpError'), valCP, "Código postal no es valido");
    });
    //boton accion guardar
    $("#save").on("click", async () => {
        event.preventDefault();
        let Nombre = $("#Nombre").val();
        let Apellidos = $("#Apellidos").val();
        let Direccion = $("#Direccion").val();
        let Ciudad = $("#Ciudad").val();
        let Estado = $("#Estado").val();
        let CP = $("#CP").val();
        try {
            const jsonData = await $.post('../controller/rutas.php', {
                data: {
                    metodo: 'guardar',
                    data:
                    {
                        Nombre: Nombre,
                        Apellido: Apellidos,
                        Direccion: Direccion,
                        Ciudad: Ciudad,
                        Estado: Estado,
                        CP: CP
                    }
                }
            });
            //se guardan en un objeto los msg
            const areSave = {
                estado: jsonData.status,
                text: jsonData.msg,
                icon: 'success',
                title: 'Exito!',
                icon1: 'error',
                title1: 'Error'
            }
            alertsSave(areSave);
            //aqui va si sale bien todo los mensajes desde controller
            console.log(jsonData);
        } catch (error) {
            console.log("Error al guardar un cliente:", error);
        };

    });
};
//boton para abrir el modal y traer las funciones de validacion 
$('#btn-abrirSave').on('click', () => {
    const modal = $('modalGuardar');
    modal.html('');
    modal.load('../view/modalSave.php', () => {
        $('#modalSave').modal('show');
        saveClientes();
        //validacion de todos los inputs para activar o desactivar el boton
        checkValidacion('#Nombre, #Apellidos, #Direccion, #Ciudad, #Estado, #CP', '#save');
    });
});
//DataTable con BD biblioteca01
async function loadTable() {
    $("#datatable_users").DataTable().destroy();
    try {
        const jsonData = await $.post('../controller/rutas.php', {
            data: { metodo: 'buscarTodos' }
        });
        if (Array.isArray(jsonData.data)) {
            const tabla = $("#datatable_users").DataTable({
                data: jsonData.data,
                responsive: true,
                columns: [

                    { data: "ID" }, //
                    { data: "NombreCliente" },
                    { data: "ApellidoCliente" },
                    { data: "DireccionCliente" },
                    { data: "CiudadCliente" },
                    { data: "EstadoCliente" },
                    { data: "CPCliente" },
                    //por ahora data es null por que no hay datos
                    //render genera un boton 
                    { data: null, render: () => '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate" id="abrir-update">Actualizar</button>' },
                    { data: null, render: () => '<button>Eliminar</button>' }
                ]
            });
        } else {
            console.log("los datos recibidos no son un array");
        }
        console.log(jsonData)
    } catch (error) {
        console.log("Error al cargar los datos:", error);
    }
};
loadTable();
