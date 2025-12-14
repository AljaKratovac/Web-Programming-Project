var UserService = {
    init: function () {
        var token = localStorage.getItem("user_token");
        if (token && token !== undefined) {
            window.location.replace("index.html");
        }
        $("#login-form").validate({
            submitHandler: function (form) {
            var entity = Object.fromEntries(new FormData(form).entries());
            UserService.login(entity);
            },
        });
    },
    login: function (entity) {
        $.ajax({
            url: Constants.PROJECT_BASE_URL + "auth/login",
            type: "POST",
            data: JSON.stringify(entity),
            contentType: "application/json",
            dataType: "json",
            success: function (result) {
            console.log(result);
            localStorage.setItem("user_token", result.data.token);
            window.location.replace("index.html");
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest?.responseText ?  XMLHttpRequest.responseText : 'Error');
            },
        });
    },


    logout: function () {
        localStorage.clear();
        window.location.replace("login.html");
    },
    
    generateMenuItems: function () {
        const token = localStorage.getItem("user_token");
        if (!token) return window.location.replace("login.html");

        const user = Utils.parseJwt(token).user;
        const nav = document.getElementById("nav-menu");

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
                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#students">Students</a>
                </li>
            `;
        }

        if (user.role === Constants.USER_ROLE) {
            // NORMAL USER MENU
            nav.innerHTML += `
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
    }

};