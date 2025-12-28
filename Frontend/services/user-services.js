var UserService = {
    init: function () {
        var token = localStorage.getItem("user_token");
        if (token && token !== undefined) {
            window.location.replace("index.html");
            return; // Stop execution if redirected
        }
        
        // Login form validation
        $("#login-form").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                username: {
                    required: "Please enter your username",
                    minlength: "Username must be at least 3 characters"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Password must be at least 6 characters"
                }
            },
            submitHandler: function (form) {
                var entity = Object.fromEntries(new FormData(form).entries());
                UserService.login(entity);
                return false; // Prevent default form submission
            },
            errorPlacement: function(error, element) {
                error.addClass('text-danger small mt-1');
                error.insertAfter(element);
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            }
        });
        
        // Add user form validation (if on add-user page)
        if ($("#add-user-form").length) {
            this.initAddUserValidation();
        }
    },
    
    initAddUserValidation: function() {
        $("#add-user-form").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 20
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
                role: {
                    required: true
                },
                full_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                }
            },
            messages: {
                username: {
                    required: "Please enter a username",
                    minlength: "Username must be at least 3 characters",
                    maxlength: "Username cannot exceed 50 characters"
                },
                email: {
                    required: "Please enter an email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 8 characters",
                    maxlength: "Password cannot exceed 20 characters"
                },
                confirm_password: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                },
                role: {
                    required: "Please select a role"
                },
                full_name: {
                    required: "Please enter full name",
                    minlength: "Name must be at least 2 characters",
                    maxlength: "Name cannot exceed 100 characters"
                }
            },
            submitHandler: function(form) {
                var user = Object.fromEntries(new FormData(form).entries());
                UserService.addUser(user);
                return false;
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "role") {
                    error.insertAfter(element.parent());
                } else {
                    error.addClass('text-danger small mt-1');
                    error.insertAfter(element);
                }
            }
        });
    },

    login: function (entity) {
        // Show loading
        $.blockUI({ message: '<div class="spinner-border text-primary"></div>' });
        
        $.ajax({
            url: Constants.PROJECT_BASE_URL + "auth/login",
            type: "POST",
            data: JSON.stringify(entity),
            contentType: "application/json",
            dataType: "json",
            success: function (result) {
                console.log(result);
                localStorage.setItem("user_token", result.data.token);
                localStorage.setItem("user_data", JSON.stringify(result.data.user));
                
                toastr.success("Login successful!");
                setTimeout(function() {
                    window.location.replace("index.html");
                }, 1000);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                toastr.error(XMLHttpRequest?.responseText ? XMLHttpRequest.responseText : 'Login failed');
            },
            complete: function() {
                $.unblockUI();
            }
        });
    },

    logout: function () {
        // Optional: Call logout API before clearing
        $.ajax({
            url: Constants.PROJECT_BASE_URL + "auth/logout",
            type: "POST",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem("user_token")
            },
            success: function() {
                console.log("Logged out from server");
            },
            complete: function() {
                localStorage.clear();
                toastr.success("Logged out successfully");
                window.location.replace("login.html");
            }
        });
    },
    
    setupUser: function () {
        const token = localStorage.getItem("user_token");
        if (!token) {
            window.location.replace("login.html");
            return;
        }

        try {
            const user = Utils.parseJwt(token).user;
            const nav = document.getElementById("nav-menu");

            if (!nav) return;

            nav.innerHTML = ""; // clear old menu

            // HOME (everyone sees)
            nav.innerHTML += `
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#home">Home</a>
                </li>
            `;

            if (user.role === Constants.ADMIN_ROLE) {
                // ADMIN MENU
                nav.innerHTML += `
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#users">Users</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#add-user">Add User</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#reports">Reports</a>
                    </li>
                `;
            }

            if (user.role === Constants.USER_ROLE) {
                // NORMAL USER MENU
                nav.innerHTML += `
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#profile">Profile</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#about">About</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Contact</a>
                    </li>
                `;
            }

            // LOGOUT (everyone)
            nav.innerHTML += `
                <li class="nav-item mx-0 mx-lg-1">
                    <button class="btn btn-danger ms-3" onclick="UserService.logout()">Logout</button>
                </li>
            `;
            
            // Show user info
            const userInfo = document.getElementById("user-info");
            if (userInfo) {
                userInfo.innerHTML = `
                    <span class="badge bg-primary">${user.role}</span>
                    <span class="ms-2">${user.full_name || user.username}</span>
                `;
            }
        } catch (error) {
            console.error("Error setting up user:", error);
            localStorage.clear();
            window.location.replace("login.html");
        }
    },

    addUser: function(user) {
        // Remove confirm_password from the object before sending
        delete user.confirm_password;
        
        // Get token
        const token = localStorage.getItem("user_token");
        if (!token) {
            toastr.error("Please login first");
            window.location.replace("login.html");
            return;
        }
        
        // Show loading
        $.blockUI({ message: '<div class="spinner-border text-primary"></div>' });
        
        $.ajax({
            url: Constants.PROJECT_BASE_URL + "users",
            type: "POST",
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(user),
            dataType: "json",
            success: function(result) {
                toastr.success("User added successfully!");
                
                // Reset form
                $("#add-user-form")[0].reset();
                
                // Optionally redirect to users list
                if (confirm("User added successfully! Go to users list?")) {
                    window.location.href = "#users";
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                let errorMsg = XMLHttpRequest?.responseText || 'Failed to add user';
                try {
                    const errorJson = JSON.parse(errorMsg);
                    errorMsg = errorJson.message || errorMsg;
                } catch (e) {
                    // Keep original error message
                }
                toastr.error(errorMsg);
            },
            complete: function() {
                $.unblockUI();
            }
        });
    },

    getUsers: function() {
        const token = localStorage.getItem("user_token");
        if (!token) {
            window.location.replace("login.html");
            return;
        }
        
        $.ajax({
            url: Constants.PROJECT_BASE_URL + "users",
            type: "GET",
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(users) {
                // Callback to handle users data
                if (typeof UserService.onUsersLoaded === 'function') {
                    UserService.onUsersLoaded(users);
                }
            },
            error: function(XMLHttpRequest) {
                toastr.error("Failed to load users");
                console.error(XMLHttpRequest);
            }
        });
    },

    updateUser: function(id, userData) {
        const token = localStorage.getItem("user_token");
        if (!token) {
            toastr.error("Please login first");
            return;
        }
        
        $.ajax({
            url: Constants.PROJECT_BASE_URL + "users/" + id,
            type: "PUT",
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(userData),
            success: function(result) {
                toastr.success("User updated successfully!");
                UserService.getUsers(); // Refresh list
            },
            error: function(XMLHttpRequest) {
                toastr.error("Failed to update user");
            }
        });
    },

    deleteUser: function(id) {
        if (!confirm("Are you sure you want to delete this user?")) {
            return;
        }
        
        const token = localStorage.getItem("user_token");
        if (!token) {
            toastr.error("Please login first");
            return;
        }
        
        $.ajax({
            url: Constants.PROJECT_BASE_URL + "users/" + id,
            type: "DELETE",
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function() {
                toastr.success("User deleted successfully!");
                UserService.getUsers(); // Refresh list
            },
            error: function(XMLHttpRequest) {
                toastr.error("Failed to delete user");
            }
        });
    }
};