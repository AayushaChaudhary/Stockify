@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stockify</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Customers</p>
                                    <h4 class="mb-2">{{ $counts['customers'] }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-shopping-cart-2-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Suppliers</p>
                                    <h4 class="mb-2">
                                        {{ $counts['suppliers'] }}
                                    </h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Products</p>
                                    <h4 class="mb-2">
                                        {{ $counts['products'] }}
                                    </h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-user-3-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Categories</p>
                                    <h4 class="mb-2">
                                        {{ $counts['categories'] }}
                                    </h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-btc font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row row-cols-md-2">
                <div class="card-group col-xl-6 mb-4">
                    <div class="card">
                        <div class="card-header text-center bg-primary text-white">
                            Monthly Profit Report
                        </div>
                        <div class="card-body">
                            {!! $profitChart->container() !!}
                        </div>
                    </div>
                </div>
                <div class="card-group col-xl-12 gap-4">
                    <div class="card">
                        <div class="card-header text-center bg-primary text-white">
                            Purchase Report
                        </div>
                        <div class="card-body">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-center bg-primary text-white">
                            Stock Report
                        </div>
                        <div class="card-body">
                            {!! $stockChart->container() !!}
                        </div>
                    </div>
                </div>

            </div>

            <!-- end row -->


            <div class="row">
                <div class="col-xl-12 pt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>

                            </div>

                            <h4 class="card-title text-bold mb-4">Latest Purchase</h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Supplier</th>
                                            <th>Product</th>
                                            <th>quantity</th>
                                            <th>Price Per Unit</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0">{{ $transaction->supplier->name }}</h6>
                                                </td>
                                                <td>{{ $transaction->product->name }}</td>
                                                <td>
                                                    {{ $transaction->buying_qty }}
                                                </td>
                                                <td>
                                                    {{ $transaction->unit_price }}
                                                </td>
                                                <td>
                                                    {{ $transaction->buying_price }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody><!-- end tbody -->
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 pt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>

                            </div>

                            <h4 class="card-title text-bold mb-4">Latest Sales</h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Customer</th>
                                            <th>Product</th>
                                            <th>Quantity </th>
                                            <th>Price per unit</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($sales as $key => $item)
                                            <tr>
                                                <td> {{ $item['payment']['customer']['name'] }} </td>
                                                <td> #{{ $item['invoice_details'][0]['product']['name'] }} </td>
                                                <td> #{{ $item['invoice_details'][0]['selling_qty'] }} </td>
                                                <td> {{ $item['invoice_details'][0]['unit_price'] }} </td>
                                                <td> $ {{ $item['payment']['total_amount'] }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody><!-- end tbody -->
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
            </div>

        </div>
    @endsection

    @section('js')
        <script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}
        <script src="{{ $stockChart->cdn() }}"></script>
        {{ $stockChart->script() }}
        <script src="{{ $profitChart->cdn() }}"></script>
        {{ $profitChart->script() }}
    @endsection
