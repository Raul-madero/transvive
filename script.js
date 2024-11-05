 // Toggle password visibility
    $('#togglePassword').click(function() {
        const passwordField = $('#password');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);

        // Toggle the icon
        $(this).toggleClass('fa-eye fa-eye-slash');
    });
