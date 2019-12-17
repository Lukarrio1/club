var userNotifications = document.querySelector("#userNotifications");
var notificationBell = $("#notificationBell");

var getNotifications = async () => {
  try {
    let res = await axios.get("/user/notifications");
    let output = "";
    res.data.forEach(n => {
      output += `<a class="dropdown-item ${n.class}" href="#!" id="notification${n.id}"><i class="${n.icon}"></i> ${n.notify}</a>`;
    });
    if (userNotifications && notificationBell) {
      userNotifications.innerHTML = output;
      if (res.data.length > 0) {
        notificationBell.addClass("text-info");
        notificationBell.html(" " + res.data.length);
      } else {
        notificationBell.removeClass("text-info");
      }
    }

    var ntMessages = document.querySelectorAll(".message");
    if (ntMessages) {
      ntMessages.forEach(m => {
        m.addEventListener("click", () => {
          let id = m.id.substring(12);
          removeNotification(id);
          location.href = "/user/messagePage";
        });
      });
    }
  } catch (err) {
    console.log(err.message);
  }
};

getNotifications();

var removeNotification = async id => {
  try {
    let res = await axios.delete("/user/notification/remove/" + id);
    getNotifications();
  } catch (err) {
    console.log(err.message);
  }
};

module.exports = { getNotifications };
