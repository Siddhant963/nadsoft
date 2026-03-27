$(document).ready(function() {
    console.log('App initialized');
    loadBusinesses();
    
    $('#saveBusinessBtn').click(function() {
        if (!validateBusinessForm('#addBusinessForm')) {
            return;
        }
        
        $.ajax({
            url: 'ajax/business_ajax.php?action=add',
            type: 'POST',
            data: $('#addBusinessForm').serialize(),
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                if (response.status === 'success') {
                    $('#addBusinessModal').modal('hide');
                    $('#addBusinessForm')[0].reset();
                    clearValidationErrors('#addBusinessForm');
                    loadBusinesses();
                }
            }
        });
    });
    
    $('#updateBusinessBtn').click(function() {
        if (!validateBusinessForm('#editBusinessForm')) {
            return;
        }
        
        $.ajax({
            url: 'ajax/business_ajax.php?action=update',
            type: 'POST',
            data: $('#editBusinessForm').serialize(),
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                if (response.status === 'success') {
                    $('#editBusinessModal').modal('hide');
                    clearValidationErrors('#editBusinessForm');
                    loadBusinesses();
                }
            }
        });
    });
    
    $('#submitRatingBtn').click(function() {
        if (!validateRatingForm()) {
            return;
        }
        
        $.ajax({
            url: 'ajax/rating_ajax.php?action=submit',
            type: 'POST',
            data: $('#ratingForm').serialize(),
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                if (response.status === 'success') {
                    $('#ratingModal').modal('hide');
                    $('#ratingForm')[0].reset();
                    clearValidationErrors('#ratingForm');
                    updateBusinessRating(response.business_id, response.avg_rating, response.total_ratings);
                }
            }
        });
    });
});

function loadBusinesses() {
    $.ajax({
        url: 'ajax/business_ajax.php?action=list',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                displayBusinesses(response.data);
            }
        }
    });
}

function displayBusinesses(businesses) {
    const tbody = $('#businessTableBody');
    
    if (businesses.length === 0) {
        tbody.html('<tr><td colspan="7" class="text-center">No businesses found</td></tr>');
        return;
    }
    
    let html = '';
    businesses.forEach(function(business, index) {
        const avgRating = parseFloat(business.avg_rating);
        const starsHtml = generateStars(avgRating);
        
        html += `
            <tr id="business-row-${business.id}" data-business-id="${business.id}" style="animation-delay: ${index * 0.1}s;">
                <td>${business.id}</td>
                <td><strong>${escapeHtml(business.name)}</strong></td>
                <td>${escapeHtml(business.address || 'N/A')}</td>
                <td>${escapeHtml(business.phone || 'N/A')}</td>
                <td>${escapeHtml(business.email || 'N/A')}</td>
                <td>
                    <div class="d-flex gap-2">
                        <button class="btn btn-warning btn-sm" onclick="editBusiness(${business.id})">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteBusiness(${business.id})">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </div>
                </td>
                <td>
                    <div class="rating-container" onclick="openRatingModal(${business.id}, '${escapeHtml(business.name).replace(/'/g, "\\'")}')">
                        <div class="stars-display" id="stars-${business.id}">${starsHtml}</div>
                        <small class="text-muted">(${business.total_ratings} reviews)</small>
                    </div>
                </td>
            </tr>
        `;
    });
    
    tbody.html(html);
}

function generateStars(rating) {
    const fullStars = Math.floor(rating);
    const hasHalf = (rating % 1) >= 0.5;
    const emptyStars = 5 - fullStars - (hasHalf ? 1 : 0);
    
    let html = '';
    for (let i = 0; i < fullStars; i++) {
        html += '<i class="fas fa-star text-warning"></i>';
    }
    if (hasHalf) {
        html += '<i class="fas fa-star-half-alt text-warning"></i>';
    }
    for (let i = 0; i < emptyStars; i++) {
        html += '<i class="far fa-star text-warning"></i>';
    }
    
    return html;
}

function editBusiness(id) {
    $.ajax({
        url: `ajax/business_ajax.php?action=get&id=${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                const b = response.data;
                $('#editBusinessId').val(b.id);
                $('#editBusinessName').val(b.name);
                $('#editBusinessAddress').val(b.address);
                $('#editBusinessPhone').val(b.phone);
                $('#editBusinessEmail').val(b.email);
                $('#editBusinessModal').modal('show');
            }
        }
    });
}

function deleteBusiness(id) {
    if (!confirm('Delete this business and all its ratings?')) return;
    
    $.ajax({
        url: 'ajax/business_ajax.php?action=delete',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            alert(response.message);
            if (response.status === 'success') {
                $(`#business-row-${id}`).fadeOut(300, function() {
                    $(this).remove();
                });
            }
        }
    });
}

