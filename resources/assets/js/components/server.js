import server from "laravel-echo";
window.Pusher = require("pusher-js");

let Echo = new server({
  broadcaster: "pusher",
  key: "6157f2dfcc34afd2a8ca"
});

export { Echo };
