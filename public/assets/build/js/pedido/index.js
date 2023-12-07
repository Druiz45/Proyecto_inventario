import { getDataClienteForNameOrDoc } from "../cliente/Cliente.js";
import { Pedido, formatTotalAndAbono, setSaldo } from "./Pedido.js"; 

const pedido=new Pedido();

// pedido.validateFormData();
pedido.getDataFormCreate();
pedido.savePedido();
setSaldo();
formatTotalAndAbono();
getDataClienteForNameOrDoc();
// pedido.setSaldo();
// pedido.getDataFormUpdate();
pedido.updatePedido();
