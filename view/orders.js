
 document.addEventListener("DOMContentLoaded", function() {
     var currentUrl = window.location.href;
        var url = new URL(currentUrl);
        var domain = url.hostname;
        var pathname = url.pathname;
        var pathParts = pathname.split('/').filter(Boolean);

        // Get the first directory (if it exists)
        var firstDirectory = pathParts.length > 0 ? '/' + pathParts[0] : '';
        let finalURL = domain+firstDirectory;
        
            const ordersContainer = document.getElementById('orders');
            const select = document.getElementById('Option');
            const inputres = document.getElementById('search__order');
            const totalOrder = document.getElementById('order_total');
            let totalProess = document.getElementById('order_process');
            
            let allOrders = [];

            fetchOrders();

            // Fetch orders function
            async function fetchOrders() {
                try {
                    let response = await fetch('http://'+finalURL+'/view/fetch_orders.php'); 
                    if (!response.ok) {
                        throw new Error('Server response was not OK');
                    }

                    let orders = await response.json();

                    if (orders.length === 0) {
                        ordersContainer.innerHTML = `<div class="no-orders">No orders found.</div>`;
                        return;
                    }

                    // Cache all orders and display them initially
                    allOrders = orders;
                    totalOrder.innerHTML = orders.length;
                    displayOrders(allOrders);

                } catch (error) {
                    ordersContainer.innerHTML = `<div class="error-message">An error occurred. Please try again later.</div>`;
                    console.error('error contact to contact support:', error);
                }
            }

            select.addEventListener('change', function() {
                const selectedValue = select.value;
                let filteredOrders = allOrders;

                switch (selectedValue) {
                     case 'pending':
                        filteredOrders = allOrders.filter(order => (order.payment_status === 'SUCCESS' || order.payment_status === 'COD') && order.process === 'take');
                        break;
                    case 'ship':
                        filteredOrders = allOrders.filter(order => (order.payment_status === 'SUCCESS' || order.payment_status === 'COD') && order.process === 'call');
                        break;
                    case 'delever':
                        filteredOrders = allOrders.filter(order => (order.payment_status === 'SUCCESS' || order.payment_status === 'COD') && order.process === 'deleverd');
                        break;
                    case 'cod':
                        filteredOrders = allOrders.filter(order => order.payment_status === 'COD');
                        break;
                    case 'online':
                        filteredOrders = allOrders.filter(order => order.payment_status === 'SUCCESS' || order.payment_status === 'PENDING');
                        break;
                    case 'paid':
                        filteredOrders = allOrders.filter(order => order.payment_status === 'SUCCESS');
                        break;
                    case 'unpaid':
                        filteredOrders = allOrders.filter(order => order.payment_status === 'COD');
                        break;
                    case 'fail':
                        filteredOrders = allOrders.filter(order => order.payment_status === 'PENDING');
                        break;
                    case 'return':
                        filteredOrders = allOrders.filter(order => order.process === 'return');
                        break;
                    default:
                        filteredOrders = allOrders;
                        break;
                }
                displayOrders(filteredOrders);
            });


            inputres.addEventListener('keyup', () => {
                const selectedValue = inputres.value.trim();
                     let filteredIDOrders = allOrders.filter(order => order.cf_order_id.toString().includes(selectedValue) || order.order_amount.includes(selectedValue));
    if (filteredIDOrders.length > 0) {
       displayOrders(filteredIDOrders);
    }
    else{
        displayOrders("Not Found");
    }
});
            

            // display orders
            function displayOrders(orders) {
                ordersContainer.innerHTML = '';

                if (orders.length === 0 || orders === "Not Found") {
                    ordersContainer.innerHTML = '<span class="no_error bg-light text-danger">No order Found</span>';
                    return;
                }

                // Create a fragment to reduce reflow
                const fragment = document.createDocumentFragment();
                let proessOD = 0;
                                        
                orders.forEach(order => {
                    const dateStr = order.payment_time;
                    const date = new Date(dateStr);
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                    const year = date.getFullYear();
                    const formattedDate = `${day}-${month}-${year}`;
                    let orderDiv = document.createElement('div');
                    orderDiv.className = 'order-container';
                    // orderDiv.style.cursor = "pointer";
                    // orderDiv.setAttribute("onclick",`location.href='my_order.php?order=${order.order_id}'`)

                    if ((order.process === 'take' || order.process === 'call') && (order.payment_status ==="SUCCESS" || order.payment_status ==="COD")) {
                        orderDiv.classList.add('pending');
                        proessOD++;
                    } else if (order.process === 'deleverd'&& (order.payment_status ==="SUCCESS" || order.payment_status ==="COD")) {
                        orderDiv.classList.add('success');
                    } else if(order.payment_status ==="PENDING"){
                        orderDiv.classList.add('failure');
                    }

                    let orderHTML = `
                         <div class="bottom_order_det">
                            <div class="bg-light p-2">Order Id : <b>${order.cf_order_id}</b>
                            </div>
                            <div class="bg-light p-2">Order Amount: <b>${order.order_amount} (INR)</b>
                            </div>
                        </div>
                        <div class="flex-pane">
                    `;

                    order.products.slice(0, 3).forEach(product => {
                        orderHTML += `
                            <div class="product-container">
                                <div class="product-img-div">
                                    <span class="OR_quantity">${product.quantity}${product.product_unit.replace(/[0-9]/g, '')}</span>
                                    <img src="https://${finalURL}/asset/assets/images/product/${product.product_banner}" class="order_product-img">
                                </div>
                            </div>
                        `;
                    });

                    if (order.products.length > 3) {
                        orderHTML += `
                        <div class="product-container">
                            <div class="product-img-div more-products">
                                <span>+ ${order.products.length - 3} <i style="font-size:15px;">more</i></span>
                            </div>
                        </div>
                        `;
                    }
                if (order.payment_time != "" && order.payment_status !== "PENDING") {
                    orderHTML += `
                        </div>
                        <div class="bottom_order_det">
                            <div class="text-light p-2" style="background:#0baf9a;">${order.order_note}</div>
                            <div class="bg-light p-2">Order Date: <b>${formattedDate}</b>
                            </div>
                        </div>
                    `;
                     if (order.process == 'take' || order.process == 'call' || order.process == 'deleverd') {
                        orderHTML += `<div class="product-option pb-5 pt-2">
                            <div class="option">
                                <button class="btn bg-secondary text-light" style="float:left" onclick="location.href = 'contact.php?orderId=${order.order_id}'">cancel/help</button>
                                
                                <button class="btn bg-primary text-light" style="float:right" onclick="location.href = 'my_order.php?orderId=${order.order_id}'">Expand</button>
                            </div>
                        </div>`;
                    }
                }
                  if (order.payment_time != "" && (order.payment_status === "SUCCESS" || order.payment_status === "COD")) {
                       if (order.process == 'return') {
                            orderDiv.style.background="#ee5a34";
                            orderDiv.style.opacity=".7";
                        orderHTML += `<div class="product-option pb-5 pt-2">
                            <div class="option">
                                <button class="btn bg-secondary text-light" style="float:left" onclick="location.href = 'contact.php?orderId=${order.order_id}'">cancel/help</button>
                            </div>
                        </div>`;
                    }
                  }

                    orderDiv.innerHTML = orderHTML;
                    fragment.appendChild(orderDiv);
                });
                ordersContainer.appendChild(fragment);
                totalProess.innerHTML = proessOD;
            }
            
        });