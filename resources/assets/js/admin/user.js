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
    console.log(parishSort.value);
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
    toast.toast("The members is required.", "error", "center");
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
    try {
      let res = await axios.post("/admin/create", fd);
      closeCreateUserModalBtn.click();
      toast.toast(
        "Member was added to the club successfully",
        "success",
        "center"
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
    let pSort = res.data.filter(p => p.parish == parish);
    let cSort = res.data.filter(c => c.club.name == club);
    let result = [];
    if (parish != "all") {
      result = cSort.length > 0 || club == "all" ? pSort.slice(0, limit) : [];
    } else if (club != "all") {
      result = pSort.length > 0 || parish == "all" ? cSort.slice(0, limit) : [];
    } else if (parish == "all" && club == "all") {
      result = res.data.slice(0, limit);
    } else {
      result = res.data;
    }
    if (limitMax) {
      limitMax.innerHTML = "All Users";
      limitMax.value = res.data.length;
    }
    console.table(result);
    result.forEach(r => {
      console.log(r.club);
    });
  } catch (err) {
    console.log(err);
  }
};

var clubDropDown = async () => {
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

clubDropDown();
SearchUser();
