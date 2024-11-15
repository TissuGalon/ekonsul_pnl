document.addEventListener("DOMContentLoaded", function () {
    const jurusanSelect = document.getElementById("jurusanSelect");
    const prodiSelect = document.getElementById("prodiSelect");
    const nimInput = document.getElementById("nimInput");
    const passwordInput = document.getElementById("passwordInput");

    // Fungsi untuk mengupdate pilihan prodi sesuai dengan jurusan
    jurusanSelect.addEventListener("change", function () {
        const selectedJurusanId = jurusanSelect.value;

        // Reset prodiSelect ke opsi default
        prodiSelect.value = ""; // Reset nilai prodi ke kosong
        prodiSelect.selectedIndex = 0; // Set ke opsi pertama (Pilih Prodi)

        // Looping melalui semua option prodi
        for (let i = 0; i < prodiSelect.options.length; i++) {
            const option = prodiSelect.options[i];
            // Menampilkan hanya opsi yang memiliki data-id yang sesuai dengan jurusan
            if (option.getAttribute("data-id") === selectedJurusanId || selectedJurusanId === "") {
                option.style.display = "block"; // Tampilkan opsi
            } else {
                option.style.display = "none"; // Sembunyikan opsi
            }
        }
    });

    // Fungsi untuk mengisi kolom password dengan nilai NIM
    nimInput.addEventListener("input", function () {
        passwordInput.value = nimInput.value; // Menyalin nilai NIM ke password
    });

    // Trigger perubahan saat halaman pertama dimuat untuk menyesuaikan prodi yang dapat dipilih
    jurusanSelect.dispatchEvent(new Event("change"));
});

/* --------------------------------- */

/* ADD MAHASISWA */

document.getElementById("formMahasiswa").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData();
    const fotoInput = document.getElementById("fotoInput");
    const namaInput = document.getElementById("namaLengkap");
    const nimInput = document.getElementById("nimInput");
    const passwordInput = document.getElementById("passwordInput");
    const jurusanSelect = document.getElementById("jurusanSelect");
    const prodiSelect = document.getElementById("prodiSelect");
    const semesterInput = document.getElementById("semesterInput");

    /* !fotoInput.files[0] || */
    if (!namaInput.value || !nimInput.value || !jurusanSelect.value || !prodiSelect.value || !semesterInput.value) {
        Swal.fire({
            icon: "warning",
            title: "Data Tidak Lengkap",
            text: "Semua data harus diisi!",
        });
        return;
    }

    formData.append("foto", fotoInput.files[0]);
    formData.append("nama", namaInput.value);
    formData.append("nim", nimInput.value);
    formData.append("pass", passwordInput.value);
    formData.append("jurusan", jurusanSelect.value);
    formData.append("prodi", prodiSelect.value);
    formData.append("semester", semesterInput.value);

    fetch("controller/add_mahasiswa.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => {
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Mahasiswa berhasil ditambahkan!",
                    willClose: () => {
                        window.location.reload();
                    },
                });

                document.getElementById("formMahasiswa").reset();
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: `Gagal menambahkan mahasiswa: ${data.message}`,
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            Swal.fire({
                icon: "error",
                title: "Kesalahan",
                text: `Terjadi kesalahan: ${error.message}`,
            });
        });
});

/* ADD MAHASISWA */

