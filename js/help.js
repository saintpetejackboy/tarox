 // Use 'touchstart' along with 'click' for mobile compatibility
 $('body').off('click touchstart', '.help-button').on('click touchstart', '.help-button', function(event) {
    event.preventDefault();
    event.stopPropagation();
    
    // Check if the help modal already exists
    if ($('#help-hider').length === 0 && $('#help-div').length === 0) {
        // Append the help-hider modal to blur everything underneath
        $('body').append('<div id="help-hider"></div>');
        $('#help-hider').css({
            'position': 'fixed',
            'top': 0,
            'left': 0,
            'width': '100vw',
            'height': '100vh',
            'background-color': 'rgba(10, 10, 10, 0.5)',
            'z-index': 9000,
            'backdrop-filter': 'blur(5px)'
        });

        // Append the help-div modal to the body
        $('body').append('<div id="help-div" style="padding: 20px; background-color: #222; color: #f5f5f5; font-family: Arial, sans-serif; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);"></div>');

        // Load the help.html content into the help-div
        $('#help-div').load('help.html');

        $('#help-div').css({
            'position': 'fixed',
            'top': '50%',
            'left': '50%',
            'transform': 'translate(-50%, -50%)',
            'font-size': '1rem',
            'background-color': '#222222',
            'padding': '20px',
            'border-radius': '8px',
            'box-shadow': '0 4px 8px rgba(0, 0, 0, 0.1)',
            'max-width': '90vw',
            'min-width': '90vw',
            'max-height': '70vh',
            'min-height': '70vh',
            'overflow-y': 'auto',
            'z-index': 9000,
            'word-wrap': 'break-word'
        });

        // Close the modal when clicking outside of it
        $(document).on('click touchstart', function(event) {
            if (!$(event.target).closest('#help-div, #help-button').length) {
                closeHelpModal();
            }
        });

        // Close the modal when the close button is clicked
        $('body').off('click touchstart', '.close-help').on('click touchstart', '.close-help', function() {
            closeHelpModal();
        });

        // Function to close the help modal and remove the hider
        function closeHelpModal() {
            $('#help-div').remove();
            $('#help-hider').remove();
        }
    }
});