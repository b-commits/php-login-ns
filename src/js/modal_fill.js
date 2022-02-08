$('#exampleModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let full_name = button.data('full_name');
    let username = button.data('username');
    let email = button.data('email');
    let phone = button.data('phone');
    let gender = button.data('gender');
    let modal = $(this);

    modal.find('.modal-title').text('Edit user details: ' + username)
    modal.find('.full_name').val(full_name);
    modal.find('.username').val(username);
    modal.find('.email').val(email);
    modal.find('.phone').val(phone);
    modal.find('.id').val(id);
    modal.find('.gender').text(gender);
})

