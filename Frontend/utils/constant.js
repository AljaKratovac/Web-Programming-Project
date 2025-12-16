let Constants = {
   PROJECT_BASE_URL: "http://localhost/Web-Programming-Project/Backend/",
   USER_ROLE: "user",
   ADMIN_ROLE: "admin"
}

services: 
user-service.js
// services/user-service.js
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
js: 
register.js
$(document).ready(function() {
            // Initialize form validation
            initRegistrationForm();
            
            // Password strength indicator
            $('#password').on('input', checkPasswordStrength);
            
            // Real-time password matching
            $('#confirmPassword').on('input', checkPasswordMatch);
            
            // Focus on name field
            $('#name').focus();
        });
        
        function initRegistrationForm() {
            $('#registerForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
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
                        equalTo: "#password"
                    },
                    terms: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your full name",
                        minlength: "Name must be at least 2 characters"
                    },
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
                    },
                    terms: {
                        required: "You must agree to the terms and conditions"
                    }
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.after(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                submitHandler: function(form) {
                    registerUser();
                    return false;
                }
            });
        }
        
        function checkPasswordStrength() {
            const password = $('#password').val();
            const strengthBar = $('#passwordStrength');
            
            if (password.length === 0) {
                strengthBar.removeClass().addClass('password-strength');
                return;
            }
            
            let strength = 0;
            
            // Length check
            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            
            // Character variety checks
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            // Update strength bar
            strengthBar.removeClass().addClass('password-strength');
            
            if (strength <= 1) {
                strengthBar.addClass('strength-weak');
            } else if (strength === 2) {
                strengthBar.addClass('strength-medium');
            } else if (strength === 3 || strength === 4) {
                strengthBar.addClass('strength-strong');
            } else {
                strengthBar.addClass('strength-very-strong');
            }
        }
        
        function checkPasswordMatch() {
            const password = $('#password').val();
            const confirmPassword = $('#confirmPassword').val();
            const errorElement = $('#confirmPasswordError');
            
            if (confirmPassword.length === 0) {
                $('#confirmPassword').removeClass('is-invalid is-valid');
                errorElement.hide();
                return;
            }
            
            if (password === confirmPassword) {
                $('#confirmPassword').removeClass('is-invalid').addClass('is-valid');
                errorElement.hide();
            } else {
                $('#confirmPassword').removeClass('is-valid').addClass('is-invalid');
                errorElement.show();
            }
        }
        
        function registerUser() {
            const userData = {
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val()
            };
            
            // Add newsletter preference if checked
            if ($('#newsletter').is(':checked')) {
                userData.newsletter = true;
            }
            
            // Disable button and show loading
            const registerButton = $('#registerButton');
            registerButton.prop('disabled', true);
            registerButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating account...');
            
            // Make API call
            RestClient.post('/api/auth/register.php', userData, 
                function(response) {
                    // Registration successful
                    toastr.success('Account created successfully! Redirecting to login...');
                    
                    // Reset form
                    $('#registerForm')[0].reset();
                    $('#passwordStrength').removeClass().addClass('password-strength');
                    
                    // Redirect to login page after delay
                    setTimeout(function() {
                        window.location.href = 'login.html?email=' + encodeURIComponent(userData.email);
                    }, 2000);
                    
                }, 
                function(error) {
                    // Registration failed
                    registerButton.prop('disabled', false);
                    registerButton.html('<i class="bi bi-person-plus me-2"></i> Create Account');
                    
                    let errorMessage = 'Registration failed. Please try again.';
                    
                    if (error.responseJSON && error.responseJSON.error) {
                        errorMessage = error.responseJSON.error;
                    } else if (error.status === 409) {
                        errorMessage = 'This email is already registered. Please login instead.';
                    } else if (error.status === 400) {
                        errorMessage = 'Please check your information and try again.';
                    }
                    
                    toastr.error(errorMessage);
                    
                    // Highlight problematic fields
                    if (errorMessage.includes('email')) {
                        $('#email').addClass('is-invalid');
                    }
                }
            );
        }
        
        // Check URL for pre-filled email
        function getUrlParameter(name) {
            name = name.replace(/[\[\]]/g, '\\$&');
            const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
            const results = regex.exec(window.location.search);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }
        
        // Pre-fill email if provided in URL
        const emailFromUrl = getUrlParameter('email');
        if (emailFromUrl) {
            $('#email').val(emailFromUrl);
        }
login.js 
 $(document).ready(function() {
            // Initialize form validation
            initLoginForm();
            
            // Check if user is already logged in
            checkAuthStatus();
            
            // Focus on email field
            $('#email').focus();
            
            // Pre-fill email from URL if provided
            const urlParams = new URLSearchParams(window.location.search);
            const emailFromUrl = urlParams.get('email');
            if (emailFromUrl) {
                $('#email').val(emailFromUrl);
                $('#password').focus();
            }
        });
        
        function checkAuthStatus() {
            const token = localStorage.getItem('token');
            if (token) {
                // User is already logged in, redirect to home
                window.location.href = '../index.html';
            }
        }
        
        function initLoginForm() {
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
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.after(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                submitHandler: function(form) {
                    loginUser();
                    return false;
                }
            });
        }