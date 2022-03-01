function alert(message, type) {
    console.log(message);
    return '<div class="alert alert-' + type + '" role="alert">\n' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
        '<span aria-hidden="true">&times;</span>\n' +
        '</button>\n' +
        '<h4 class="alert-heading">' + message.title + '</h4>\n' +
        '<p>' + message.text + '</p>\n' +
        '</div>';
}
