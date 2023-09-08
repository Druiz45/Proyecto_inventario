import { User } from "./User.js";

const user = new User();

user.getDataFormCreate(url);
user.validateFormData();
user.saveUser(url);
user.eventInputsHidden();
user.updateUser(url);
user.logOut(url);
user.getDataFormUpdate(url);
user.updatePass(url);
user.showPass();

// setTimeout(function() {
//     console.clear();
//   }, 10);