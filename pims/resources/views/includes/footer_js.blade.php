<script src="js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4TVE6RNN41"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-4TVE6RNN41');
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js" 
    integrity="sha512-3PRVLmoBYuBDbCEojg5qdmd9UhkPiyoczSFYjnLhFb2KAFsWWEMlAPt0olX1Nv7zGhDfhGEVkXsu51a55nlYmw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js" 
    integrity="sha512-ZwR1/gSZM3ai6vCdI+LVF1zSq/5HznD3ZSTk7kajkaj4D292NLuduDCO1c/NT8Id+jE58KYLKT7hXnbtryGmMg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    
    $(document).ready(function() {
        let bar = {
            type: 'bar',
            height: 40,
            barWidth: 4,
            barColor: '#fff',
            barSpacing: 3
        };

        let line = {
            type: 'line',
            width: 150,
            height: 36,
            lineColor: '#fff',
            fillColor: 'rgba(0,0,0,0)',
            lineWidth: 2,
            maxSpotColor: 'rgba(255,255,255,0.4)',
            minSpotColor: 'rgba(255,255,255,0.4)',
            spotColor: 'rgba(255,255,255,0.4)',
            spotRadius: 3,
            highlightSpotColor: '#fff',
            highlightLineColor: 'rgba(255,255,255,0.4)'
        };

        function data(length = 22) {
            return Array.from({length}, () => Math.floor(Math.random() * 40));
        }

        $('.inlinesparkline-bar').each(function() {
            $(this).sparkline(data(), bar);
        });

        $('.inlinesparkline-line').each(function() {
            $(this).sparkline(data(), line);
        });

        var ctx1 = document.getElementById('chart2').getContext('2d');
        window.myBar = new Chart(ctx1, {
            type: 'bar',
            data: {
                "labels": ["January", "February", "March", "April", "May", "June", "July"],
                "datasets": [{
                    "label": "Dataset 1",
                    "backgroundColor": "rgb(255, 99, 132)",
                    "stack": "Stack 0",
                    "data": data(8)
                }, {
                    "label": "Dataset 2",
                    "backgroundColor": "rgb(54, 162, 235)",
                    "stack": "Stack 0",
                    "data": data(8)
                }, {
                    "label": "Dataset 3",
                    "backgroundColor": "rgb(75, 192, 192)",
                    "stack": "Stack 1",
                    "data": data(8)
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true
                    }
                },
                legend: {
                    display: false
                },
            }
        });

        var ctx2 = document.getElementById('chart1').getContext('2d');
        window.myLine = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
                datasets: [{
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: data(8),
                    label: 'Dataset',
                    fill: 'start'
                }]
            },
            options: {
                title: {
                    display: false
                },
                legend: {
                    display: false
                },
            }
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" 
    integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="vendor/datatables/datatables.js"></script>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        var table = $('#datatable').DataTable({
            dom: "<'columns table-wrapper'<'column is-12'tr>><'columns table-footer-wrapper'<'column is-5'i><'column is-7'p>>",
            paging: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
        });

        // Search functionality
        $('#table-search').on('keyup', function () {
            let value = $(this).val().toLowerCase();
            table.search(value).draw();
        });

        // Change number of rows displayed
        $('#table-length').on('change', function () {
            let value = $(this).val();
            if (value) {
                table.page.len(value).draw();
            }
        });

        // Reload table
        $('#table-reload').on('click', function () {
            table.search('').draw();
        });
    });
</script>
<script>
    // Function to hide the flash messages after 3 seconds
    setTimeout(function() {
        var successAlert = document.getElementById('success-alert');
        var errorAlert = document.getElementById('error-alert');
        var warningAlert = document.getElementById('warning-alert');
        var infoAlert = document.getElementById('info-alert');

        if (successAlert) {
            successAlert.style.display = 'none';
        }
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
        if (warningAlert) {
            warningAlert.style.display = 'none';
        }
        if (infoAlert) {
            infoAlert.style.display = 'none';
        }
    }, 3000); // 3000ms = 3 seconds
</script>