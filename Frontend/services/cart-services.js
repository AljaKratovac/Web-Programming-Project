var CartService = {
    baseUrl: Constants.PROJECT_BASE_URL + "cart/",
    
    init: function () {
        // Check authentication
        const token = localStorage.getItem("user_token");
        if (!token) {
            window.location.replace("login.html");
            return;
        }
        
        // Initialize cart if on cart page
        if (document.getElementById("cart-items")) {
            this.loadCart();
            this.updateCartCount();
        }
    },
    
    loadCart: function () {
        $.ajax({
            url: this.baseUrl,
            type: "GET",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function (response) {
                CartService.displayCartItems(response.data);
                CartService.updateCartSummary(response.data);
            },
            error: function () {
                toastr.error("Failed to load cart");
            }
        });
    },
    
    displayCartItems: function (cartItems) {
        const container = document.getElementById("cart-items");
        if (!container) return;
        
        container.innerHTML = "";
        
        if (!cartItems || cartItems.length === 0) {
            container.innerHTML = `
                <div class="col-12 text-center py-5">
                    <h4>Your cart is empty</h4>
                    <a href="products.html" class="btn btn-primary mt-3">Browse Products</a>
                </div>
            `;
            return;
        }
        
        cartItems.forEach(item => {
            const cartItem = `
                <div class="cart-item row mb-3 align-items-center">
                    <div class="col-md-2">
                        <img src="${item.product.image || 'default-product.jpg'}" 
                             class="img-fluid rounded" 
                             alt="${item.product.name}">
                    </div>
                    <div class="col-md-4">
                        <h5>${item.product.name}</h5>
                        <p class="text-muted">${item.product.description || ''}</p>
                    </div>
                    <div class="col-md-2">
                        <p class="fw-bold">$${item.product.price.toFixed(2)}</p>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" 
                                    onclick="CartService.updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                            <input type="text" 
                                   class="form-control text-center" 
                                   value="${item.quantity}" 
                                   readonly>
                            <button class="btn btn-outline-secondary" 
                                    onclick="CartService.updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <p class="fw-bold">$${(item.product.price * item.quantity).toFixed(2)}</p>
                        <button class="btn btn-danger btn-sm" 
                                onclick="CartService.removeFromCart(${item.id})">
                            Remove
                        </button>
                    </div>
                </div>
                <hr>
            `;
            container.innerHTML += cartItem;
        });
    },
    
    updateCartSummary: function (cartItems) {
        if (!cartItems || cartItems.length === 0) {
            document.getElementById("cart-summary").innerHTML = `
                <div class="card-body text-center">
                    <h5>No items in cart</h5>
                </div>
            `;
            return;
        }
        
        const subtotal = cartItems.reduce((sum, item) => 
            sum + (item.product.price * item.quantity), 0);
        const tax = subtotal * 0.08; // 8% tax
        const total = subtotal + tax;
        
        document.getElementById("cart-summary").innerHTML = `
            <div class="card-body">
                <h5 class="card-title">Order Summary</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal:</span>
                    <span>$${subtotal.toFixed(2)}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Tax (8%):</span>
                    <span>$${tax.toFixed(2)}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <strong>Total:</strong>
                    <strong>$${total.toFixed(2)}</strong>
                </div>
                <button class="btn btn-success w-100" onclick="CartService.checkout()">
                    Proceed to Checkout
                </button>
            </div>
        `;
    },
    
    addToCart: function (productId) {
        const cartItem = {
            productId: productId,
            quantity: 1
        };
        
        $.ajax({
            url: this.baseUrl,
            type: "POST",
            data: JSON.stringify(cartItem),
            contentType: "application/json",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function () {
                toastr.success("Product added to cart");
                CartService.updateCartCount();
            },
            error: function () {
                toastr.error("Failed to add product to cart");
            }
        });
    },
    
    updateQuantity: function (cartItemId, newQuantity) {
        if (newQuantity < 1) {
            this.removeFromCart(cartItemId);
            return;
        }
        
        $.ajax({
            url: this.baseUrl + cartItemId,
            type: "PUT",
            data: JSON.stringify({ quantity: newQuantity }),
            contentType: "application/json",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function () {
                CartService.loadCart();
                CartService.updateCartCount();
            },
            error: function () {
                toastr.error("Failed to update quantity");
            }
        });
    },
    
    removeFromCart: function (cartItemId) {
        if (!confirm("Remove this item from cart?")) return;
        
        $.ajax({
            url: this.baseUrl + cartItemId,
            type: "DELETE",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function () {
                toastr.success("Item removed from cart");
                CartService.loadCart();
                CartService.updateCartCount();
            },
            error: function () {
                toastr.error("Failed to remove item");
            }
        });
    },
    
    checkout: function () {
        $.ajax({
            url: this.baseUrl + "checkout",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function (response) {
                toastr.success("Order placed successfully!");
                window.location.href = "order-confirmation.html?orderId=" + response.data.orderId;
            },
            error: function () {
                toastr.error("Checkout failed");
            }
        });
    },
    
    updateCartCount: function () {
        $.ajax({
            url: this.baseUrl,
            type: "GET",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function (response) {
                const cartCount = response.data.reduce((sum, item) => sum + item.quantity, 0);
                const cartBadge = document.getElementById("cart-count");
                if (cartBadge) {
                    cartBadge.textContent = cartCount;
                    cartBadge.style.display = cartCount > 0 ? "inline" : "none";
                }
            },
            error: function () {
                console.error("Failed to update cart count");
            }
        });
    }
};