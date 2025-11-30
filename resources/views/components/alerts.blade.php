<script>
document.addEventListener("DOMContentLoaded", function () {

    const success = @json(session('success'));
    const deleteConfirm = @json(session('delete_confirm'));

    const Toast = Swal.mixin({
    toast: true,
    position: "top",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
});

    function showToast(htmlMessage){
        Toast.fire({
            icon: null,
            html: htmlMessage,
            customClass: {
                htmlContainer: 'swal-html'
            }
        });
    }

    window.showDeleteConfirm = function(htmlMessage, callback) {
    Swal.fire({
        title: null,
        html: htmlMessage,
        showCancelButton: true,
        reverseButtons: true,
        background: "#FFFFFF",
        color: "#2c2c2c",
        width: "400px",
        padding: "10px",
        borderRadius: "20px",
        customClass: {
            htmlContainer: 'swal-html',
            cancelButton: 'swal-cancel',
            confirmButton: 'swal-confirm-delete',
        },
        confirmButtonText: "Excluir",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#8E6BBF",
        cancelButtonColor: "#EA853C",
    }).then((result) => {
        if (result.isConfirmed && callback) callback();
    });
};

    // ACIONA OS ALERTAS DA SESSÃO
    if (success) showToast(`${success}`);


});
</script>
