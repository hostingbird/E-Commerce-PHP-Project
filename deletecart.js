document.addEventListener('DOMContentLoaded', function () {
    let cartPlus = document.querySelectorAll('.qty-right-plus');
    let cartMinus = document.querySelectorAll('.qty-left-minus');
    let cartInput = document.querySelectorAll('.qty-input');

    cartInput.forEach(input => {
        input.addEventListener('keyup', (e) => {
            e.preventDefault();
            if (e.keyCode === 38) {

                input.value = parseInt(input.value) + 1;
            }
            if (e.keyCode === 40) {
                input.value = parseInt(input.value) - 1;
            }
            input.value <= 0 ? input.value = 1 : input.value;
            updateCartItem(input.dataset.productId, parseInt(input.value));
        });
    });

    cartPlus.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            let input = btn.closest('.input-group').querySelector('.qty-input');
            let newValue = parseInt(input.value);
            input.value = newValue;
            updateCartItem(input.dataset.productId, newValue);
        });
    });

    cartMinus.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            let input = btn.closest('.input-group').querySelector('.qty-input');
            let newValue = parseInt(input.value);
            if (newValue < 1) newValue = 1;
            input.value = newValue;
            updateCartItem(input.dataset.productId, newValue);
        });
    });

    document.querySelectorAll('.remove-from-cart-button').forEach(btn => {
        btn.addEventListener('click', function () {
            const productId = this.dataset.productId;
            removeFromCart(productId);
        });
    });
});

function updateCartItem(productId, quantity) {
    fetch('update_cart.php', {
        method: 'POST',
        headers: {
            headers: { 'Content-Type': 'application/json' },
        },
        body: JSON.stringify({
            action: quantity > 0 ? 'update' : 'remove',
            product: { product_id: productId, quantity }
        })
    }).then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                fetchCartData();
                // Handle success
            } else {
                noti('', "there was an Error", "error");
            }
        })
        .catch(error => console.error('Error:', error));
}

function removeFromCart(productId) {
    fetch('remove_from_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: JSON.stringify({ product_id: productId })
    }).then(response => response.text())
        .then(data => {
            location.reload();
        })
        .catch(error => console.error('Error:', error));
}

function fetchCartData() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetchcart.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    processCartData(response.data);
                } else {
                    console.error(response.message);
                }
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
        } else {
            console.error("Failed to fetch data:", xhr.statusText);
        }
    };

    xhr.onerror = function () {
        console.error("Request error");
    };

    xhr.send();
}

function processCartData(cartItems) {
    let indivTotal = document.querySelectorAll('.eachProductTotal');
    let indivQuantity = document.querySelectorAll('.quantityTxt');
    // let indivSave = document.querySelectorAll('.indivPsave');
    // let totalAmt = document.querySelector('.Totalamt');
    // let totalSave = document.querySelector('.TotalDisc');
    let netPayAmt = document.querySelector('.TotalNetPay');

    let totalQuantity = 0;
    // let totalOfDisc = 0;
    let totalOfPay = 0;



    const calculatedTotals = cartItems.map(item => {
        const quantity = parseInt(item.quantity);
        const price = parseFloat(item.price);
        const totalPrice = quantity * price;
        return totalPrice;
    });
    const quantity = cartItems.map(item => {
        const quantity = item.quantity;
        return parseInt(quantity);
    });
    // const youSaveOne = cartItems.map(item => {
    //     const save = item.quantity * 12;
    //     return parseInt(save);
    // });

    indivTotal.forEach((div, index) => {
        div.innerHTML = parseFloat(calculatedTotals[index]);
    })
    indivQuantity.forEach((div, index) => {
        div.innerHTML = parseInt(quantity[index]);
        totalQuantity += parseInt(quantity[index]);
        totalOfPay += parseFloat(calculatedTotals[index]);
    })
    // indivSave.forEach((div, index) => {
    //     div.innerHTML = parseFloat(youSaveOne[index]);
    // })

    // totalAmt.innerHTML = parseFloat(totalOfPay) + (parseInt(totalQuantity) * 12);
    // totalSave.innerHTML = parseInt(totalQuantity) * 12;
    netPayAmt.innerHTML = parseFloat(totalOfPay);
}

fetchCartData();
