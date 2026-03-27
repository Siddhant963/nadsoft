<!-- Add Business Modal -->
<div class="modal fade" id="addBusinessModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus-circle me-2"></i>Add New Business</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addBusinessForm">
                    <div class="mb-3">
                        <label class="form-label">Business Name *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter business name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="2" placeholder="Enter address"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter 10-digit phone number" maxlength="10">
                        <small class="text-muted">Enter exactly 10 digits</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="example@domain.com">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBusinessBtn">
                    <i class="fa fa-save me-2"></i>Save Business
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Business Modal -->
<div class="modal fade" id="editBusinessModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-edit me-2"></i>Edit Business</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editBusinessForm">
                    <input type="hidden" name="id" id="editBusinessId">
                    <div class="mb-3">
                        <label class="form-label">Business Name *</label>
                        <input type="text" class="form-control" name="name" id="editBusinessName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="editBusinessAddress" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="editBusinessPhone" placeholder="Enter 10-digit phone number" maxlength="10">
                        <small class="text-muted">Enter exactly 10 digits</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="editBusinessEmail" placeholder="example@domain.com">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" id="updateBusinessBtn">
                    <i class="fa fa-check me-2"></i>Update Business
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Rating Modal -->
<div class="modal fade" id="ratingModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-star me-2"></i>Rate: <span id="ratingBusinessName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="ratingForm">
                    <input type="hidden" name="business_id" id="ratingBusinessId">
                    <input type="hidden" name="rating" id="ratingValue">
                    
                    <div class="mb-3">
                        <label class="form-label">Your Name *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" placeholder="example@domain.com">
                        <small class="text-muted">Email or phone is required</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone *</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter 10-digit phone number" maxlength="10">
                        <small class="text-muted">Enter exactly 10 digits (Email or phone is required)</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-center d-block">Rating * (Click stars to rate)</label>
                        <div id="ratingInput"></div>
                        <small class="text-muted d-block text-center mt-2">Select from 1 to 5 stars</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="submitRatingBtn">
                    <i class="fa fa-paper-plane me-2"></i>Submit Rating
                </button>
            </div>
        </div>
    </div>
</div>
