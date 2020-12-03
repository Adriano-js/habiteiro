//Esperar a janela carregar para inciar o código.
window.onload = function(){ 

    //Declaração de variáveis.
    const camera = document.querySelector("#Layer_1"); //Câmera SVG.
    const cameraI = document.querySelector("#Layer_2"); //Câmera SVG Perfil.
    const x = document.querySelector("#Capa_1"); //X svg.
    const divpopup = document.querySelector("#submit-popup"); //Div de upar as fotos de fundo.
    const editarPerfil = document.querySelector("body > div > div.procrastinacao > div.topo > div.titulo > a"); //Selecionar 'Editar Perfil'

    editarPerfil.onclick = function myFunction() {
        if (camera.style.display === "block") {
            camera.style.display = "none";
        } else {
            camera.style.display = "block";
        }

        if (cameraI.style.display === "block") {
            cameraI.style.display = "none";
        } else {
            cameraI.style.display = "block";
        }
    }

    //Mostrar div ao clicar na câmera de perfil.
    cameraI.onclick = function myFunction() {
        if (divpopup.style.display === "block") {
            divpopup.style.display = "none";
        } else {
            divpopup.style.display = "block";
        }
    }
    
    //Mostrar div ao clicar na câmera de perfil.
    cameraI.onclick = function myFunction() {
        if (divpopup.style.display === "block") {
            divpopup.style.display = "none";
        } else {
            divpopup.style.display = "block";
        }
      }

    //Mostrar div ao clicar na câmera.
    camera.onclick = function myFunction() {
        if (divpopup.style.display === "block") {
            divpopup.style.display = "none";
        } else {
            divpopup.style.display = "block";
        }
      }

      //Fechar div popup ao clicar no X.
      x.onclick = function myFunction() {
        if (divpopup.style.display === "block") {
            divpopup.style.display = "none";
        }
      }
}