import { Pedido } from "./Pedido.js"; 

const pedido=new Pedido();

pedido.validateFormData();
pedido.getDataFormCreate();
pedido.savePedido();
pedido.getDataFormUpdate();
pedido.updatePedido();
