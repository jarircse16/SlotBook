@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home Page</title>
    <style>
        #toast-default {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="main-box flex items-center justify-center custom-height">
    <center><img  src="{{ asset('assets/img/card.webp') }}" height="300px" width="450px" alt="Sunset in the mountains">
    <h1>Welcome to SlotBook!</h1>
    <p style="font-weight: bold;">Slot available on <span id="slot_date"></span></p>
    <p style="font-weight: bold;">Last updated on <span id="updated_at"></span></p>



    <script>
      const fetchData = () => {
          // Note: Storing sensitive tokens like this in client-side code is not recommended for production environments.
          const internalToken = 'fDdxa5ngz1y9KvKFtC302Sm9emWH2IlO';  // This should be securely managed

          const headers = new Headers();
          headers.append('X-API-Key', 'your_super_secret_api_key'); // API Key
          headers.append('X-Internal-Token', internalToken); // Internal Token

          fetch("/api/slot-update", { headers: headers })
              .then(response => response.json())
              .then(data => {
                  console.log(data);
                  const slot_date_field = document.getElementById("slot_date");
                  const updated_at_field = document.getElementById("updated_at");

                  // Update the UI
                  slot_date_field.innerText = data.slot_date || 'No data';
                  updated_at_field.innerText = data.updated_at || 'No data';

                  // Update local storage with new data
                  localStorage.setItem('slot_date', data.slot_date);
                  localStorage.setItem('updated_at', data.updated_at);
              })
              .catch(error => {
                  console.error('Error fetching data: ', error);
                  // Use cached data if available when fetch fails
                  const slot_date_field = document.getElementById("slot_date");
                  const updated_at_field = document.getElementById("updated_at");
                  slot_date_field.innerText = localStorage.getItem('slot_date') || 'Data unavailable';
                  updated_at_field.innerText = localStorage.getItem('updated_at') || 'Data unavailable';
              });
      };

      // Call fetchData on load and then set it to repeat every 20 seconds
      fetchData();
      setInterval(fetchData, 20000);

      if (!localStorage.getItem('show_data_notice')) {
          document.getElementById('toast-default').style.display = 'block';
          localStorage.setItem('show_data_notice', true);
      }
  </script>

    <div class="flex px-6 pt-4 pb-2 justify-between">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
        <a href="/set_alert">Set Alert</a>
    </button>
    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">
        <a href="/delete_alert">Delete Alert</a>
    </button>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
        <a href="/">Home</a>
    </button>
</div>
</div>
</body>
</html>

