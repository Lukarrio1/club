import axios from "axios";
import $ from "jquery";

var navAdminName = document.querySelector("#navAdminName");
var adminEditForm = document.querySelector("#editAdmin");
var adminEditFields = document.querySelectorAll(".editAdmin");
/**
 * Event listeners
 */
if (adminEditForm) {
  adminEditForm.addEventListener("submit", e => {
    e.preventDefault();
    updateAdmin();
  });
}
/**
 * getAdmin, this function gets the current logged in user.
 * @return void
 */
var getAdmin = async () => {
  try {
    let admin = await axios.get("/admin/data");
    navAdminName.innerHTML = admin.data.name;
    let keys = Object.keys(admin.data);
    adminEditFields.forEach(f => {
      keys.forEach(k => {
        if (f.name == k) {
          f.value = admin.data[k];
        }
      });
    });
    console.log(admin);
    $("#adminName").html(admin.data.name);
    $("#adminEmail").html(admin.data.email);
  } catch (err) {
    throw err;
  }
};

getAdmin();

/**
 * updateAdmin, this function sends changes the admin made to his/her details
 * @return void
 */
var updateAdmin = async () => {
  let fd = new FormData();
  let pass = false;
  adminEditFields.forEach(f => {
    if (f.value == "") {
      notif({
        msg: `Field ${f.name} is empty or invalid`,
        type: "error",
        position: "center"
      });
    } else {
      pass = true;
      fd.append(f.name, f.value);
    }
  });
  try {
    await axios.post("/admin/edit", fd);
    notif({
      msg: `Admin details was updated successfully.`,
      type: "success",
      position: "center"
    });
    getAdmin();
  } catch (err) {
    throw err;
  }
};

var adminDelete = async () => {};
