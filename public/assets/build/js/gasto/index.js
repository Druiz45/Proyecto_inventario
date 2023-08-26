import { Gasto } from "./Gasto.js";

const gasto = new Gasto();

gasto.getDataFormCreate(url);
gasto.validateFormData();
gasto.createGasto(url);