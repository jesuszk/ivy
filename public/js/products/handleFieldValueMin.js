function toggleValueMin() {
    const controlStock = document.getElementById('control_stock');
    const valueMinDiv = document.getElementById('value-min');
    const valueMinInput = valueMinDiv.querySelector('input');

    if (controlStock.value !== '1') {
        valueMinInput.disabled = true;
        valueMinInput.value = '';
    } else {
        valueMinInput.disabled = false;
    }
}
toggleValueMin();