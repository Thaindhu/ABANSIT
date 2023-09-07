<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <li class="nav-item"><a class="nav-link" href="/view_products">View My products</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger mt-2 mt-lg-0">Logout</button>
                    </form>
                </li>
            </ul>



        </div>
    </nav>
    <div class="container">
        <div class="">
            <h1>Welcome {{ Auth::user()->name }}</h1>


            <div class="row justify-content-center mt-5">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h1>Products Form</h1>
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

                            <form action="{{ route('product') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="hidden" value="{{ $productId }}" name="productId" />
                                    <label for="photo" class="label">Product Image</label>
                                    <input type="file" class="form-control" name="photo" />
                                    @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="product_name" class="label">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" placeholder="Joe Dome"
                                        value="{{ $productsDetails->product_name }}" />
                                    @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="product_code" class="label">Product code</label>
                                    <input type="text" class="form-control" name="product_code"
                                        value="{{ $productsDetails->product_code }}" placeholder="AB001" />
                                    @error('product_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="mb-3">
                                    <label for="description" class="label">description</label>
                                    <textarea class="form-control" name="description" placeholder="description"
                                        value="{{ $productsDetails->description }}"></textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="unit_price" class="label">unit Price</label>
                                    <input class="form-control" name="unit_price"
                                        value="{{ $productsDetails->unit_price }}" placeholder="0.00"></input>
                                    @error('unit_price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="label">Quantity</label>
                                    <input type="number" class="form-control" name="quantity"
                                        value="{{ $productsDetails->quantity }}" placeholder="10" />
                                    @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="label">Status</label>
                                    <select class="form-control" name="status">
                                        $productsDetails->status
                                        <option value="1" {{ $productsDetails->status == 1 ? 'selected' : '' }}>Enable
                                        </option>
                                        <option value="0" {{ $productsDetails->status == 0 ? 'selected' : '' }}>Disabled
                                        </option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="d-grid">
                                        <button class="btn btn-primary" type="submit"> Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
    integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>