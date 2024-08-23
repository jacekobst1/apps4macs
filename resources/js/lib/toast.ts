import Swal from "sweetalert2";

const Toast = Swal.mixin({
    toast: true,
    position: "bottom-end",
    showConfirmButton: false,
    timer: 6000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    },
    showCloseButton: true,
});

async function fireToast(
    type: 'success' | 'error' | 'warning' | 'info' | 'question',
    message: string,
) {
    const dialogs = document.getElementsByTagName('dialog');
    let openedDialog;

    for (let i = 0; i < dialogs.length; i++) {
        if (dialogs[i].open) {
            openedDialog = dialogs[i];
            break;
        }
    }

    const target = openedDialog ? openedDialog : 'body';

    await Toast.fire({
        icon: type,
        title: message,
        target
    });
}

export default fireToast;