function openRatingModal(businessId, businessName) {
    console.log('Opening rating modal:', businessId, businessName);
    
    $('#ratingBusinessId').val(businessId);
    $('#ratingBusinessName').text(businessName);
    $('#ratingForm')[0].reset();
    $('#ratingValue').val('');
    
    $('#ratingModal').modal('show');
    
    setTimeout(function() {
        initRatingStars();
    }, 300);
}

function initRatingStars() {
    console.log('Initializing rating stars...');
    const container = $('#ratingInput');
    container.empty();
    
    // Create 5 clickable stars
    for (let i = 1; i <= 5; i++) {
        const star = $('<i class="far fa-star rating-star"></i>');
        star.attr('data-value', i);
        container.append(star);
    }
    
    console.log('Stars created:', container.find('.rating-star').length);
    
    // Click handler
    $('.rating-star').off('click').on('click', function() {
        const value = $(this).data('value');
        $('#ratingValue').val(value);
        console.log('Rating selected:', value);
        
        $('.rating-star').each(function(index) {
            if (index < value) {
                $(this).removeClass('far').addClass('fas');
            } else {
                $(this).removeClass('fas').addClass('far');
            }
        });
    });
    
    // Hover effect
    $('.rating-star').off('mouseenter').on('mouseenter', function() {
        const value = $(this).data('value');
        $('.rating-star').each(function(index) {
            if (index < value) {
                $(this).addClass('hover-gold');
            }
        });
    });
    
    container.off('mouseleave').on('mouseleave', function() {
        $('.rating-star').removeClass('hover-gold');
    });
}

function updateBusinessRating(businessId, avgRating, totalRatings) {
    const starsHtml = generateStars(avgRating);
    $(`#stars-${businessId}`).html(starsHtml);
    $(`#business-row-${businessId} .text-muted`).text(`(${totalRatings} reviews)`);
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Form Validation Functions
function validateBusinessForm(formId) {
    clearValidationErrors(formId);
    let isValid = true;
    
    const form = $(formId);
    const name = form.find('input[name="name"]').val().trim();
    const email = form.find('input[name="email"]').val().trim();
    const phone = form.find('input[name="phone"]').val().trim();
    
    // Validate Business Name (required)
    if (!name) {
        showValidationError(form.find('input[name="name"]'), 'Business name is required');
        isValid = false;
    }
    
    // Validate Email (if provided, must be valid format)
    if (email && !isValidEmail(email)) {
        showValidationError(form.find('input[name="email"]'), 'Please enter a valid email address');
        isValid = false;
    }
    
    // Validate Phone (if provided, must be exactly 10 digits)
    if (phone && !isValidPhone(phone)) {
        showValidationError(form.find('input[name="phone"]'), 'Phone must be exactly 10 digits');
        isValid = false;
    }
    
    return isValid;
}

function validateRatingForm() {
    clearValidationErrors('#ratingForm');
    let isValid = true;
    
    const form = $('#ratingForm');
    const name = form.find('input[name="name"]').val().trim();
    const email = form.find('input[name="email"]').val().trim();
    const phone = form.find('input[name="phone"]').val().trim();
    const rating = $('#ratingValue').val();
    
    // Validate Name (required)
    if (!name) {
        showValidationError(form.find('input[name="name"]'), 'Your name is required');
        isValid = false;
    }
    
    // Validate Rating (required)
    if (!rating) {
        showValidationError($('#ratingInput'), 'Please select a rating by clicking the stars');
        isValid = false;
    }
    
    // Validate Email (if provided, must be valid format)
    if (email && !isValidEmail(email)) {
        showValidationError(form.find('input[name="email"]'), 'Please enter a valid email address');
        isValid = false;
    }
    
    // Validate Phone (if provided, must be exactly 10 digits)
    if (phone && !isValidPhone(phone)) {
        showValidationError(form.find('input[name="phone"]'), 'Phone must be exactly 10 digits');
        isValid = false;
    }
    
    // At least email or phone must be provided
    if (!email && !phone) {
        showValidationError(form.find('input[name="email"]'), 'Please provide either email or phone');
        showValidationError(form.find('input[name="phone"]'), 'Please provide either email or phone');
        isValid = false;
    }
    
    return isValid;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPhone(phone) {
    const phoneRegex = /^\d{10}$/;
    return phoneRegex.test(phone);
}

function showValidationError(element, message) {
    element.addClass('is-invalid');
    
    // Remove existing error message if any
    element.siblings('.invalid-feedback').remove();
    
    // Add error message
    const errorDiv = $('<div class="invalid-feedback d-block"></div>').text(message);
    element.after(errorDiv);
}

function clearValidationErrors(formId) {
    $(formId).find('.is-invalid').removeClass('is-invalid');
    $(formId).find('.invalid-feedback').remove();
}

// Real-time phone input validation (only allow digits)
$(document).on('input', 'input[name="phone"]', function() {
    let value = $(this).val();
    // Remove non-digit characters
    value = value.replace(/\D/g, '');
    // Limit to 10 digits
    if (value.length > 10) {
        value = value.substring(0, 10);
    }
    $(this).val(value);
});
