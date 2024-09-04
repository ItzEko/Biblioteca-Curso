
export const valString = (inputString)=>{
    const regex = /^[a-zA-Z]+(?: [a-zA-Z]+)*$/;
    return regex.test(inputString);
}
export const valDirection =(inputDirection)=>{
    const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9. ]+$/;
    return regex.test(inputDirection);
}
export const valCP = (inputCP) => {
    const regex = /^\d{5}$/;
    return regex.test(inputCP);
}
export const valCorreo = (inputCorreo) => {
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return regex.test(inputCorreo);
}
export const valPss = (inputPss)=>{
    const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#]+$/;
    return regex.test(inputPss);
}