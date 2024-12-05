$(document).ready(function() {
    $('#requestForm').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var url = $('meta[name="request-store-route"]').attr('content');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: url,
            type: "POST",
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                $('#user_name_error').text('');
                $('#phone_error').text('');
                $('#product_color_id_error').text('');
                $('#successMessage').text(response.success).show();
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;

                if (errors) {
                    $('#user_name_error').text(errors.user_name ? errors.user_name[0] : '');
                    $('#phone_error').text(errors.phone ? errors.phone[0] : '');
                    $('#product_color_id_error').text(errors.product_color_id ? errors.product_color_id[0] : '');
                }

                $('#successMessage').hide();
            }
        });
    });
});
