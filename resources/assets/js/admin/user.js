import axios from "axios";
import $ from "jquery";
var toast = require("../components/toast.js");
var val = require("../components/validate.js");

var fields = document.querySelectorAll(".createUser");
var createUserForm = document.querySelector("#createUserForm");
var closeCreateUserModalBtn = document.querySelector(
  "#closeCreateUserModalBtn"
);
var searchUser = document.querySelector("#searchUser");
var parishSort = document.querySelector("#parishSort");
var clubSort = document.querySelector("#clubSort");
var limit = document.querySelector("#limit");
var limitMax = document.querySelector("#limitMax");
var allUserCount = document.querySelector("#allUserCount");
var club = document.querySelector("#club");
var userDisplayTable = document.querySelector("#userDisplayTable");
/**
Event Listeners
*/
if (createUserForm) {
  createUserForm.addEventListener("submit", e => {
    e.preventDefault();
    CreateUser();
  });
}

if (searchUser) {
  searchUser.addEventListener("keyup", () => {
    SearchUser(
      searchUser.value.length > 3 ? searchUser.value : "all",
      parishSort.value,
      clubSort.value,
      limit.value
    );
  });
}

if (parishSort) {
  parishSort.addEventListener("change", () => {
    SearchUser(searchUser.value, parishSort.value, clubSort.value, limit.value);
  });
}

if (limit) {
  limit.addEventListener("change", () => {
    SearchUser(searchUser.value, parishSort.value, clubSort.value, limit.value);
  });
}

if (clubSort) {
  clubSort.addEventListener("change", () => {
    SearchUser(searchUser.value, parishSort.value, clubSort.value, limit.value);
  });
}

var CreateUser = async () => {
  let name = $("#name").val();
  let email = $("#email").val();
  let address = $("#address").val();
  let trn = $("#trn").val();
  let phone = $("#phone").val();
  let age = Number($("#age").val());
  let parish = $("#parish").val();
  let password = $("#password").val();
  let gender = $("#gender").val();
  let fd = new FormData();
  if (name.length < 3) {
    toast.toast(
      "Name is too short it must be at least 3 characters long .",
      "error",
      "center"
    );
  } else if ((await val.IsEmailInUse(email)) == 1) {
    toast.toast("Email is invalid or in use", "error", "center");
  } else if (address.length < 5) {
    toast.toast(
      "Address is too short it must be at least 6 characters long.",
      "error",
      "center"
    );
  } else if (trn.length < 9 || trn.length > 10) {
    toast.toast(
      "TRN is too short or too long it must be 9 characters long.",
      "error",
      "center"
    );
  } else if (phone.length < 9 || phone.length > 10) {
    toast.toast(
      "Phone number is too short it must be 9 characters long.",
      "error",
      "center"
    );
  } else if (age < 16) {
    toast.toast("The member must be at least 16.", "error", "center");
  } else if (parish.length < 7) {
    toast.toast(
      "The members parish must be at least 7 characters long.",
      "error",
      "center"
    );
  } else if (password.length < 6) {
    toast.toast(
      "The members password must be at least 6 characters long.",
      "error",
      "center"
    );
  } else if (gender.length < 4) {
    toast.toast("The members gender is required.", "error", "center");
  } else if (club.value == "default") {
    toast.toast("The members club is required.", "error", "center");
  } else {
    fd.append("name", name);
    fd.append("email", email);
    fd.append("address", address);
    fd.append("trn", trn);
    fd.append("phone", phone);
    fd.append("age", age);
    fd.append("parish", parish);
    fd.append("password", password);
    fd.append("gender", gender);
    fd.append("club", club.value);
    try {
      let res = await axios.post("/admin/create", fd);
      closeCreateUserModalBtn.click();
      toast.toast(
        "Member was added to the club successfully",
        "success",
        "center"
      );
      await SearchUser(
        searchUser.value,
        parishSort.value,
        clubSort.value,
        limit.value
      );
      fields.forEach(f => (f.value = ""));
    } catch (err) {
      throw err;
    }
  }
};

