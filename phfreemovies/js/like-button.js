jQuery(document).ready(function($) {
    $('.like-button').on('click', function() {
        const button = $(this);
        const movieId = button.data('movie-id');

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'like_movie',
                movie_id: movieId,
            },
            success: function(response) {
                if (response.success) {
                    button.text('Liked').attr('disabled', true);
                } else {
                    alert(response.data.message);
                }
            },
        });
    });
});


// dark-mode.js
document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('dark-mode-toggle');
    const body = document.body;

    // Check local storage for user preference
    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    toggleButton.addEventListener('click', function () {
        body.classList.toggle('dark-mode');

        // Save user preference in local storage
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'enabled');
        } else {
            localStorage.setItem('dark-mode', 'disabled');
        }
    });
});
