@include('layouts.navbar')
@section('container')
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


    <!-- trix editor -->
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>

    <title>Review Rating</title>

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

        trix-editor {
            --trix-content-background-color: white;
        }

        .page-title {
            font-size: 3em;
            font-family: "Times New Roman", Times, serif;
        }

        .title-2 {
            font-size: 2em;
            font-family: "Times New Roman", Times, serif;
        }

        .rating-container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            /* Align items at the start of the container */
            font-size: 1.5em;
        }

        .rating-container:hover {
            color: #87a1b1;
        }

        .rating-button {
            background: none;
            border: none;

            color: white;
            padding: 0;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        .rating-button:hover {
            color: #0c1562;
            /* Change to your desired hover color */
        }

        .rating-button .emoji {
            font-size: 3em;
        }

        .rating-button .description {
            margin-top: 5px;
        }

        /* Add hover effect for buttons */
        .rating-button:hover {
            background-color: #3498db;
        }


        .login-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 10px;
            background-color: white;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1em;
            color: #3498db;
        }

        .active {
            background-color: #171039;
            /* Change to your desired highlight color */
        }

        .active:hover {
            background-color: #15055d;
            color: white;
            /* Change to your desired highlight color */
        }
    </style>

    <script>
        function setActive(button) {
            console.log('setActive');
        // Remove active class from all buttons
        var buttons = document.querySelectorAll('.rating-button');
        buttons.forEach(function(btn) {
            btn.classList.remove('active');
        });

        // Add active class to the clicked button
        button.classList.add('active');
    }
    
    </script>
</head>


<body>

    @php
    if (!auth()->user())
    {
    return redirect(route('login'));
    }
    @endphp

    <h1 class="page-title"> Terima Kasih Atas Kunjungan Anda </h1>
    <h2 class="title-2">Kami Mohon Penilaian Anda</h2>
    <h2>---------------------------------------------------------------------------</h2>
    <br>
    <br>

    <form id="ratingForm" method="post" action="/post-rating" class="mb-5" enctype="multipart/form-data">
        {{-- <form method="post" class="mb-5" enctype="multipart/form-data"> --}}
            @csrf
            <input type="hidden" id="employee_name" name="employee_name">
            <input type="hidden" id="nip" name="nip">
            <input type="hidden" id="sangat_puas" name="sangat_puas">
            <input type="hidden" id="puas" name="puas">
            <input type="hidden" id="sedang" name="sedang">
            <input type="hidden" id="tidak_puas" name="tidak_puas">
            <input type="hidden" id="sangat_tidak_puas" name="sangat_tidak_puas">
            <input type="hidden" id="_timestamp" name="_timestamp">

            <div class="rating-container">
                <button class="rating-button" onclick="sangatTidakPuas(event); setActive(this)">
                    <div class="emoji-container">
                        <div class="emoji">😢</div>
                        <div class="description">Sangat Tidak Puas</div>
                    </div>
                </button>

                <button class="rating-button" onclick="TidakPuas(event); setActive(this)">
                    <div class="emoji-container">
                        <div class="emoji">🥲</div>
                        <div class="description">Tidak Puas</div>
                    </div>
                </button>

                <button class="rating-button" onclick="Sedang(event); setActive(this)">
                    <div class="emoji-container">
                        <div class="emoji">😐</div>
                        <div class="description">Sedang</div>
                    </div>
                </button>

                <button class="rating-button" onclick="Puas(event); setActive(this)">
                    <div class="emoji-container">
                        <div class="emoji">🙂</div>
                        <div class="description">Puas</div>
                    </div>
                </button>

                <button class="rating-button" onclick="sangatPuas(event); setActive(this)">
                    <div class="emoji-container">
                        <div class="emoji">😁</div>
                        <div class="description">Sangat Puas</div>
                    </div>
                </button>
            </div>


            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="d-flex flex-column">
                        <label for="nama" class="form-label align-items-start">Nama (optional)</label>
                        <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror"
                            id="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="d-flex flex-column">
                        <label for="email" class="form-label">Email (optional)</label>
                        <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>



            <div class="px-4 my-5">
                <h3 class="fw-bold">Berikan Komentar Anda</h3>
            </div>

            <div class="px-4 my-5">
                {{-- @error('body')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="komen" type="hidden" name="komen" value="{{old('body')}}">
                <trix-editor input="body"></trix-editor> --}}

                <div class="form-group">
                    <textarea class="form-control" input id="komen" type="hidden" name="komen" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                {{-- <button type="button" onclick="submitForm()"
                    class="btn btn-primary align-items-start">Submit</button> --}}

        </form>
        <script>
            function submitForm() {        
        // Submit the form
        document.getElementById('ratingForm').submit();
        
    }

            function sangatTidakPuas(e) {

                e.preventDefault();
        // prevent default biar gak redirect saat klik emoji
        var user = {
            name: "{{auth()->user()->name}}",
            nip: "{{auth()->user()->nip}}",
            // Add other user-related properties as needed
        };
        
        var timestamp = Date.now();  // Timestamp in milliseconds
        // Set values of hidden input fields
        document.getElementById('employee_name').value = user.name;
        document.getElementById('nip').value = user.nip;
        document.getElementById('sangat_puas').value = 0;
        document.getElementById('puas').value = 0;
        document.getElementById('sedang').value = 0;
        document.getElementById('tidak_puas').value = 0;
        document.getElementById('sangat_tidak_puas').value = 1;
        document.getElementById('_timestamp').value = _timestamp;
        
        // Submit the form
        // document.getElementById('ratingForm').submit();
    }


