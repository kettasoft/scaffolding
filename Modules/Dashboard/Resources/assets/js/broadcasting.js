import Echo from "laravel-echo";

import pusherJs from "pusher-js";

window.Pusher = pusherJs;

let PUSHER_APP_KEY = document.head.querySelector('meta[name="PUSHER_APP_KEY"]');
let PUSHER_APP_CLUSTER = document.head.querySelector(
  'meta[name="PUSHER_APP_CLUSTER"]'
);
let PUSHER_APP_HOST = document.head.querySelector(
  'meta[name="PUSHER_APP_HOST"]'
);
let PUSHER_APP_PORT = document.head.querySelector(
  'meta[name="PUSHER_APP_PORT"]'
);
let PUSHER_APP_ENCRYPTED = document.head.querySelector(
  'meta[name="PUSHER_APP_ENCRYPTED"]'
);

window.Echo = new Echo({
  broadcaster: "pusher",
  key: PUSHER_APP_KEY ? PUSHER_APP_KEY.content : process.env.MIX_PUSHER_APP_KEY,
  cluster: PUSHER_APP_CLUSTER
    ? PUSHER_APP_CLUSTER.content
    : process.env.MIX_PUSHER_APP_CLUSTER,
  wsHost: PUSHER_APP_HOST
    ? PUSHER_APP_HOST.content
    : process.env.MIX_PUSHER_APP_HOST,
  wsPort: PUSHER_APP_PORT
    ? PUSHER_APP_PORT.content
    : process.env.MIX_PUSHER_APP_PORT,
  wssPort: PUSHER_APP_PORT
    ? PUSHER_APP_PORT.content
    : process.env.MIX_PUSHER_APP_PORT,
  useTLS: PUSHER_APP_ENCRYPTED
    ? PUSHER_APP_ENCRYPTED.content
    : process.env.MIX_PUSHER_APP_ENCRYPTED,
  disableStats: true,
  forceTLS: true,
  enabledTransports: ["ws", "wss"],
});
