<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register Supplier</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>

<body class="antialiased">
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Abans Suppliers</a>
            <ul class="navbar-nav">
                <!-- <li class="nav-item"><a class="nav-link" href="#">Home</a></li> -->
                <!-- <li class="nav-item"><a class="nav-link" href="#">Page 1</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Page 2</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Page 3</a></li> -->
            </ul>
            <a href="/login">Login</a>

        </div>
    </nav>
    <div class="row justify-content-center mt-5">
  
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h1>Supplier Register Form</h1>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ Session::get('success'); }}
                    </div>
                    @endif

                    @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ Session::get('error'); }}
                    </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Joe Dome" />
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="abc@gmail.com" />
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contact_no" class="label">Contact No</label>
                            <input type="number" class="form-control" name="contact_no" placeholder="0702079678" max="9999999999"/>
                            @error('contact_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="website_url" class="label">Website url</label>
                            <input type="text" class="form-control" name="website_url" placeholder="www.abc.com" />
                            @error('website_url')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="label">Status</label>
                            <select class="form-control" name="status">
                                    <option value="1">Enable</option>
                                    <option value="0">Disabled</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="******" required />
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit"> Register Supplier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

</html>