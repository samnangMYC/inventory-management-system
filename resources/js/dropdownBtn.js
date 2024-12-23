
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

    // Update button text and hidden input value when a dropdown item is clicked
    $('#dropdownMenu a').on('click', function(event) {
        event.preventDefault(); // Prevent the default anchor click behavior
        const selectedValue = $(this).data('value'); // Get the value from data attribute
        const selectedText = $(this).text(); // Get the text of the selected role

        // Update the button text and hidden input value
        $('#dropdownButton').text(selectedText); // Update the button text
        $('#role_id').val(selectedValue); // Set the value of the hidden input to the role ID
        console.log(selectedText); // Log the selected value (role ID)
        console.log('Hidden Input Value:', $('#role').val()); // Log the value of the hidden input
        $('#dropdownMenu').addClass('hidden'); // Hide the dropdown menu
        });
        });