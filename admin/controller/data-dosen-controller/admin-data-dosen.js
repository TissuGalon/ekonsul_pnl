var add_nip = document.getElementById("add-nip");
var add_password = document.getElementById("add-password");

// Menyalin nilai NIP ke password
add_nip.addEventListener("input", function () {
    add_password.value = add_nip.value;
});

/* ------ */

function editDosen(user_id, nip, fullname) {
    const modal = document.querySelector("#modalEditDosen");
    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();

    var edit_user_id = document.getElementById("edit_user_id");
    var edit_nip = document.getElementById("edit-nip");
    var edit_fullname = document.getElementById("edit-fullname");

    edit_user_id.value = user_id;
    edit_nip.value = nip;
    edit_fullname.value = fullname;
}

function editPassDosen(user_id) {
    const modal = document.querySelector("#modalGantiPassword");
    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();

    var gantipass_user_id = document.getElementById("gantipass-userId");

    gantipass_user_id.value = user_id;
}

function deleteDosen(user_id) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data Dosen ini akan dihapus !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `controller/data-dosen-controller/delete-dosen.php?user_id=${user_id}`;
        }
    });
}

/* ALERT -------- */

// Fungsi untuk mendapatkan parameter URL
function getURLParameter(name) {
    return new URLSearchParams(window.location.search).get(name);
}

// Ambil parameter status dan message
const status = getURLParameter("status");
const message = getURLParameter("message");

// Tampilkan SweetAlert berdasarkan status
if (status) {
    switch (status) {
        case "success":
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: message || "Data berhasil diperbarui.",
                confirmButtonText: "OK",
            });
            break;
        case "failed":
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: message || "Terjadi kesalahan saat memperbarui data.",
                confirmButtonText: "OK",
            });
            break;
        default:
            Swal.fire({
                icon: "info",
                title: "Informasi",
                text: message || "Tidak ada informasi tambahan.",
                confirmButtonText: "OK",
            });
    }
}

if (status) {
    history.replaceState(null, "", window.location.pathname);
}
