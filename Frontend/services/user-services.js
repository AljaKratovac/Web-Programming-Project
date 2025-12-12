const UserService = {
    init: function() {
        // Check if user is already logged in
        this.checkAuthStatus();
        
        // Initialize login/register functionality
        this.initAuthForms();
    },
    
    checkAuthStatus: function() {
        const token = localStorage.getItem('token');
        if (token) {
            // User is logged in, redirect to home
            window.location.href = 'index.html';
        }
    },
    
    initAuthForms: function() {
        // Login form
        $('#loginForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Password must be at least 6 characters"
                }
            },
            submitHandler: function(form) {
                UserService.login();
            }
        });
        
        // Register form
        $('#registerForm').validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirmPassword: {
                    required: true,
                    equalTo: "#registerPassword"
                }
            },
            messages: {
                name: "Please enter your full name",
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please create a password",
                    minlength: "Password must be at least 6 characters"
                },
                confirmPassword: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                }
            },
            submitHandler: function(form) {
                UserService.register();
            }
        });
        
        // Toggle between forms
        $('#showRegister').click(function(e) {
            e.preventDefault();
            $('.login-section').hide();
            $('#registerSection').show();
        });
        
        $('#showLogin').click(function(e) {
            e.preventDefault();
            $('#registerSection').hide();
            $('.login-section').show();
        });
    },
    
    login: function() {
        const email = $('#loginEmail').val();
        const password = $('#loginPassword').val();
        
        $.blockUI({ message: '<div>Logging in...</div>' });
        
        RestClient.post('api/auth/login', {
            email: email,
            password: password
        }, function(response) {
            $.unblockUI();
            
            if (response.token) {
                // Save user data
                localStorage.setItem('token', response.token);
                localStorage.setItem('user', JSON.stringify(response.user));
                
                toastr.success('Welcome back!');
                
                // Redirect to home page
                setTimeout(function() {
                    window.location.href = 'index.html';
                }, 1000);
            }
        }, function(error) {
            $.unblockUI();
            toastr.error('Invalid email or password');
        });
    },
    
    register: function() {
        const userData = {
            name: $('#registerName').val(),
            email: $('#registerEmail').val(),
            password: $('#registerPassword').val()
        };
        
        $.blockUI({ message: '<div>Creating your account...</div>' });
        
        RestClient.post('api/auth/register', userData, function(response) {
            $.unblockUI();
            
            toastr.success('Account created successfully! Please login.');
            
            // Clear form
            $('#registerForm')[0].reset();
            
            // Switch to login form
            $('#registerSection').hide();
            $('.login-section').show();
            
            // Pre-fill email
            $('#loginEmail').val(userData.email);
            
        }, function(error) {
            $.unblockUI();
            const message = error.responseJSON?.message || 'Registration failed';
            toastr.error(message);
        });
    },
    
    logout: function() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        toastr.success('Logged out successfully');
        window.location.href = 'login.html';
    },
    
    getCurrentUser: function() {
        const user = localStorage.getItem('user');
        return user ? JSON.parse(user) : null;
    },
    
    isAuthenticated: function() {
        return !!localStorage.getItem('token');
    },
    
    getToken: function() {
        return localStorage.getItem('token');
    }
};