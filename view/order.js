var currentUrl = window.location.href;
            const ordersContainer = document.getElementById('orders');
            var allOrders = [];


            // Fetch orders function
            async function fetchOrders() {
                
                try {
                    let response = await fetch('http://'+finalURL+'/view/fetch_orders.php'); 
                    if (!response.ok) {
                        throw new Error('Server response was not OK');
                    }

                    let orders = await response.json();

                    if (orders.length === 0) {
                        ordersContainer.innerHTML = `<div class="no-orders">cannot Proceed.</div>`;
                        return;
                    }

                    oneOrder(phpOrderId , orders);
                } catch (error) {
                    ordersContainer.innerHTML = `<div class="error-message">An error occurred. Please try again later.</div>`;
                }
            }
            fetchOrders();
            // display orders
            
            function oneOrder(orderId , data){
                     let filteredIDOrders = data.filter(order => order.order_id === orderId);
                     if (filteredIDOrders.length > 0) {
                           displayOrders(filteredIDOrders);
                     }
                      else{
                         displayOrders("Not Found");
                     }
            }
            
            function displayOrders(orders) {
                ordersContainer.innerHTML = '';

                if (orders.length === 0 || orders === "Not Found") {
                    ordersContainer.innerHTML = '<span class="no_error bg-light text-danger">Invalid Method Wrong Determine Id!</span>';
                    return;
                }

                const fragment = document.createDocumentFragment();

                orders.forEach(order => {
                    
                    let orderDiv = document.createElement('div');
                    orderDiv.className = 'order-container';

                    if ((order.process === 'take' || order.status === 'call') && (order.payment_status==="SUCCESS" || order.payment_status==="COD")) {
                        orderDiv.classList.add('pending');
                    } else if ((order.process === 'deleverd') && (order.payment_status==="SUCCESS" || order.payment_status==="COD")) {
                        orderDiv.classList.add('success');
                    } else {
                        orderDiv.classList.add('failure');
                    }
                       const dateStr = order.payment_time;
                    const date = new Date(dateStr);
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                    const year = date.getFullYear();
                    const formattedDate = `${day}-${month}-${year}`;

                    let orderHTML = `
                         <div class="bottom_order_det">
                            <div class="text-light p-2" style="background:#0baf9a;">Order Date: <b>${order.cf_order_id}</b>
                            </div>
                            <div class="bg-light p-2">Order Amount: <b>${order.order_amount} (INR)</b>
                            </div>
                        </div>
                    `;
                     if (order.payment_time != "" && order.payment_status !== "PENDING") {
                    orderHTML += `
                        <div class="bottom_order_det">
                            <div class="text-light p-2" style="background:#0baf9a;">Last updated : ${order.processDate}</div>
                            <div class="bg-light p-2">Order Date: <b>${formattedDate}</b>
                            </div>
                        </div>
                    `;
                }

                    order.products.forEach(product => {
                        console.log(product);
                        orderHTML += `
                            <div class="product-container">
                                <div class="product-img-div2">
                                    <img src="https://${finalURL}/asset/assets/images/product/${product.product_banner}" class="order_img2" />
                                </div>
                                <div class="OR_Data">
                                <div class="p-name">${product.product_name}</div>
                                <div class="p-price">Price : &#8377;${product.product_price}</div>
                                <div class="p-brand">sold by : ${product.product_brand}</div>
                                <div class="p-qty">qty : ${product.quantity}${product.product_unit.replace(/[0-9]/g, '')}</div>
                                </div>
                            </div>
                        `;
                    });
                    if (order.process == 'take' || order.process == 'call') {
                        orderHTML += `</div><div class="product-option pb-5 pt-2">
                            <div class="option">
                                <button class="btn bg-secondary text-light" style="float:right" onclick="location.href = 'contact.php?orderId=${order.order_id}'">cancel/help</button>
                            </div>
                        </div> `;
                    }else{
                        orderHTML += `</div>`;
                    }

                    orderDiv.innerHTML = orderHTML;
                    fragment.appendChild(orderDiv);
                });
                ordersContainer.appendChild(fragment);
            }