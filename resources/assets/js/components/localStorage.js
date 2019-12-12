var get = key => JSON.parse(localStorage.getItem(key)) || null;

var set = (key, data) => localStorage.setItem(key, JSON.stringify(data));

var remove = key => (localStorage.removeItem(key) ? 1 : 0);

module.exports = { get, set, remove };
