import { Producto } from "./Producto.js";

const producto = new Producto();

producto.getCategorias(url);
producto.validateFormData();
producto.saveProducto(url);
// producto.mifuncion();

setTimeout(function() {
    console.clear();
  }, 10);

