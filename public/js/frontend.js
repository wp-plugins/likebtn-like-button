// Call ajax handler and custom event handler if set
function likebtn_eh(event)
{
    // Call custom event_handler if set
    if (event.wrapper) {
        var custom_eh = event.wrapper.getAttribute('data-custom_eh');
        if (custom_eh) {
            var callback = window[custom_eh];
            if (typeof(callback) === 'function') {
                try {
                    callback(event);
                } catch(e) {
                    likebtn_log("Error occured calling event handler function '" + custom_eh + "': " + e.message);
                }
            }
        }
    }

    var type = 0;
    if (event.type === "likebtn.like") {
        type = 1;
    }
    if (event.type === "likebtn.dislike") {
        type = -1;
    }

    if (type == 0) {
        return;
    }

    // Check if ajax data is set using wp_localize_script
    if (typeof(likebtn_eh_data) === "undefined") {
        likebtn_log('likebtn_eh_data not set');
        return;
    }

    // Ajax
    var data = {
        action: 'likebtn_event_handler',
        type: type,
        identifier: event.settings.identifier,
        security: likebtn_eh_data.security
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    likebtn_ajax(likebtn_eh_data.ajaxurl, data, function() {
        if (this.readyState == XMLHttpRequest.DONE ) {
            if (this.status == 200) {
               var response = JSON.parse(this.responseText);

               if (response) {
                    if (response.result && response.result == 'success') {

                    } else {
                        var msg = 'Error sending ajax request';
                        if (response.message) {
                            msg += ': '+response.message;
                        }
                        likebtn_log(msg);
                    }
                } else {
                    likebtn_log('Error parsing ajax response');
                }
            } else {
                likebtn_log('Error sending ajax request');
           }
        }
    });
}

// Send ajax request to the server
function likebtn_ajax(url, data, callback, method)
{
    var xmlhttp;

    if (typeof(method) === "undefined") {
        method = "POST";
    }

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = callback;

    xmlhttp.open(method, url, true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send(likebtn_http_build_query(data));
}

// Log a message
function likebtn_log(msg)
{
    if (typeof(console) !== "undefined") {
        console.log(msg);
    }
}

// Convert array to params string
function likebtn_http_build_query(params) {
    var lst = [];
    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            lst.push(encodeURIComponent(key)+"="+encodeURIComponent(params[key]));
        }
    }
    return lst.join("&");
}