function TidakPuas(e) {
    e.preventDefault();
        // Retrieve user data (replace this with your actual method of retrieving user data)
        var user = {
            name: "{{auth()->user()->name}}",
            nip: "{{auth()->user()->nip}}",
            // Add other user-related properties as needed
        };
        
        var timestamp = Date.now();  // Timestamp in milliseconds

        // Set values of hidden input fields
        document.getElementById('employee_name').value = user.name;
        document.getElementById('nip').value = user.nip;
        document.getElementById('sangat_puas').value = 0;
        document.getElementById('puas').value = 0;
        document.getElementById('sedang').value = 0;
        document.getElementById('tidak_puas').value = 1;
        document.getElementById('sangat_tidak_puas').value = 0;
        document.getElementById('_timestamp').value = _timestamp;
        
        // Submit the form
        // document.getElementById('ratingForm').submit();
}

function Sedang(e) {
    e.preventDefault();
        // Retrieve user data (replace this with your actual method of retrieving user data)
        var user = {
            name: "{{auth()->user()->name}}",
            nip: "{{auth()->user()->nip}}",
            // Add other user-related properties as needed
        };
        
        var timestamp = Date.now();  // Timestamp in milliseconds

        // Set values of hidden input fields
        document.getElementById('employee_name').value = user.name;
        document.getElementById('nip').value = user.nip;
        document.getElementById('sangat_puas').value = 0;
        document.getElementById('puas').value = 0;
        document.getElementById('sedang').value = 1;
        document.getElementById('tidak_puas').value = 0;
        document.getElementById('sangat_tidak_puas').value = 0;
        document.getElementById('_timestamp').value = _timestamp;
        
        // Submit the form
        // document.getElementById('ratingForm').submit();
}
function Puas(e) {
    e.preventDefault();
        // Retrieve user data (replace this with your actual method of retrieving user data)
        var user = {
            name: "{{auth()->user()->name}}",
            nip: "{{auth()->user()->nip}}",
            // Add other user-related properties as needed
        };
        
        var timestamp = Date.now();  // Timestamp in milliseconds

        // Set values of hidden input fields
        document.getElementById('employee_name').value = user.name;
        document.getElementById('nip').value = user.nip;
        document.getElementById('sangat_puas').value = 0;
        document.getElementById('puas').value = 1;
        document.getElementById('sedang').value = 0;
        document.getElementById('tidak_puas').value = 0;
        document.getElementById('sangat_tidak_puas').value = 0;
        document.getElementById('_timestamp').value = _timestamp;
        
        // Submit the form
        // document.getElementById('ratingForm').submit();
}
function sangatPuas(e) {
    e.preventDefault();
        // Retrieve user data (replace this with your actual method of retrieving user data)
        var user = {
            name: "{{auth()->user()->name}}",
            nip: "{{auth()->user()->nip}}",
            // Add other user-related properties as needed
        };
        
        var timestamp = Date.now();  // Timestamp in milliseconds

        // Set values of hidden input fields
        document.getElementById('employee_name').value = user.name;
        document.getElementById('nip').value = user.nip;
        document.getElementById('sangat_puas').value = 1;
        document.getElementById('puas').value = 0;
        document.getElementById('sedang').value = 0;
        document.getElementById('tidak_puas').value = 0;
        document.getElementById('sangat_tidak_puas').value = 0;
        document.getElementById('_timestamp').value = _timestamp;
        
        // Submit the form
        // document.getElementById('ratingForm').submit();
}


document.addEventListener('trix-file-accept',function(e){
        e.preventDefault();
    })
        </script>

</body>

</html>