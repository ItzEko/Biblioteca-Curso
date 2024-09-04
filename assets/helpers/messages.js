export const alertsSave = (areSave) => {
    if (areSave.estado === true) {
        Swal.fire({
            icon: areSave.icon,
            title: areSave.title,
            text: areSave.text,
        });
    } else {
        Swal.fire({
            icon: areSave.icon1,
            title: areSave.title1,
            text: areSave.text,
        });
    }
}
