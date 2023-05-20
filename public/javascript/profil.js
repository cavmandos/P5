let btnUpdate = document.querySelector("#btnUpdateMail");
let mailSection = document.querySelector("#mail");
let mailUpdateSection = document.querySelector("#updateMail");
let btnDeleteFirst = document.querySelector("#btnDeleteAccount");
let btnDeleteSecond = document.querySelector("#deleteAccount");

btnUpdate.addEventListener("click", function () {
    mailSection.classList.add("d-none");
    mailUpdateSection.classList.remove("d-none");
});

btnDeleteFirst.addEventListener("click", function () {
    btnDeleteSecond.classList.remove("d-none");
});
