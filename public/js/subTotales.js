function calulcarKilometroPorCombustible (kilometros){
    var combustibleXLitro = 0.20;
    var combustible = 0;
    combustible = kilometros * combustibleXLitro;
    document.getElementById('combEstimado').value = combustible;
    calulcarPrecioCombustible (combustible);
}

function calulcarPrecioCombustible (litros){
    var precioCombustiblePorLitro = 90;
    var total = 0;
    total = precioCombustiblePorLitro * litros;
    document.getElementById('precioCombustibleEstimado').value = total;
}

function gastosEstimados(gasto){
    var sumaGasto = 0;
    sumaGasto = parseInt(document.getElementById('precioCombustibleEstimado').value) + parseInt(gasto);
    document.getElementById('fprecio').value = sumaGasto;
}

























// function gastosEstimados(gasto){
//     // var totalFinal = 0;
//     // gasto = parseInt(gasto);
//     // totalFinal = document.getElementById('fprecio').value;
//     // totalFinal = parseInt(totalFinal) + gasto;
//     // document.getElementById('fprecio').value = totalFinal;
//
//     var precio = 0;
//     var totalFinal = 0;
//     gasto = parseInt(gasto);
//     precio = parseInt(document.getElementById('fprecio').value);
//     totalFinal = gasto + total;
//     sumaTotal(totalFinal)
// }
//
// function sumaTotal(){
//
// }