import {validation,checkValidacion} from '../../assets/helpers/validations.js';
import { valCorreo,valPss } from '../../assets/helpers/regex.js';
import { alertsSave } from '../../assets/helpers/messages.js';
const mostrar2 = () => {
    event.preventDefault();
    let correo = $("#Correo").val();
    let contrasena = $("#contrasena").val();
    const inputs ={  correo, contrasena };
    const areSave ={
        inputsSave: {inputs},
        statusSave: true,
        msg: {text:'Ingreso exitoso',
            icon: 'success',
            title:'Exito!',
            text1:'No has podido ingresar',
            icon1:'error',
            title1: 'Error'
        }
    }
    console.log(areSave);
    alertsSave(areSave);
}
$("#loginbtn").on("click", mostrar2);

$("#Correo").on("keyup", () => {
    validation($('#Correo'),$('#correoError'), valCorreo, "Correo no es valido");
});
$("#contrasena").on("keyup", () => {
    validation($('#contrasena'),$('#contraError'), valPss, "Contraseña no es valido");
});

checkValidacion('#Correo, #contrasena', '#loginbtn');


