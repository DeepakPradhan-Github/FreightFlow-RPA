function viewDetails(jobId) {
    $.ajax({
        url: "alert.php", // Replace with your PHP script URL
        type: "POST",
        data: { job_id: jobId },
        success: function (response) {
             //alert(response); // Display the fetched data in an alert box
            //$('#job-details').html(response);
            var jobDetails = JSON.parse(response);
            if (jobDetails.length > 0) {
                // Initialize the table string
                var tableStr = "<table border='1' style='width:100%; text-align: left;'><thead><tr><th>Job Id</th><th>Date</th><th>Source</th><th>Destination</th><th>Container</th><th>Commodity</th><th>Departure Time</th><th>Arrival Time</th><th>Get in Deadline</th><th>Quotation Price</th><th>Estimation Arrival</th><th>Estimation Destination</th><th>Shipping Company</th></tr></thead><tbody>";

                        // Loop through each job and add it to the table string
                        jobDetails.forEach(function(job) {
                            tableStr += "<tr><td>" + job.job_id + "</td><td>" + job.date + "</td><td>"  + job.source + "</td><td>" + job.destination + "</td><td>" + job.container + "</td><td>" + job.commodity + "</td><td>"+ job.departure_time + "</td><td>"+ job.arrival_time + "</td><td>"+ job.get_in_deadline + "</td><td>"+ job.quotation_price + "</td><td>"+ job.estimation_arrival + "</td><td>"+ job.estimation_destination + "</td><td>" + job.shipping_company + "</td></tr>";
                        });

                        tableStr += "</tbody></table>";

                        // Display the table string in a SweetAlert2 modal
                        Swal.fire({
                            title: 'Transaction History',
                            html: tableStr,
                            width: 'auto',
                            confirmButtonText: 'Close'
                        });
                    } else {
                        Swal.fire('No transaction history found.');
                    }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ' + status + error);
        }
    });
}