const akun = document.getElementById("kelolaAkun");
akun.classList.add("active");

// choose file

const actualBtn = document.getElementById("actual-btn");

const fileChosen = document.getElementById("file-chosen");

actualBtn.addEventListener("change", function () {
    fileChosen.textContent = this.files[0].name;
});

function fill_it() {
    $("#editor-one").bind("keyup change", function (event) {
        var currentValue = $(this).html();
        $("#descr").val(currentValue);
    });
}
