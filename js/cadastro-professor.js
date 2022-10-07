// let inputs = document.querySelector('.inputs-formacao');
// let lastInput = inputs.querySelector('.input input')
// lastInput.onchange = onChange;

// function onChange(event) {
//     console.log(event.srcElement)
//     if (event.srcElement.value.length > 0) {
//         let inputDiv = document.createElement('div')
//         inputDiv.classList.add('input')
//         let input = document.createElement('input')
//         input.type = "text"
//         input.placeholder = "Formação profissional desse professor";
//         input.name = "formacaoprofessor[]"
//         let btn = document.createElement('button')
//         btn.innerText = "Deletar Campo"
//         btn.type = "button"
//         btn.addEventListener('click', (btn) => {
//             deletarCampo(btn)
//         })
//         inputDiv.appendChild(input)
//         inputDiv.appendChild(btn)
//         inputs.appendChild(inputDiv);
//         input.onchange = onChange;
//         lastInput.onchange = () => { };
//         input.focus();
//         lastInput = input;
//     }
// }
// function deletarCampo(btn) {
//     btn = btn.srcElement;
//     if (btn.parentElement.parentElement.querySelectorAll('.input').length > 1) {
//         btn.parentElement.remove()
//         let input = inputs.querySelectorAll('.input')[inputs.querySelectorAll('.input').length - 1];
//         input.onchange = onChange;
//         input.focus()
//     }

// }

var controleCampo = 1;
function adicionarCampo() {
    controleCampo++;
    //console.log(controleCampo);

    document.getElementById('formacao').insertAdjacentHTML('beforeend', '<div class="formacao" id="campo' + controleCampo + '">  <input type = "text" placeholder = "Formação profissional desse professor" name ="formacaoprofessor[]" > <input type="text" placeholder="Local de sua formacao" name="localformacao[]" >   <input type="number" placeholder="Ano início de suaformação" name="inicioformacao[]" >  <input type="number" placeholder="Ano fim de sua formação" name="fimformacao[]">   <button type="button" id="' + controleCampo + '" onclick="removerCampo(' + controleCampo + ')"> - </button></div>');
}

function removerCampo(idCampo) {
    //console.log("Campo remover: " + idCampo);
    document.getElementById('campo' + idCampo).remove();
}