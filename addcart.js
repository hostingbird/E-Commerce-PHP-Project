
var currentUrl = window.location.href;
        var url = new URL(currentUrl);
        var domain = url.hostname;
        var pathname = url.pathname;
        var pathParts = pathname.split('/').filter(Boolean);

        // Get the first directory (if it exists)
        var firstDirectory = pathParts.length > 0 ? '/' + pathParts[0] : '';
        let finalURL = domain+firstDirectory;
let addCart = document.querySelectorAll('.add-to-cart-button') ? document.querySelectorAll('.add-to-cart-button') : "";
function addToCart(product) {
    updateCartOnServer(product, 'add');
}

function CartLen() {
    fetchCartFromServer().then(response => {
        if (response && response.data && Array.isArray(response.data)) {
            let priceSum = 0;
            let list = document.getElementById('cartTotalItemList');
            document.getElementById('cartTotalItem').innerHTML = response.data.length;
            if (list) {
                list.innerHTML = '';
                for (let j = 0; j < response.data.length; j++) {
                    const element = response.data[j];
                    priceSum += element.price * element.quantity;
                }
                document.getElementById('cartTotalSum').innerHTML = priceSum;

                for (let i = 0; i < response.data.length; i++) {
                    const element = response.data[i];

                    if (i < 2) {
                        list.innerHTML += `
                        <li>
                            <img src="http://${finalURL}/asset/assets/images/product/${element.banner}" alt="${element.banner}">
                        </li>
                    `;
                    } else if (i === 2) {
                        list.innerHTML += `
                        <li>+${response.data.length - 2}</li>
                    `;
                        break;
                    }
                }
            }

        }

    }).catch(error => {
        console.error('Fetch error:', error);
    });
}

// Event listeners for DOM content loaded
document.addEventListener('DOMContentLoaded', function () {
    let counterCart = document.querySelectorAll('.counter-number') ? document.querySelectorAll('.counter-number') : null;
    let inputCart = document.querySelectorAll('.qty-input') ? document.querySelectorAll('.qty-input') : null;
    let minusPlus = document.querySelectorAll('.qty-left-minus, .qty-right-plus') ? document.querySelectorAll('.qty-left-minus, .qty-right-plus') : null;
    let cartBtn = document.querySelectorAll('.add-to-cart-button') ? document.querySelectorAll('.add-to-cart-button') : null;
    if (counterCart) {
        counterCart.forEach(productCard => {
            updateAddToCartButtonState(productCard);
        });
    }
    if (inputCart) {
        inputCart.forEach(input => {
            input.addEventListener('blur', function () {
                updateAddToCartButtonState(this.closest('.counter-number'));
            });
            input.addEventListener('focus', function () {
                updateAddToCartButtonState(this.closest('.counter-number'));
            });
            input.addEventListener('keyup', function () {
                updateAddToCartButtonState(this.closest('.counter-number'));
            });
            input.addEventListener('input', function () {
                updateAddToCartButtonState(this.closest('.counter-number'));
            });
        });
    }
    if (minusPlus) {
        minusPlus.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                let input = this.closest('.counter').querySelector('.qty-input');
                if (input) {
                    let currentValue = parseInt(input.value) || 0;
                    updateAddToCartButtonState(this.closest('.counter-number'));
                }
            });
        });
    }
    if (cartBtn) {
        cartBtn.forEach(btn => {
            btn.addEventListener('click', function (event) {
                let productCard = this.closest('.counter-number');
                let input = productCard.querySelector('.qty-input');
                if (input) {
                    let quantity = parseInt(input.value) || 0;
                    if (quantity <= 0 || quantity > 9) {
                        this.disabled = true;
                        return;
                    }
                    const product = {
                        user: this.dataset.set,
                        product_id: this.dataset.product,
                        quantity: parseInt(input.value),
                        price: parseFloat(this.dataset.price),
                        date: Date.now(),
                        banner: this.dataset.banner,
                        // session: this.dataset.session,
                        quantity_type: this.dataset.type,
                        ip: this.dataset.session,
                    };

                    addToCart(product);
                }
            });
        });
    }
    CartLen();
});

function updateAddToCartButtonState(productCard) {
    let input = productCard.querySelector('.qty-input');
    let button = productCard.querySelector('.add-to-cart-button');
    if (input && button) {
        let quantity = parseInt(input.value) || 0;
        button.disabled = quantity <= 0 || quantity > 9;
    }
}

function updateCartOnServer(product, action) {
    fetch('update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ product: product, action: action })
    }).then(response => response.json())
        .then(data => {
            if (data.status == "success") {
                CartLen();
                noti("Product added in cart")
            } else {
                noti("car updation responce not ok")
                noti(data.status, data.message, 'danger');
            }
        })
        .catch((error) => {
            noti("cart product failed! server error", "", "warning");
            // console.error('Error:', error);
        });
    // .catch((error) => {
    //     console.error('Error:', error);
    // });
}
// Function to fetch the cart from the server
function fetchCartFromServer() {
    return fetch('fetchcart.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }
        return response.json();
    }).catch((error) => {
        // console.error('Fetch error:', error);
        return { data: [] };
    });
}