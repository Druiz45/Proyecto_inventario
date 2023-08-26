import { Ingreso } from "./Ingreso.js";

const ingreso=new Ingreso();

ingreso.getDataFormCreate(url);
ingreso.validateFormData();
ingreso.createIngreso(url);
