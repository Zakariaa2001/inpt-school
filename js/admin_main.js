// prevent
// let sub = document.getElementById("save");
// sub.addEventListener("click",function (e) {
//     console.log("ok");
//     e.preventDefault();
// })
// info-log 
let BTnlog = document.querySelector(".last");
let info_log = document.querySelector(".info-log");
BTnlog.onclick = function () {
    info_log.classList.toggle("active-log")
}
// modal new class
let newClass = document.querySelector(".newClass");
newClass.onclick = function () {
    let formNewClass = document.getElementById("formNewClass");
        document.querySelector(".modaall").classList.add("activeClass");
        // document.querySelector(".modalcontent").classList.add("modalnone");
}
// modal new teacher
let newTeacher = document.querySelector(".new");
newTeacher.onclick = function () {
    let myform1 = document.getElementById("form1");
        document.querySelector(".modaal").classList.add("active");
        // document.querySelector(".modalcontent").classList.add("modalnone");
}
// let close = document.querySelector(".close");
// close.onclick = function () {
//     document.querySelector(".modal").classList.add("NOactive");
//     return false;

// }
// for modal
let btnRoom = document.querySelectorAll(".btnRoom");
let submit = document.getElementById("submit");
console.log(document.getElementById("main-title"));
for (let i = 0; i < btnRoom.length; i++) {
    btnRoom[i].onclick = () => {
        let myform1 = document.getElementById("form1");
        document.querySelector(".modal").classList.add("active");
        document.querySelector(".modalcontent").classList.add("modalnone");
        document.getElementById("typeRoom").value = btnRoom[i].value;
        document.getElementById("main-title").append(btnRoom[i].value);
        return false;
    }
}
// for delete
function chekdelete() {
    return confirm("Are you sure you want to delete this record");
}
// for update
let edit = document.querySelectorAll(".edit");
let info = document.querySelectorAll(".info");
let mainTitle = document.querySelector("#main-title");
for (let i = 0; i < edit.length; i++) {
    edit[i].onclick = () => {
        let myform1 = document.getElementById("form1");
        document.querySelector(".modal").classList.add("active");
        let modalcontent = document.querySelector(".modalcontent");
        modalcontent.classList.add("relativeClass");
        let nameFiliere = document.querySelectorAll(".nameFiliere");
        let nameSalle = document.querySelectorAll(".nameSalle");
        let date = document.querySelectorAll(".date");
        let start = document.querySelectorAll(".start");
        let end = document.querySelectorAll(".end");
        let id = document.querySelectorAll(".id");
        document.getElementById("typeRoom").value = nameSalle[i].textContent;
        document.getElementById("Filiere").value = nameFiliere[i].textContent;
        document.getElementById("date").value = date[i].textContent;
        document.getElementById("start").value = start[i].textContent;
        document.getElementById("end").value = end[i].textContent;
        document.getElementById("id").value = id[i].textContent;

        let btnUpdate = document.querySelector(".updatee");
        btnUpdate.value = "Update"
        btnUpdate.name = "Update";
        mainTitle.innerHTML = "Update Room ";
        return false;
    }
}


