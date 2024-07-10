function quitarDelCarrito(rowid) {
    if (rowid === 'all') {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, vaciar carrito',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Procede con la eliminación de todos los elementos del carrito
                $.ajax({
                    type: "POST",
                    url: baseURL + "quitarCarrito/" + rowid,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Carrito vaciado!',
                            showConfirmButton: false,
                            timer: 2000,
                            toast: true,
                            position: 'top-end',
                            width: '300px',
                            padding: '1em',
                            customClass: {
                                popup: 'small-swal-popup'
                            }
                        });

                        setTimeout(function() {
                            window.location.href = baseURL + "carrito";
                        }, 1500);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al vaciar el carrito:", error);

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Hubo un error al vaciar el carrito',
                            width: '300px',
                            padding: '1em',
                            customClass: {
                                popup: 'small-swal-popup'
                            }
                        });
                    }
                });
            }
        });
    } else {
        // Elimina un solo elemento del carrito
        $.ajax({
            type: "POST",
            url: baseURL + "quitarCarrito/" + rowid,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Producto eliminado del carrito',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                    width: '300px',
                    padding: '1em',
                    customClass: {
                        popup: 'small-swal-popup'
                    }
                });

                setTimeout(function() {
                    window.location.href = baseURL + "carrito";
                }, 1500);
            },
            error: function(xhr, status, error) {
                console.error("Error al quitar del carrito:", error);

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hubo un error al eliminar el producto del carrito',
                    width: '300px',
                    padding: '1em',
                    customClass: {
                        popup: 'small-swal-popup'
                    }
                });
            }
        });
    }
}

function changeQuantity(rowid, change, maxQty) {
    var qtyInput = document.getElementById('qty-' + rowid);
    var currentQty = parseInt(qtyInput.value);
    var newQty = currentQty + change;

    // Verificar que la nueva cantidad esté dentro del rango permitido
    if (newQty < 1) {
        newQty = 1;
    } else if (newQty > maxQty) {
        // Si la nueva cantidad excede el stock máximo, ajustarla al stock máximo
        newQty = maxQty;
        // Desactivar el botón de aumentar
        document.getElementById('btn-increment-' + rowid).disabled = true;
        // Mostrar un mensaje indicando que se ha alcanzado el stock máximo
        Swal.fire({
            icon: 'warning',
            title: 'Stock alcanzado',
            text: 'El stock máximo para este producto es ' + maxQty,
            width: '300px',
            padding: '1em',
            customClass: {
                popup: 'small-swal-popup'
            }
        });
        return;
    } else {
        // Habilitar el botón de aumentar si la nueva cantidad está dentro del rango permitido
        document.getElementById('btn-increment-' + rowid).disabled = false;
    }

    // Actualizar el valor del input de cantidad
    qtyInput.value = newQty;

    // Realizar una llamada AJAX para actualizar la cantidad en el carrito
    $.ajax({
        type: "POST",
        url: baseURL + "actualizarCarrito",
        data: { rowid: rowid, qty: newQty },
        success: function(response) {
            // No hacer nada en caso de que se haya alcanzado el stock máximo
            // ya que el mensaje de "Stock alcanzado" ya fue mostrado
            if (newQty === maxQty) {
                return;
            }
            Swal.fire({
                icon: 'success',
                title: 'Cantidad actualizada',
                showConfirmButton: false,
                timer: 1500,
                toast: true,
                position: 'top-end',
                width: '300px',
                padding: '1em',
                customClass: {
                    popup: 'small-swal-popup'
                }
            });
            setTimeout(function() {
                window.location.href = baseURL + "carrito";
            }, 1500);
        },
        error: function(xhr, status, error) {
            console.error("Error al actualizar la cantidad:", error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Hubo un error al actualizar la cantidad',
                width: '300px',
                padding: '1em',
                customClass: {
                    popup: 'small-swal-popup'
                }
            });
        }
    });
}











// function quitarDelCarrito(rowid) {
//     $.ajax({
//         type: "POST",
//         url: baseURL + "quitarCarrito/" + rowid,
//         success: function(response) {
//             // Mostrar notificación de éxito
//             Swal.fire({
//                 icon: 'success',
//                 title: 'Producto eliminado del carrito',
//                 showConfirmButton: false,
//                 timer: 1500 
//             });

//             setTimeout(function() {
//                 window.location.href = baseURL + "carrito";
//             }, 1500); 
//         },
//         error: function(xhr, status, error) {
//             console.error("Error al quitar del carrito:", error);

//             Swal.fire({
//                 icon: 'error',
//                 title: 'Oops...',
//                 text: 'Hubo un error al eliminar el producto del carrito',
//             });
//         }
//     });
// }











