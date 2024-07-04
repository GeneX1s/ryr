<!DOCTYPE html>
<html lang="en">

<head>

  <style>
    body {
      background-color: #3498db;
      /* Blue background color */
      color: white;
      /* White text color for better visibility */
      text-align: center;
      padding: 50px;
      margin: 0;
    }

    .page-title {
      font-size: 3em;
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank You</title>
</head>

<body>
  <h1>Terima Kasih Atas Penilaian Anda! :)</h1>
  <p>Anda akan kembali ke halaman utama dalam <span id="countdown">2</span> detik.</p>

  <script>
    // Define the countdown function
        function countdown() {
            var seconds = 2; // Change this to adjust the countdown duration

            // Update the countdown every second
            var countdownInterval = setInterval(function() {
                seconds--;

                // Update the countdown element
                document.getElementById('countdown').textContent = seconds;

                // If the countdown reaches 0, redirect to the main page
                if (seconds <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = "{{ route('review') }}"; // Redirect to main page route
                }
            }, 1000); // Update every 1 second (1000 milliseconds)
        }

        // Call the countdown function when the page loads
        window.onload = function() {
            countdown();
        };
  </script>
</body>

</html>