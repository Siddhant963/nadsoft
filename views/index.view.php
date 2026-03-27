<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Listing & Rating System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/raty/jquery.raty.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Business Listing & Rating System</h3>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addBusinessModal">
                    <i class="fa fa-plus"></i> Add Business
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Business Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Actions</th>
                                <th>Average Rating</th>
                            </tr>
                        </thead>
                        <tbody id="businessTableBody">
                            <tr><td colspan="7" class="text-center">Loading...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addBusinessModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Business</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addBusinessForm">
                        <div class="mb-3">
                            <label class="form-label">Business Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveBusinessBtn">Save Business</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBusinessModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Business</h5>
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
                            <input type="text" class="form-control" name="phone" id="editBusinessPhone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="editBusinessEmail">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" id="updateBusinessBtn">Update Business</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ratingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rate: <span id="ratingBusinessName"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="ratingForm">
                        <input type="hidden" name="business_id" id="ratingBusinessId">
                        <div class="mb-3">
                            <label class="form-label">Your Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rating * (Click stars)</label>
                            <div id="ratingStars"></div>
                            <input type="hidden" name="rating" id="ratingValue">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="submitRatingBtn">Submit Rating</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/raty/jquery.raty.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
