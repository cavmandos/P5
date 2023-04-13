let btnUpdateMail = document.querySelector("#btnUpdateMail");
let btnValidationMail = document.querySelector("#btnConfirmUpdate");
let mailSection = document.querySelector("#mail");
let mailUpdateSection = document.querySelector("#updateMail");
let btnDeleteFirst = document.querySelector("#btnDeleteAccount");
let btnDeleteSecond = document.querySelector("#deleteAccount");

btnUpdateMail.addEventListener('click', function(){
    mailSection.classList.add("d-none");
    mailUpdateSection.classList.remove("d-none");
})

btnDeleteFirst.addEventListener('click', function(){
    btnDeleteSecond.classList.remove("d-none");
})

/*Swal.fire({
    title: 'Nom d\'une bûche !',
    text: 'Votre compte est bien supprimé',
    icon: 'success',
    confirmButtonText: 'Ok'
  })*/