async function modalRegistrarLibro() {
  try {
    const existingModal = document.getElementById("detalleLibroModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      if (modal) {
        modal.hide();
      }
      existingModal.remove();
    }

    const response = await fetch("modales/modalAdd.php");

    if (!response.ok) {
      throw new Error("Error al cargar la modal");
    }

    const data = await response.text();

    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = data;

    document.body.appendChild(modalContainer);

    const myModal = new bootstrap.Modal(
      modalContainer.querySelector("#agregarLibroModal")
    );
    myModal.show();
  } catch (error) {
    console.error(error);
  }
}

async function registrarLibro(event) {
  try {
    event.preventDefault();

    const formulario = document.querySelector("#formularioLibro");
    const formData = new FormData(formulario);

    const response = await axios.post("acciones/acciones.php", formData);

    if (response.status === 200) {
      window.insertLibroTable();

      setTimeout(() => {
        $("#agregarLibroModal").css("opacity", "");
        $("#agregarLibroModal").modal("hide");

        toastr.options = window.toastrOptions;
        toastr.success("¡El libro se registró correctamente!.");
      }, 600);
    } else {
      console.error("Error al registrar el libro");
    }
  } catch (error) {
    console.error("Error al enviar el formulario", error);
  }
}
