let btnUpdateMail = document.querySelector("#btnUpdateMail");
let btnValidationMail = document.querySelector("#btnConfirmUpdate");
let mailSection = document.querySelector("#mail");
let mailUpdateSection = document.querySelector("#updateMail");

btnUpdateMail.addEventListener('click', function(){
    mailSection.classList.add("d-none");
    mailUpdateSection.classList.remove("d-none");
})