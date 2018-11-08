

function showNotification(text, color = 'primary', timer = 8000, from = 'top', align = 'left') {
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
