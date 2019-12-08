import axios from "axios";
import $ from "jquery";
var toast = require("../components/toast");

var navAdminName = document.querySelector("#navAdminName");
var adminEditForm = document.querySelector("#editAdmin");
var adminEditFields = document.querySelectorAll(".editAdmin");
var adminDeleteBtn = document.querySelector("#adminDeleteBtn");
/**
this event listens out for a submit event on the admin update form
*/
if (adminEditForm) {
  adminEditForm.addEventListener("submit", e => {
    e.preventDefault();
    updateAdmin();
  });
}

/**
 * 
 this even listens out for a click event on the admin delete btn
 */
if (adminDeleteBtn) {
  adminDeleteBtn.addEventListener("click", () => {
    adminDelete();
  });
}
/**
 * getAdmin, this function gets the current logged in user.
 * @return void
 */
var getAdmin = async (key = false) => {
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
    $("#adminName").html(admin.data.name);
    $("#adminEmail").html(admin.data.email);
    return key != false ? admin.data[key] : admin.data;
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
      toast.toast(`Field ${f.name} is empty or invalid`, "error", "center");
    } else {
      pass = true;
      fd.append(f.name, f.value);
    }
  });
  try {
    await axios.post("/admin/edit", fd);
    toast.toast("Admin details was updated successfully.", "success", "center");
    getAdmin();
  } catch (err) {
    throw err;
  }
};

var adminDelete = async () => {
  try {
    await axios.delete("/admin/delete");
    toast.toast("Admin account deleted successfully", "success", "center");
    setTimeout(() => (location.href = "/"), 5000);
  } catch (err) {
    throw err;
  }
};

export { getAdmin };
