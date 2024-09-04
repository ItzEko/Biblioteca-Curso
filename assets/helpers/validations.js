
export const validation = (inputName, errorMessage,validacionRegex,invalidoMsg) => {
    const inputEntrada = inputName.val();
    //llama la funcion al argumento para verificar
    if (validacionRegex(inputEntrada) ) {
        // removeClass hace que se elimine la clase is-invalid y añada la clase is valid del css
        inputName.removeClass("is-invalid").addClass("is-valid");
        errorMessage.hide();
    } else {
        // Campo invalido
        inputName.removeClass("is-valid").addClass("is-invalid");
        errorMessage.text(invalidoMsg).show();
    }
};
//Validacion de todos los inputs para activar o desactivar el boton
export const checkValidacion = (inputsNames, btnName) => {
    const inputs = $(inputsNames);
    const btn = $(btnName);
    let inputsVal = true;
    const validarInputs = () => {
        inputsVal = true; 
        inputs.each(function() {
            if (!$(this).hasClass('is-valid')) {
                inputsVal = false;
                return false;
            }
        });
        btn.attr('disabled', !inputsVal);
    };
    inputs.on('keyup', validarInputs);
    validarInputs();
};