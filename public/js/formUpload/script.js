const akun = document.getElementById('kelolaAkun');
akun.classList.add("active");


const resetButton = document.getElementsByClassName('reset');
for(var i=0; i<resetButton.length; i++){
    resetButton[i].addEventListener('click', resetForm);
  }

  function resetForm(event){

    event.preventDefault();
  
    var form = event.currentTarget.form;
    var inputs = form.querySelectorAll('input');
    var selectOption = form.querySelector('select');
    var uploadFile = document.getElementById('file-chosen');
    
    inputs.forEach(function(input, index){
        input.value = null;
        selectOption.selectedIndex = -1;
      });
      uploadFile.textContent = 'Tidak ada file';
  
  }

  const actualBtn = document.getElementById('actual-btn');

  const fileChosen = document.getElementById('file-chosen');
  
  actualBtn.addEventListener('change', function(){
    fileChosen.textContent = this.files[0].name
  })