import { Ingreso } from "./Ingreso.js";

const ingreso=new Ingreso();

ingreso.getDataFormCreate(url);
ingreso.getDataFormUpdate(url);
ingreso.validateFormData();
ingreso.createIngreso(url);
ingreso.updateIngreso(url);
