import { User } from "./user/User.js";

const user = new User();

user.login(url);
user.showPass();
user.recoverPass(url);
user.validateFormRecoverPass();

