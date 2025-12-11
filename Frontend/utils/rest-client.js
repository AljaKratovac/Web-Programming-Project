const RestClient = {
    baseUrl: 'http://localhost/Web-Programming-Project/Backend/', 
    
    getHeaders: function() {
        const headers = {
            'Content-Type': 'application/json'
        };
        
        const token = localStorage.getItem('token');
        if (token) {
            headers['Authorization'] = 'Bearer ' + token;
        }
        
        return headers;
    },
    
    get: function(endpoint, success, error) {
        $.ajax({
            url: this.baseUrl + endpoint,
            type: 'GET',
            headers: this.getHeaders(),
            success: success,
            error: error
        });
    },
    
    post: function(endpoint, data, success, error) {
        $.ajax({
            url: this.baseUrl + endpoint,
            type: 'POST',
            headers: this.getHeaders(),
            data: JSON.stringify(data),
            success: success,
            error: error
        });
    },
    
    put: function(endpoint, data, success, error) {
        $.ajax({
            url: this.baseUrl + endpoint,
            type: 'PUT',
            headers: this.getHeaders(),
            data: JSON.stringify(data),
            success: success,
            error: error
        });
    },
    
    delete: function(endpoint, success, error) {
        $.ajax({
            url: this.baseUrl + endpoint,
            type: 'DELETE',
            headers: this.getHeaders(),
            success: success,
            error: error
        });
    }
};