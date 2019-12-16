import axios from "axios";

var store = require("../components/localStorage");
var val = require("../components/validate");
var nt = require("../components/toast");

var allClubs = document.querySelector("#allClubs");
var mClubSearch = document.querySelector("#searchMessage");
var clubNameFm = document.querySelector("#clubNameFm");
var allMessages = document.querySelector("#allMessages");
var sendMessage = document.querySelector("#sendMessage");
var message = document.querySelector("#message");
var messageBottom = document.getElementById("messageBottom");

if (mClubSearch) {
  mClubSearch.addEventListener("keyup", () => {
    SearchClubMessages(mClubSearch.value || "all");
  });
}

if (sendMessage) {
  sendMessage.addEventListener("submit", e => {
    e.preventDefault();
    sendMessage(message.value);
  });
}

var SearchClubMessages = async (search = "all") => {
  let fd = new FormData();
  let output = "";
  fd.append("search", search);
  try {
    let res = await axios.post("/admin/clubs/search", fd);
    res.data.forEach(({ id, name }) => {
      let isActive = store.get("club_id") == id ? "active" : "";
      output += ` <li class="list-group-item viewGroupMessage ${isActive}" style="cursor:pointer" id="gm${id}">${name}</li>`;
    });
    if (allClubs) {
      allClubs.innerHTML = output;
    }
    var viewGroupMessage = document.querySelectorAll(".viewGroupMessage");
    if (viewGroupMessage) {
      viewGroupMessage.forEach(v => {
        v.addEventListener("click", () => {
          let id = v.id.substring(2);
          store.set("club_id", id);
          SearchClubMessages(mClubSearch.value);
          getMessages();
        });
      });
    }
  } catch (err) {
    throw new Error(err);
  }
};

SearchClubMessages();

var getMessages = async () => {
  try {
    let res = await axios.get(`/admin/messages/${store.get("club_id")}`);
    let club = await axios.get(`/admin/club/${store.get("club_id")}`);
    let output = "";
    res.data.forEach(({ id, message, to, created_at }) => {
      let date =
        store.get("club_id") == to
          ? `<div class="text-grey"><small>Sent on ${val.formateDate(
              created_at
            )}</small></div>`
          : `<div class="text-grey"><small>Received on ${val.formateDate(
              created_at
            )}</small></div>`;
      let position =
        store.get("club_id") == to
          ? "text-right mr-5 mb-1"
          : "text-left ml-5 mb-1";
      let isDel =
        store.get("club_id") == to
          ? `   <div class="collapse ${position}" id="message${id}">
          <a href="#!" class="text-danger deleteMessage" id="deleteMessage${id}"><i class="fas fa-trash"></i></a>
          </div>`
          : "";
      output += `<div class="${position}" data-toggle="collapse" href="#message${id}">${message} ${date}</div>
      ${isDel}
   <br>`;
    });
    if (clubNameFm && allMessages && messageBottom) {
      clubNameFm.innerHTML = club.data.name;
      allMessages.innerHTML = output;
      messageBottom.scrollTop = messageBottom.scrollHeight;
      messageTimer();
    }

    var deleteMessage = document.querySelectorAll(".deleteMessage");
    if (deleteMessage) {
      deleteMessage.forEach(d => {
        d.addEventListener("click", () => {
          let id = d.id.substring(13);
          DeleteMessage(id);
        });
      });
    }
  } catch (err) {
    console.log(err.message);
  }
};

var sendMessage = async msg => {
  let fd = new FormData();
  fd.append("message", msg);
  fd.append("to", store.get("club_id"));
  try {
    let res = await axios.post("/admin/send/message", fd);
    getMessages();
    message.value = "";
  } catch (err) {
    console.log(err.message);
  }
};

if (store.get("club_id")) {
  getMessages();
}

var DeleteMessage = async id => {
  try {
    let res = axios.delete("/admin/message/delete/" + id);
    getMessages();
  } catch (err) {
    throw new Error(err);
  }
};

var messageTimer = () => {
  nt.toast("Message Timer  has been called", "success", "center");
  setInterval(() => {
    getMessages();
    messageTimer();
  }, 17000);
};
