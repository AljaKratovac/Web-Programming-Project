var ProductService = {
    baseUrl: Constants.PROJECT_BASE_URL + "products/",
    
    init: function () {
        // Check authentication
        const token = localStorage.getItem("user_token");
        if (!token) {
            window.location.replace("login.html");
            return;
        }
        
        // Initialize product listing if on products page
        if (document.getElementById("product-list")) {
            this.loadProducts();
        }
        
        // Initialize product form if on product management page
        if (document.getElementById("product-form")) {
            this.initProductForm();
        }
    },
    
    loadProducts: function () {
        $.ajax({
            url: this.baseUrl,
            type: "GET",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function (response) {
                ProductService.displayProducts(response.data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                toastr.error("Failed to load products");
                console.error(errorThrown);
            }
        });
    },
    
    displayProducts: function (products) {
        const container = document.getElementById("product-list");
        if (!container) return;
        
        container.innerHTML = "";
        
        products.forEach(product => {
            const productCard = `
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="${product.image || 'default-product.jpg'}" class="card-img-top" alt="${product.name}">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description || ''}</p>
                            <p class="fw-bold">$${product.price.toFixed(2)}</p>
                            ${ProductService.getProductActions(product)}
                        </div>
                    </div>
                </div>
            `;
            container.innerHTML += productCard;
        });
    },
    
    getProductActions: function (product) {
        const user = Utils.parseJwt(localStorage.getItem("user_token")).user;
        
        if (user.role === Constants.ADMIN_ROLE) {
            return `
                <div class="btn-group" role="group">
                    <button class="btn btn-warning btn-sm" onclick="ProductService.editProduct(${product.id})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="ProductService.deleteProduct(${product.id})">Delete</button>
                </div>
            `;
        } else {
            return `
                <button class="btn btn-primary" onclick="CartService.addToCart(${product.id})">Add to Cart</button>
            `;
        }
    },
    
    initProductForm: function () {
        $("#product-form").validate({
            submitHandler: function (form) {
                const product = Object.fromEntries(new FormData(form).entries());
                const productId = document.getElementById("product-id").value;
                
                if (productId) {
                    ProductService.updateProduct(productId, product);
                } else {
                    ProductService.createProduct(product);
                }
            }
        });
        
        // Check if editing existing product
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('id');
        if (productId) {
            this.loadProductForEdit(productId);
        }
    },
    
    loadProductForEdit: function (productId) {
        $.ajax({
            url: this.baseUrl + productId,
            type: "GET",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function (response) {
                const product = response.data;
                document.getElementById("productId").value = product.id;
                document.getElementById("name").value = product.name;
                document.getElementById("description").value = product.description || '';
                document.getElementById("price").value = product.price;
                document.getElementById("image").value = product.image || '';
                document.getElementById("stock_quantity").value = product.stock_quantity || 0;
            },
            error: function () {
                toastr.error("Failed to load product");
            }
        });
    },
    
    createProduct: function (product) {
        $.ajax({
            url: this.baseUrl,
            type: "POST",
            data: JSON.stringify(product),
            contentType: "application/json",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function (response) {
                toastr.success("Product created successfully");
                window.location.href = "products.html";
            },
            error: function (XMLHttpRequest) {
                toastr.error(XMLHttpRequest.responseText || "Failed to create product");
            }
        });
    },
    
    updateProduct: function (productId, product) {
        $.ajax({
            url: this.baseUrl + productId,
            type: "PUT",
            data: JSON.stringify(product),
            contentType: "application/json",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function (response) {
                toastr.success("Product updated successfully");
                window.location.href = "products.html";
            },
            error: function (XMLHttpRequest) {
                toastr.error(XMLHttpRequest.responseText || "Failed to update product");
            }
        });
    },
    
    deleteProduct: function (productId) {
        if (!confirm("Are you sure you want to delete this product?")) return;
        
        $.ajax({
            url: this.baseUrl + productId,
            type: "DELETE",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("user_token")
            },
            success: function () {
                toastr.success("Product deleted successfully");
                ProductService.loadProducts(); // Refresh the list
            },
            error: function () {
                toastr.error("Failed to delete product");
            }
        });
    },
    
    editProduct: function (productId) {
        window.location.href = "product-form.html?id=" + productId;
    }
};