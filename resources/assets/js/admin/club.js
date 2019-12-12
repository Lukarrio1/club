var axios = require("axios");
var $ = require("jquery");
var val = require("../components/validate.js");
var nt = require("../components/toast.js");
var store = require("../components/localStorage");
var searchClub = document.querySelector("#searchClub");
var clubOutPut = document.querySelector("#clubOutPut");
var clubCounts = document.querySelector("#clubCounts");
var createClub = document.querySelector("#createClub");
var fields = document.querySelectorAll(".createClub");
var editFields = document.querySelectorAll(".editClub");
var closeCreateClubModal = $("#closeCreateClubModal");
var closeEditClubModal = $("#closeEditClubModal");
var clubEditModal = document.querySelector("#clubEditModal");

if (searchClub) {
  searchClub.addEventListener("keyup", () => {
    SearchClub(searchClub.value);
  });
}

if (createClub) {
  createClub.addEventListener("submit", e => {
    e.preventDefault();
    CreateClub();
  });
}
if (clubEditModal) {
  clubEditModal.addEventListener("submit", e => {
    e.preventDefault();
    EditClub(store.get("club_id"));
  });
}

var SearchClub = async (search = "all") => {
  let fd = new FormData();
  fd.append("search", search);
  let outPut = "";
  try {
    let res = await axios.post("/admin/clubs/search", fd);
    if (clubCounts) clubCounts.innerHTML = res.data.length;
    res.data.forEach((c, i) => {
      let stripe = i % 2 ? "table-info" : "";
      outPut += `<tr class="${stripe}">
      <th scope="row" class="text-center">${i}</th>
      <td class="text-center">${c.name}</td>
      <td class="text-center">${c.location}</td>
      <td class="text-center">${c.member_count}</td>
      <td class="text-center">${val.formateDate(c.created_at)}</td>
      <td class="text-center">
          <div class="row">
          <div class="col-sm-6 text-right">
          <a href="#!" title ="Edit ${c.name}"  data-toggle="modal"
          data-target="#clubEditModal"class="text-warning editClubAction" id="editClub${
            c.id
          }"><i class="fas fa-edit"></i></a>
          </div>
          <div class="col-sm-6 text-left">
          <a href="#!" title ="Delete ${
            c.name
          }" class="text-danger deleteClubAction" id="deleteClub${
        c.id
      }"><i class="fas fa-trash"></i></a>
          </div>

          </div>

      </td>
  </tr>`;
    });
    if (clubOutPut) {
      clubOutPut.innerHTML = outPut;
    }
    let deleteClubAction = document.querySelectorAll(".deleteClubAction");
    if (deleteClubAction) {
      deleteClubAction.forEach(d => {
        d.addEventListener("click", () => {
          let id = d.id.substring(10);
          DeleteClub(id);
        });
      });
    }
    var editClubAction = document.querySelectorAll(".editClubAction");

    if (editClubAction) {
      editClubAction.forEach(e => {
        e.addEventListener("click", () => {
          let id = e.id.substring(8);
          store.set("club_id", id);
          populateEditModal(id);
        });
      });
    }
  } catch (err) {
    throw err;
  }
};

SearchClub();

var CreateClub = async () => {
  let fd = new FormData();
  let pass = false;
  fields.forEach(f => {
    if (f.value.length < 1) {
      nt.toast(
        `Club ${f.name} must be at least 3 characters`,
        "error",
        "center"
      );
      pass = false;
    } else {
      pass = true;
      fd.append(f.name, f.value);
    }
  });
  if (pass) {
    try {
      let res = await axios.post("/admin/club", fd);
      if (res.data.error) {
        nt.toast(res.data.status, "error", "center");
      } else {
        nt.toast("Club was created successfully.", "success", "center");
        SearchClub(searchClub.value);
        closeCreateClubModal.click();
        fields.forEach(f => (f.value = ""));
      }
    } catch (err) {
      throw err;
    }
  }
};

var DeleteClub = async id => {
  try {
    let res = await axios.delete("/admin/club/delete/" + id);
    nt.toast("Club was removed successfully.", "success", "center");
    SearchClub(searchClub.value);
  } catch (err) {
    throw err;
  }
};

var populateEditModal = async id => {
  try {
    let res = await axios.get("/admin/club/" + id);
    let keys = Object.keys(res.data);
    editFields.forEach(e => {
      keys.forEach(k => {
        if (e.name == k) {
          e.value = res.data[k];
        }
      });
    });
  } catch (err) {
    throw err;
  }
};

var EditClub = async id => {
  let fd = new FormData();
  let pass = false;
  editFields.forEach(e => {
    if (e.value.length < 3) {
      nt.toast(
        `Club ${e.name} must be at least 3 characters long.`,
        "error",
        "center"
      );
      pass = true;
    } else {
      fd.append(e.name, e.value);
      pass = true;
    }
  });
  if (pass) {
    let res = await axios.post("/admin/club/" + id, fd);
    if (res.data.error) {
      nt.toast(res.data.status, "error", "center");
    } else {
      closeEditClubModal.click();
      nt.toast("Club was successfully updated.", "success", "center");
      store.remove("club_id");
    }
  }
};
