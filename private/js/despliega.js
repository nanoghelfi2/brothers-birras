
function productos(){
var mostrar = document.querySelector('.contenedorProducto');
	if(mostrar.style.display === 'none'){
		mostrar.style.display = 'block';
		document.querySelector('.lugarEntrega').style.display = 'none';
		document.querySelector('.botonProductos').style.boxShadow = '0 0 8px 1px black';
		document.querySelector('.botonCliente').style.boxShadow = 'none';
	}else{
		mostrar.style.display = 'none';
		document.querySelector('.botonProductos').style.boxShadow = 'none';
	}
}

function cliente(){
	var mostrar = document.querySelector('.lugarEntrega');
		if(mostrar.style.display === 'none'){
			mostrar.style.display = 'block';
			document.querySelector('.contenedorProducto').style.display = 'none';
			document.querySelector('.botonCliente').style.boxShadow = '0 0 8px 1px black';
			document.querySelector('.botonProductos').style.boxShadow = 'none';
		}else{
			mostrar.style.display = 'none';
			document.querySelector('.botonCliente').style.boxShadow = 'none';
		}
	}

