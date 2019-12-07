import axios from "axios";
import $ from "jquery";
var toast = require("../components/toast.js");
var val = require("../components/validate.js");

var fields = document.querySelectorAll(".createUser");
var createUserForm = document.querySelector("#createUserForm");
var closeCreateUserModalBtn = document.querySelector(
  "#closeCreateUserModalBtn"
);

/**
Event Listeners
*/
if (createUserForm) {
  createUserForm.addEventListener("submit", e => {
    e.preventDefault();
    CreateUser();
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
      console.log(err);
    }
  }
};
