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

    function showSuccess(htmlMessage) {
        Swal.fire({
            html: htmlMessage,
            icon: null,
            showConfirmButton: false,
            background: "#FFFFFF",
            color: "#2c2c2c",
            width: "430px",
            padding: "5px",
            borderRadius: "20px",

            customClass: {
                htmlContainer: 'swal-html',
                confirmButton: 'swal-confirm',
            },

            confirmButtonColor: "#8E6BBF",
        });
    }

    function showDeleteConfirm(htmlMessage, callback) {
        Swal.fire({
            title: "Confirmar exclusão?",
            html: htmlMessage,  
            icon: null,         
            showCancelButton: true,

            background: "#FFFFFF",
            color: "#2c2c2c",
            width: "450px",
            padding: "30px 25px",
            borderRadius: "20px",

            customClass: {
                title: 'swal-title',
                htmlContainer: 'swal-html',
                confirmButton: 'swal-confirm-delete',
                cancelButton: 'swal-cancel',
            },

            confirmButtonText: "Excluir",
            cancelButtonText: "Cancelar",

            confirmButtonColor: "#EA853C",
            cancelButtonColor: "#8E6BBF",
        }).then((result) => {
            if (result.isConfirmed && callback) callback();
        });
    }


    // ACIONA OS ALERTAS DA SESSÃO
    if (success) showToast(`${success}`);

    // Exemplo de uso do de exclusão:
    // showDeleteConfirm(`<p>Tem certeza que deseja excluir <strong>este item</strong>?</p>`, () => console.log("Deletado!"));

});
</script>
