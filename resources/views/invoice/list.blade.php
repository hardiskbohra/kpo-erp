@extends('layout/master')
@section('title', 'invoices-listing')
@section('page-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css" integrity="sha384-LJutInCHyNH9nSFKCkdMgYHbztN4AjzwyIh1hV6A0K6xHlA5lXr/4DrKWn/oNn4J" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="../../assets/vendor/libs/flatpickr/flatpickr.css" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
    <!-- END: Custom CSS-->

    <style>
.table tbody tr {
    transition: background-color 0.3s ease; /* Add a smooth color transition effect */
}

.table tbody tr:hover {
    background-color: #f0f8ff; /* Change the background color to a slightly different shade on hover */
}

.delete-button {
    background: none;

    border: none;
    padding: 0;
    cursor: pointer;
    outline: none;
    color: #1b86e4 /* Remove the default focus outline */
}

    </style>
@endsection

@section('content')
      <!-- BEGIN: Content-->
      <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="Invoice-list-wrapper">
                    <div class="Invoice-list-filter px-1">
                        <form id="invoiceSearchForm">
                            <div class="row border rounded py-2 mb-2">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="Invoice-list-verified">Customer Name</label>
                                    <fieldset class="form-group">
                                        <input type="text" id="filter_customer_name"
                                        name="name" value="{{request('name') }}"
                                        class="form-control"
                                        placeholder="Customer Name">
                                    </fieldset>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="Invoice-list-verified">Phone Number</label>
                                    <fieldset class="form-group">
                                        <input type="text" id="filter_ph_number"
                                        name="phone_number" value="{{request('phone_number') }}"
                                        class="form-control"
                                        placeholder="Phone Number">
                                    </fieldset>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="Invoice-list-status">Date</label>
                                    <fieldset class="form-group">
                                        <input type="text" id="date" name="date"   value="{{request('date') }}" class="form-control pickadate" placeholder="date" readonly="readonly">
                                    </fieldset>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="Invoice-list-status">Delivery Date</label>
                                    <fieldset class="form-group">
                                        <input type="text" id="delivery_date" name="delivery_date" value="{{request('delivery_date') }}" class="form-control pickadate" placeholder="delivery date" readonly="readonly">
                                    </fieldset>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="Invoice-list-role">Payment Status</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="Invoice-payment-status" name="payment_status" value="{{request('payment_status') }}">
                                                <option value="">All</option>
                                                <option value="paid">Paid</option>
                                                <option value="unpaid">Unpaid</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary btn-block glow Invoice-list-clear mb-0">Search</button>
                                    </div>

                                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                                        <a href="#" class="btn btn-success btn-block glow Invoice-list-clear mb-0" onclick="clearFilters()">Clear Filters</a>
                                    </div>

                            </div>


                        </form>
                    </div>
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <table id="users-list-datatable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Invoie no.</th>
                                                    <th>Customer</th>
                                                    <th>Phone No.</th>
                                                    <th>Date</th>
                                                    <th>Delivery</th>
                                                    <th>Total</th>
                                                    {{-- <th>Paid Ammount</th> --}}
                                                    <th>Remaining Ammount</th>
                                                    <th>Edit</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if($invoices->isEmpty())
                                                    <tr>
                                                        <td colspan="12" class="text-center">No records found</td>
                                                    </tr>
                                                @else
                                                    @foreach ($invoices as $invoice)
                                                    <tr>
                                                        <td><a href="./html/ltr/vertical-menu-template/page-users-view.html">{{$invoice->invoice_number}}</a>
                                                        </td>
                                                        <td>{{$invoice->customer->name}}</td>
                                                        <td>{{$invoice->customer->phone_number}}</td>
                                                        <td>{{ \Carbon\Carbon::parse($invoice->date)->format('d M')}}</td>
                                                        <td class="delivery-status" data-invoice-id="{{ $invoice->id }}" data-delivered="{{ $invoice->delivered_status }}" data-delievery_date="{{ \Carbon\Carbon::parse($invoice->delivery_date)->format('d M')}}">
                                                            @if ($invoice->delivered_status == 'yes')
                                                                <button class="badge badge-success badge-pill badge-round delivery-badge" style="border: none">Delivered</button>
                                                            @else
                                                                <button class="badge badge-light-green badge-pill badge-round delivery-badge" style="border: none"">{{ \Carbon\Carbon::parse($invoice->delivery_date)->format('d M')}}</i></button>
                                                            @endif
                                                        </td>

                                                        <td>{{$invoice->total}}</td>
                                                        {{-- <td>{{$invoice->paid_ammount}}</td> --}}
                                                        <td  style="{{ $invoice->remaining_ammount > 0 ? 'color: red;' : '' }}">{{$invoice->remaining_ammount}}</td>
                                                        @if ($invoice->remaining_ammount > 0)

                                                            <td>
                                                                <button class="badge badge-danger" style="border: none" data-toggle="modal" data-target="#inlineForm{{$invoice->id}}">mark as paid</i></button>

                                                                <div class="modal fade text-left" id="inlineForm{{$invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel33">Add Payment </h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <i class="bx bx-x"></i>
                                                                                </button>
                                                                            </div>
                                                                            <form action="#" id="addPaymentForm">
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="id" value="{{$invoice->id}}">



                                                                                    {{-- <label>Invoice No.: </label>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" value="{{$invoice->invoice_number}}" readonly>
                                                                                    </div>
                                                                                    <label>Customer: </label>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" value="{{$invoice->customer->name}}" readonly>
                                                                                    </div> --}}


                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <label>Invoice No.: </label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" class="form-control" value="{{$invoice->invoice_number}}" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <label>Customer: </label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" class="form-control" value="{{$invoice->customer->name}}" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-4">
                                                                                            <label>Total: </label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" class="form-control" value="{{$invoice->total}}" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label>Paid Amount: </label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" class="form-control" value="{{$invoice->paid_ammount}}" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label>Remaining Amount: </label>
                                                                                            <div class="form-group">
                                                                                                <input type="number" name="remaining_amount" placeholder="Remaining Amount" class="form-control" value="{{$invoice->remaining_ammount}}" min="0" max="{{$invoice->remaining_ammount}}" oninput="validity.valid||(value='');" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>




                                                                                    {{-- <label>TOtal: </label>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control" value="{{$invoice->total}}" readonly>
                                                                                    </div>
                                                                                    <label>Paid Amount: </label>
                                                                                    <div class="form-group">
                                                                                        <input type="text" class="form-control"  value="{{$invoice->paid_ammount}}" readonly>
                                                                                    </div> --}}
                                                                                    <label>New Payment: </label>
                                                                                    <div class="form-group">
                                                                                        <input type="text" name="remaining_amount" placeholder="remaining amount" class="form-control" value="{{$invoice->remaining_ammount}}">
                                                                                    </div>

                                                                                    {{-- <div class="form-group">
                                                                                        <input type="number" name="remaining_amount" placeholder="Remaining Amount" class="form-control" value="{{$invoice->remaining_ammount}}" min="0" max="{{$invoice->remaining_ammount}}" oninput="validity.valid||(value='');">
                                                                                    </div> --}}


<!--                                                                                     <label>Payment Mode: </label>
                                                                                    <div class="form-group">
                                                                                        <select class="form-control" id="Invoice-payment-mode" name="payment_mode">
                                                                                            <option value="cash">Cash</option>
                                                                                            <option value="card">Card</option>
                                                                                            <option value="upi">UPI</option>
                                                                                        </select>
                                                                                    </div> -->

                                                                                    <div class="row">
                                                                                        <div class="col-md-9">
                                                                                            <label>Payment Mode: </label>
                                                                                            <div class="form-group">
                                                                                                <select class="form-control" id="Invoice-payment-mode" name="payment_mode">
                                                                                                    <option value="cash">Cash</option>
                                                                                                    <option value="card">Card</option>
                                                                                                    <option value="upi">UPI</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <label>Adjust Difference </label>

                                                                                            <div>
                                                                                                <input type="checkbox" name="full_payment" style="padding-left: 10%; height:22px;width:23px">
                                                                                                <label for="checkboxGlow1"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                                        <span class="d-none d-sm-block">Close</span>
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-primary ml-1" data-dismiss="modal" id="addPaymentBtn">
                                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                                        <span class="d-none d-sm-block">Update</span>
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                        @else
                                                        <td >
                                                            <button class="badge badge-success" style="border: none; cursor:text" desabled>paid</i></button>
                                                        </td>
                                                        @endif
                                                        <td style="display: flex; align-items: center;">
                                                            <a href="{{ route('invoice.print',['id' => $invoice->id]) }}" target="_blank"><i class="bx bx-printer" style="font-size: 1.9rem"></i></a>
                                                            <a href="{{ route('invoices.show',[$invoice->id]) }}" target="_blank"><i class="bx bx-edit" style="font-size: 1.9rem"></i></a>
                                                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="post"
                                                                onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                                                              @csrf
                                                              @method('DELETE')

                                                              <button type="submit" class="delete-button">
                                                                  <i class="bx bx-trash" style="font-size: 1.9rem; vertical-align: middle;"></i>
                                                              </button>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                        <div class=" d-flex justify-content-end">
                            {{ $invoices->appends(request()->query())->links() }}
                        </div>
                    </div>
                </section>
                <!-- users list ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('jqcdn')

    <script src="../../assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>

    <script src="/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
    <script src="/app-assets/js/scripts/pages/app-invoice.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    </script>

    <script>
        function clearFilters() {
            // Reset form values
            $('#filter_customer_name').val('');
            $('#filter_ph_number').val('');
            $('#date').val('');
            $('#delivery_date').val('');
            $('#Invoice-payment-status').val('');
        }
    </script>
@endsection
