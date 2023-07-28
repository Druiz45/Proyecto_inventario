import { User } from "./User.js";

const user = new User();

user.getDataFormCreate(url);
user.validateFormData();
user.saveUser(url);
user.logOut(url);
user.getDataFormUpdate(url);

// setTimeout(function() {
//     console.clear();
//   }, 10);