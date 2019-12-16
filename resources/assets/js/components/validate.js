var axios = require("axios");

var validateEmail = email => {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
};

var IsEmailInUse = async email => {
  let fd = new FormData();
  if (!validateEmail(email)) {
    return 1;
  } else {
    try {
      fd.append("email", email);
      let res = await axios.post("/admin/user/emailCheck", fd);
      if (res.data.status == 0) {
        return 0;
      } else {
        return 1;
      }
    } catch (err) {
      console.log(err);
    }
  }
};

var formateDate = d => {
  let created_at = new Date(d);
  return created_at.toString().slice(0, 24);
};

var IsClubAvai = async club => {
  try {
    let res = await axios.get("/admin/clubs");
    let result = res.data.filter(c => c.name == club);
    return result;
  } catch (err) {
    console.log(err.message);
  }
};

module.exports = { validateEmail, IsEmailInUse, formateDate, IsClubAvai };
