$(document).ready(function() {
    $('#diyRequestForm').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var url = $('meta[name="diy-request-store-route"]').attr('content');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: url,
            type: "POST",
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                $('#diy_user_name_error').text('');
                $('#diy_phone_error').text('');
                $('#diy_description_error').text('');
                $('#diySuccessMessage').text(response.success).show();
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;

                if (errors) {
                    $('#diy_user_name_error').text(errors.user_name ? errors.user_name[0] : '');
                    $('#diy_phone_error').text(errors.phone ? errors.phone[0] : '');
                    $('#diy_description_error').text(errors.description ? errors.description[0] : '');
                }

                $('#diySuccessMessage').hide();
            }
        });
    });
});
