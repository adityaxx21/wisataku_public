function open_modal() {
    $('#exampleModal').modal('show');
}



function modal_image(tag) {
    var src = document.getElementById(tag).src;
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("img01");
    modal.style.display = "block";
    modalImg.src = src;
    document.body.style.overflow = "hidden";
  }
  
  function modal_image_close() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
    document.body.style.overflow = "auto";
  }