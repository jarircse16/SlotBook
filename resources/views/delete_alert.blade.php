<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Alert</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        h1 {
            color: blue;
            font-family: Arial;
        }

        p {
            color: green;
            font-size: 20px;
        }

        .dialog {
            display: block; /* Hide by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
          }

          .dialog-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: solid black;
          }

          .button {
             cursor:pointer;
          }


        .main-box {
          position: relative;
        }

        #toast-default {
          position: absolute;
          top: 1em;
          left: 0;
          right: 0;
          margin: auto;
          z-index: 999;
          display: none;
        }

        .custom-height {
          height: 100vh;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- Google tag and other scripts omitted for brevity -->
    <style>
        h1 {
            color: blue;
            font-family: Arial;
        }
        p {
            color: green;
            font-size: 20px;
        }
        .dialog {
            display: block; /* Hide by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .dialog-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: solid black;
        }
        .button {
            cursor:pointer;
        }
        .main-box {
            position: relative;
        }
        #toast-default {
            position: absolute;
            top: 1em;
            left: 0;
            right: 0;
            margin: auto;
            z-index: 999;
            display: none;
        }
        .custom-height {
            height: 100vh;
        }
        <!-- Add this to the head of your Blade template -->
    #toast {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }

    #toast.show {
        visibility: visible;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }
    </style>
</head>
<body>
    <div class="flex items-center justify-center h-screen">
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <form action="{{ route('delete_alert') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-8 pb-12 mb-4">
                @csrf <!-- CSRF token -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email" required>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete Alert</button>
                    <a href="/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Home</a>
                </div>
            </form>
            <div class="col-lg-4">
                <p class="text-center">
                  Developed by <span><a href="https://www.facebook.com/jarir.in.ruet.cse/">3C Studio</a></span>
                </p>
              </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    // Document ready function to ensure the script runs after the page has loaded
    $(document).ready(function() {
        // Check if there are any success messages in the session
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        // Check for error messages in the session
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        // Optional: configure toastr options
        toastr.options = {
            "closeButton": true, // Show close button
            "progressBar": true, // Shows a progress bar
            "positionClass": "toast-top-right", // Position of toast notification
            "timeOut": "5000" // How long the toast will display without user interaction
        };
    });
</script>
<div id="toast">Some text...</div>
</body>
</html>
