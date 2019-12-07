var toast = (msg, type, position) => {
  notif({
    msg: msg,
    type: type,
    position: position
  });
};

module.exports = { toast };
