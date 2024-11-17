function editJurusan(jurusan_id, jurusan_name) {
    const modal = document.querySelector("#modalEditJurusan");
    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();

    var textfield_edit_jurusan_name = document.getElementById("edit_jurusan_name");
    textfield_edit_jurusan_name.value = jurusan_name;

    var textfield_edit_jurusan_id = document.getElementById("edit_jurusan_id");
    textfield_edit_jurusan_id.value = jurusan_id;
}

function hapusJurusan(jurusan_id) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data jurusan ini akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `controller/jurusan-prodi-controller/delete-jurusan.php?delete_jurusan_id=${jurusan_id}`;
        }
    });
}

function editProdi(prodi_id, prodi_name, jurusan_id) {
    const modal = document.querySelector("#modalEditProdi");
    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();

    var textfield_edit_prodi_name = document.getElementById("edit_prodi_name");
    textfield_edit_prodi_name.value = prodi_name;

    var textfield_edit_prodi_id = document.getElementById("edit_prodi_id");
    textfield_edit_prodi_id.value = prodi_id;

    var select_edit_jurusan_id = document.getElementById("edit_jurusan_id");
    select_edit_jurusan_id.value = jurusan_id.toString();
}

function hapusProdi(prodi_id) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data Prodi ini akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `controller/jurusan-prodi-controller/delete-prodi.php?delete_prodi_id=${prodi_id}`;
        }
    });
}
