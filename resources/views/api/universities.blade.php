@extends('students.layout')
@section('content')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<div class="container mt-5">
    <div class="glass-container w-100 p-5 text-center mb-4">
        <h2 class="mb-3 fw-bold" style="color: var(--primary-color);">Universities Directory</h2>
        <p class="text-muted mb-4">Click the button below to dynamically fetch and display university data from the public API.</p>
        <!-- Button to trigger fetching and displaying the table -->
        <button id="fetchTableButton" class="btn btn-modern px-5 py-2">Load Universities via API</button>
    </div>

    <!-- Div to contain the table initially hidden -->
    <div id="tableContainer" class="glass-container w-100 p-4" style="display: none;">
        <table id="universities-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>University Name</th>
                    <th>Country</th>
                    <th>Code</th>
                    <th>Domain</th>
                    <th>Web Page</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table body content will be populated dynamically -->
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#fetchTableButton').on('click', function() {
            var $btn = $(this);
            // Visual feedback
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...');

            // Fetch data via AJAX using the backend route to avoid CORS issues
            $.ajax({
                url: '/fetch-universities',
                method: 'GET',
                success: function(data) {
                    $btn.prop('disabled', false).text('Load Universities via API');
                    
                    // Check if data is an array and not empty
                    if (Array.isArray(data) && data.length > 0) {
                        // Populate table body with fetched data
                        populateTable(data);
                        // Show the table
                        $('#tableContainer').show();
                        
                        // Destroy existing DataTable instance if it exists to avoid reinitialization errors
                        if ($.fn.DataTable.isDataTable('#universities-table')) {
                            $('#universities-table').DataTable().destroy();
                        }
                        
                        // Initialize DataTables
                        $('#universities-table').DataTable();
                    } else {
                        alert('Error: No data returned from the API.');
                    }
                },
                error: function(xhr, status, error) {
                    $btn.prop('disabled', false).text('Load Universities via API');
                    alert('Error fetching data. Please check your internet connection or try again.');
                    console.error('Error fetching data:', error);
                }
            });
        });
        
        // Function to populate table body with data
        function populateTable(data) {
            var tableBody = $('#universities-table tbody');
            tableBody.empty(); // Clear existing table rows
            
            // Iterate over the data and append rows to the table
            $.each(data, function(index, row) {
                var newRow = $('<tr>').append(
                    $('<td>').text(row.name),
                    $('<td>').text(row.country),
                    $('<td>').text(row.alpha_two_code),
                    $('<td>').text(row.domains ? row.domains[0] : ''),
                    $('<td>').html('<a href="' + (row.web_pages ? row.web_pages[0] : '') + '" target="_blank">' + (row.web_pages ? row.web_pages[0] : '') + '</a>')
                );
                tableBody.append(newRow);
            });
        }
    });
</script>
@endsection