/* EDIT MAHASISWA */
document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".btn-edit-mahasiswa");
    const modal = document.querySelector("#modalEditMahasiswa");
    const form = document.querySelector("#formEditMahasiswa");

    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Ambil data dari atribut `data-*`
            const id = this.getAttribute("data-id");
            const user_id = this.getAttribute("data-user_id");
            const nama = this.getAttribute("data-nama");
            const nim = this.getAttribute("data-nim");
            const jurusan = this.getAttribute("data-jurusan");
            const prodi = this.getAttribute("data-prodi");
            const semester = this.getAttribute("data-semester");
            const foto = this.getAttribute("data-foto");

            // Isi form modal dengan data
            document.querySelector("#edit-mahasiswaId").value = id;
            document.querySelector("#edit-user_id").value = user_id;
            document.querySelector("#edit-namaLengkap").value = nama;
            document.querySelector("#edit-nimInput").value = nim;
            document.querySelector("#edit-jurusanSelect").value = jurusan;
            document.querySelector("#edit-prodiSelect").value = prodi;
            document.querySelector("#edit-semesterInput").value = semester;
            document.querySelector("#edit-fotoInput").setAttribute("data-existing", foto);

            // Tampilkan modal
            const bootstrapModal = new bootstrap.Modal(modal);
            bootstrapModal.show();
        });
    });

    /* SUBMIT */
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Mencegah form melakukan submit biasa

        // Ambil data dari form
        const user_id = document.querySelector("#edit-user_id").value;
        const mahasiswaId = document.querySelector("#edit-mahasiswaId").value;
        const nama = document.querySelector("#edit-namaLengkap").value;
        const nim = document.querySelector("#edit-nimInput").value;
        const jurusan = document.querySelector("#edit-jurusanSelect").value;
        const prodi = document.querySelector("#edit-prodiSelect").value;
        const semester = document.querySelector("#edit-semesterInput").value;
        const fotoInput = document.querySelector("#edit-fotoInput");

        // FormData untuk mengirim data termasuk file (foto)
        const formData = new FormData();
        formData.append("user_id", user_id);
        formData.append("mahasiswaId", mahasiswaId);
        formData.append("nama", nama);
        formData.append("nim", nim);
        formData.append("jurusan", jurusan);
        formData.append("prodi", prodi);
        formData.append("semester", semester);

        // Jika ada file foto yang di-upload
        if (fotoInput.files[0]) {
            formData.append("foto", fotoInput.files[0]);
        }

        // Kirim data menggunakan AJAX
        $.ajax({
            url: "controller/edit_mahasiswa.php",
            type: "POST",
            data: formData,
            processData: false, // Jangan memproses data (karena ada file)
            contentType: false, // Jangan set content-type otomatis
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Data berhasil diubah",
                        text: "Perubahan data mahasiswa berhasil disimpan!",
                        confirmButtonText: "OK",
                        willClose: () => {
                            window.location.reload();
                        },
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Terjadi kesalahan",
                        text: response.message,
                        confirmButtonText: "Coba Lagi",
                    });
                }
            },
            error: function (xhr, status, error) {
                // Tampilkan SweetAlert jika terjadi error AJAX
                Swal.fire({
                    icon: "error",
                    title: "Terjadi kesalahan",
                    text: "Tidak dapat terhubung ke server. Silakan coba lagi.",
                    confirmButtonText: "OK",
                });
            },
        });
    });
    /* SUBMIT */
});

/* EDIT MAHASISWA */

/* DELETE MAHASISWA */
$(document).on("click", ".btn-delete", function () {
    var userId = $(this).data("id"); // Ambil user_id dari atribut data-id

    // Tampilkan konfirmasi SweetAlert
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data ini akan dihapus tetapi tetap bisa dipulihkan!",
        icon: "warning",
        showCancelButton: true, // Tampilkan tombol Cancel
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
        customClass: {
            confirmButton: "btn btn-danger", // Menggunakan kelas Bootstrap untuk tombol Hapus
        },
    }).then((result) => {
        if (result.isConfirmed) {
            // Kirim request untuk melakukan soft delete berdasarkan user_id
            $.ajax({
                url: "controller/delete_mahasiswa.php",
                type: "POST",
                data: { user_id: userId }, // Kirimkan user_id
                success: function (response) {
                    if (response.success) {
                        // Tampilkan alert sukses menggunakan SweetAlert
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data mahasiswa telah dihapus.",
                            icon: "success",
                            confirmButtonText: "Ok",
                        }).then(() => {
                            // Refresh halaman setelah konfirmasi sukses
                            location.reload();
                        });
                    } else {
                        // Tampilkan pesan error jika gagal
                        Swal.fire({
                            title: "Gagal!",
                            text: response.message,
                            icon: "error",
                            confirmButtonText: "Ok",
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Tampilkan pesan error jika AJAX gagal
                    Swal.fire({
                        title: "Terjadi kesalahan!",
                        text: "Silakan coba lagi.",
                        icon: "error",
                        confirmButtonText: "Ok",
                    });
                },
            });
        } else {
            // Jika tombol Cancel diklik, tidak melakukan apapun dan tidak ada aksi.
            console.log("Penghapusan dibatalkan.");
        }
    });
});

/* DELETE MAHASISWA */
