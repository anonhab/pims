<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backup/Recovery Logs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional Custom Styles -->
    <style>
        body {
            padding: 20px;
        }
        .modal .modal-content {
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Menu -->
            <div class="col-md-3">
                @include('cadmin.menu')
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <h1 class="my-4">Backup/Recovery Logs</h1>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Initiated By</th>
                            <th>Backup Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($backups as $backup)
                            <tr>
                                <td>{{ $backup->id }}</td>
                                <td>{{ $backup->initiated_by ?? 'Unknown' }}</td>
                                <td>{{ \Carbon\Carbon::parse($backup->backup_date)->format('M d, Y H:i') }}</td>
                                <td>{{ ucfirst($backup->backup_status) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="showDetails({{ $backup->id }})">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No backup logs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Details -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Backup Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="detailsContent">
                    <!-- Populated by JS -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery + Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS for Showing Modal Details -->
    <script>
        function showDetails(id) {
            const backups = @json($backups);
            const backup = backups.find(b => b.id === id);

            if (backup) {
                const details = `
                    <p><strong>ID:</strong> ${backup.id}</p>
                    <p><strong>Initiated By:</strong> ${backup.initiated_by || 'Unknown'}</p>
                    <p><strong>Backup Date:</strong> ${new Date(backup.backup_date).toLocaleString()}</p>
                    <p><strong>Status:</strong> ${backup.backup_status.charAt(0).toUpperCase() + backup.backup_status.slice(1)}</p>
                `;
                document.getElementById('detailsContent').innerHTML = details;
                $('#detailsModal').modal('show');
            }
        }
    </script>
</body>
</html>
