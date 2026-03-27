<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Listing & Rating System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0"><i class="fa fa-building me-2"></i>Business Directory</h2>
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#addBusinessModal">
                        <i class="fa fa-plus-circle me-2"></i>Add Business
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">ID</th>
                                    <th style="width: 18%;">Business Name</th>
                                    <th style="width: 22%;">Address</th>
                                    <th style="width: 12%;">Phone</th>
                                    <th style="width: 15%;">Email</th>
                                    <th style="width: 13%;">Actions</th>
                                    <th style="width: 15%;">Average Rating</th>
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
    </div>

    <?php include 'views/modals.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
