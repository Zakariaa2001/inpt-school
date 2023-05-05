// for modal
let btnRoom = document.querySelectorAll(".btnRoom");
let submit = document.getElementById("submit");
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
// // for delete
function chekdelete() {
    return confirm("Are you sure you want to delete this record");
}
// for update
let edit = document.querySelectorAll(".edit");
let info = document.querySelectorAll(".info");
let btnUpdate = document.querySelector(".update");
let mainTitle = document.querySelector("#main-title");
for (let i = 0; i < edit.length; i++) {
    edit[i].onclick = () => {
        let id = document.querySelectorAll(".id");
        let nameFiliere = document.querySelectorAll(".nameFiliere");
        let nameSalle = document.querySelectorAll(".nameSalle");
        let date = document.querySelectorAll(".date");
        let start = document.querySelectorAll(".start");
        let end = document.querySelectorAll(".end");
        //document.getElementById("typeRoom").value = nameSalle[i].textContent;
        document.getElementById("Filiere").value = nameFiliere[i].textContent;
        document.getElementById("date").value = date[i].textContent;
        document.getElementById("start").value = start[i].textContent;
        document.getElementById("end").value = end[i].textContent;
        document.getElementById("id").value = id[i].textContent;
        let myform1 = document.getElementById("modal");
        myform1.style.display = "block";
        document.querySelector(".modal").classList.add("active");
        btnUpdate.value = "Update";
        btnUpdate.name = "Update";
        mainTitle.innerHTML = "Update Room ";
        document.getElementById("main-title").append(nameSalle[i].textContent);
        return false;
    }
}
// info-log 
let BTnlog = document.querySelector(".last");
let info_log = document.querySelector(".info-log");
BTnlog.onclick = function () {
    info_log.classList.toggle("active-log")
}