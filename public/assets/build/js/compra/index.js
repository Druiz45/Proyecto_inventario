import { Compra } from "./Compra.js";
import { formatTotalAndAbono, setSaldo } from "../pedido/Pedido.js";
import { getDataProveedorForNameOrDoc} from "../user/User.js";

const compra=new Compra();

// compra.validateFormData();
compra.getDataFormCreate();
compra.saveCompra();
compra.getDataFormUpdate();
compra.updateCompra();
setSaldo();
formatTotalAndAbono();
getDataProveedorForNameOrDoc();
// setDataProveedor();