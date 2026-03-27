// Fallback rating system if Raty plugin fails
function initFallbackRating(elementId) {
    const container = $(`#${elementId}`);
    container.empty();
    
    // Create 5 stars
    for (let i = 1; i <= 5; i++) {
        const star = $('<i class="fa fa-star-o rating-star"></i>');
        star.attr('data-value', i);
        star.css({
            'font-size': '32px',
            'color': '#ddd',
            'cursor': 'pointer',
            'padding': '0 5px'
        });
        container.append(star);
    }
    
    // Click handler
    container.find('.rating-star').on('click', function() {
        const value = $(this).data('value');
        $('#ratingValue').val(value);
        
        // Update star display
        container.find('.rating-star').each(function(index) {
            if (index < value) {
                $(this).removeClass('fa-star-o fa-star-half-o').addClass('fa-star');
                $(this).css('color', '#ffc107');
            } else {
                $(this).removeClass('fa-star fa-star-half-o').addClass('fa-star-o');
                $(this).css('color', '#ddd');
            }
        });
        
        console.log('Fallback rating selected:', value);
    });
    
    // Hover effect
    container.find('.rating-star').on('mouseenter', function() {
        const value = $(this).data('value');
        container.find('.rating-star').each(function(index) {
            if (index < value) {
                $(this).css('color', '#ffc107');
            }
        });
    });
    
    container.on('mouseleave', function() {
        const currentValue = $('#ratingValue').val();
        if (currentValue) {
            container.find('.rating-star').each(function(index) {
                if (index < currentValue) {
                    $(this).css('color', '#ffc107');
                } else {
                    $(this).css('color', '#ddd');
                }
            });
        } else {
            container.find('.rating-star').css('color', '#ddd');
        }
    });
}

// Use this function if Raty fails
function openRatingModalFallback(businessId, businessName) {
    $('#ratingBusinessId').val(businessId);
    $('#ratingBusinessName').text(businessName);
    $('#ratingForm')[0].reset();
    $('#ratingValue').val('');
    
    $('#ratingModal').modal('show');
    
    setTimeout(function() {
        initFallbackRating('ratingStars');
    }, 100);
}
