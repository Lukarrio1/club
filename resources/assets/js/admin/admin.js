var navAdminName = document.querySelector("#navAdminName");
import axios from "axios";

var getAdmin = async () => {
  try {
    let admin = await axios.get("/admin/data");
    navAdminName.innerHTML = admin.data.name;
  } catch (err) {
    console.log(err);
  }
};

getAdmin();