var SearchUser = async (
  search = "all",
  parish = "all",
  club = "all",
  limit
) => {
  let fd = new FormData();
  fd.append("search", search);
  try {
    let res = await axios.post("/admin/user/search", fd);
    let clubs = await axios.get("/admin/clubs");
    let clubChoice = clubs.data.filter(f => f.name === club)[0] || [];
    let pSort = res.data.filter(p => p.parish == parish);
    let cSort = res.data.filter(c => c.club.name == club);
    let sorted = [];
    let userOutPut = "";
    if (parish != "all") {
      sorted = cSort.length > 0 || club == "all" ? pSort.slice(0, limit) : [];
    } else if (club != "all") {
      sorted = pSort.length > 0 || parish == "all" ? cSort.slice(0, limit) : [];
    } else if (parish == "all" && club == "all") {
      sorted = res.data.slice(0, limit);
    } else {
      sorted = res.data;
    }

    let finalSort =
      parish == "all" || club == "all"
        ? sorted
        : sorted.filter(c => c.club.id == clubChoice.id).slice(0, limit) || [];

    if (limitMax) {
      limitMax.innerHTML = "All Users";
      limitMax.value = res.data.length;
    }
    if (allUserCount) {
      allUserCount.innerHTML = finalSort.length;
    }
    finalSort.forEach((f, i) => {
      let created_at = new Date(f.created_at.date);
      let created = created_at.toString().slice(0, 24);
      userOutPut += `<tr>
      <th scope="row">${i}</th>
      <td>${f.name}</td>
      <td>${f.email}</td>
      <td>${f.gender}</td>
      <td>${f.age}</td>
      <td>${f.phone}</td>
      <td>${f.trn}</td>
      <td>${f.address}</td>
      <td>${f.parish}</td>
      <td>${f.club.name}</td>
      <td>${created}</td>
      <td><div class="row">
     <div class="col-sm-6 text-left"> <a class="text-warning editUser" title="Edit ${f.name}" id="edit${f.id}"><i class="fas fa-edit"></i></a></div>
      <div class="col-sm-6 text-right"><a class="text-danger deleteUser" title="Delete ${f.name}" id="delete${f.id}"><i class="fas fa-trash"></i></a></div>
      </div></td>
    </tr>`;
    });
    if (userDisplayTable) {
      userDisplayTable.innerHTML = userOutPut;
    }

    let editUser = document.querySelectorAll(".editUser");
    let deleteUser = document.querySelectorAll(".deleteUser");
    if (deleteUser) {
      deleteUser.forEach(d => {
        d.addEventListener("click", () => {
          let id = d.id.substr(6);
          console.log(id);
        });
      });
    }
  } catch (err) {
    console.log(err);
  }
};

var clubDropDownSort = async () => {
  try {
    let clubs = await axios.get("/admin/clubs");
    clubs.data.push({ name: "all", location: "Sort By Club" });
    let clubOut = "";
    clubs.data.forEach(c => {
      let name = c.name == "all" ? c.location : c.name;
      let selected = c.name == "all" ? "selected" : "";
      clubOut += `<option value="${c.name}" ${selected}>${name}</option>`;
    });
    clubSort.innerHTML = clubOut;
  } catch (err) {}
};

var clubDropDownCreate = async () => {
  let clubs = await axios.get("/admin/clubs");
  clubs.data.push({ name: "default", location: "Member Club" });
  let clubOut = "";
  clubs.data.forEach(c => {
    let name = c.name == "default" ? c.location : c.name;
    let selected = c.name == "default" ? "selected" : "";
    clubOut += `<option value="${c.name}" ${selected}>${name}</option>`;
  });
  club.innerHTML = clubOut;
};

clubDropDownCreate();
clubDropDownSort();
SearchUser();
