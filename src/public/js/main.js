function notification(text, color = 'primary', timer = 8000, from = 'top', align = 'right') {
    $.notify({
        icon: "now-ui-icons ui-1_bell-53",
        message: text

    }, {
        type: color,
        timer: timer,
        placement: {
            from: from,
            align: align
        }
    });
}

function primaryNotification(text){
    notification(text, 'primary');
}
function infoNotification(text){
    notification(text, 'info');
}
function successNotification(text){
    notification(text, 'success');
}
function warningNotification(text){
    notification(text, 'warning');
}
function dangerNotification(text){
    notification(text, 'danger');
}

function selectNotification(type, text){
    switch(type){
        case "notification_primary":
            primaryNotification(text);
            break;
        case "notification_info":
            infoNotification(text);
            break;
        case "notification_success":
            successNotification(text);
            break;
        case "notification_warning":
            warningNotification(text);
            break;
        case "notification_danger":
            dangerNotification(text);
            break;
    }
}

function showNotification(obj_data){
    for(var key in obj_data){
        selectNotification(key, obj_data[key])
    }
}

function jqXHRNotification(jqXHR){
    var response = jqXHR.responseText,
        obj = $.parseJSON(response),
        errors = obj.errors;
    for(var key in errors){
        for(var i in errors[key]){
            dangerNotification(errors[key][i])
        }

    }
}

function showPreloader(){
    $("#loader").fadeIn();
}

function hidePreloader(){
    $("#loader").fadeOut();
}
