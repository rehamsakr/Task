// Remove empty inputs name
$('#searchForm').submit(function () {
    $(this)
        .find('input[name], select[name]')
        .filter(function () {
            return !this.value;
        }).prop('name', '');
});

// Append Spinner When Form Submit
$(document).on('submit', 'form', function () {
    $(this).find('#submit').attr('disabled', true).append('<i class="fa fa-spinner fa-spin spinnerBTN"></i>');
    $(this).find('#submit').parent().find('a').hide();
});

function confirmation() {
    return confirm(CONFIRMATION_MSG)
}

$(document).on('click', '.confirmActionItem', function () {
    const Self = $(this);
    event.preventDefault();
    if(confirmation() === true) {
        $('#action-form').prop('action', Self.data('url')).submit();
    }
})

function imgError(image) {
    image.onerror = "";
    image.src = "/assets/images/default.png";
    return true;
}
