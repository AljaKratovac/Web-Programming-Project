$(document).ready(function () {
    var app = $.spapp({
        defaultView: "home", // which view loads first
        templateDir: "views/" // where view files are stored
    });
    UserService.generateMenuItems();
    app.run();
});