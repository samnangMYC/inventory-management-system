
$(document).ready(function() {
    // Toggle dropdown visibility on button click
    $('#dropdownButton').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Close the dropdown if clicking outside of it
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
            $('#dropdownMenu').addClass('hidden');
        }
    });
});