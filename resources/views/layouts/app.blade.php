<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        
        .navbar {
            background: linear-gradient(45deg, #007bff, #6f42c1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: rgb(2, 1, 1) !important; 
        }

        
        .navbar-nav .nav-link {
            color: black !important; 
            font-weight: 500;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #003366 !important;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

   
        .footer {
            background: linear-gradient(45deg, #6f42c1, #007bff);
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            font-weight: 500;
        }

       
        .btn-primary {
            background: #ff5733;
            border: none;
        }

        .btn-primary:hover {
            background: #0709a9;
        }

    </style>
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('colleges.index') }}">🎓 College & Department CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('colleges.index') }}">🏫 Colleges</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('departments.index') }}">📚 Departments</a></li>
                </ul>
            </div>
        </div>
    </nav>

 
    <div class="container mt-4">
        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>