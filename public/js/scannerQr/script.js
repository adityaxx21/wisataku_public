
const resetButton = document.getElementsByClassName('reset');
for(var i=0; i<resetButton.length; i++){
    resetButton[i].addEventListener('click', resetForm);
  }

  function resetForm(event){

    event.preventDefault();
   
    document.getElementById('scanner').value = null;
    
  
  }