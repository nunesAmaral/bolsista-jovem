var counter = 0;
let profQtd = document.querySelectorAll('.profRight').length;
let profFirst = document.querySelectorAll('.profRight')[Math.floor(Math.random() * profQtd)]
profFirst.classList.remove('hide')
document.querySelector(`div[value="${profFirst.getAttribute('list-id')}"]`).classList.add('selected');
function change(seletor) {
    document.querySelectorAll('.profInfo').forEach(v => v.classList.remove('selected'))
    seletor.classList.add('selected');
    const value = seletor.getAttribute('value');
    const actives = document.querySelectorAll('.profRight').forEach(v => {
        v.classList.add('hide')
    })
    const el = document.querySelector(`div[list-id="${value}"]`)
    el.classList.remove('hide')
}