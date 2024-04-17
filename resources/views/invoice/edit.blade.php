@extends('layout/master')
@section('title', 'invoice-create')
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
        html body p {
    line-height: 0.5rem;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: normal !important;
    background-color: #FFFFFF;
    background-clip: border-box;
    border: 0px solid #dfe3e7;
    border-radius: 0.267rem;
}


    </style
@endsection
@section('content')


    <!-- BEGIN: Content-->
    <form action="{{ route('invoices.update',[$invoice->id]) }}" id="invoiceForm" method="POST" onsubmit="return validateForm(event)" onkeydown="return handleEnterKey(event)">
        @csrf
        @method('PUT')
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <!-- app invoice View Page -->
                    <section class="invoice-edit-wrapper">
                        <div class="row">
                            <!-- invoice view page -->
                            <div class="col-xl-9 col-md-8 col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body pb-0 mx-25">
                                            <!-- header section -->
                                            {{-- <div class="row mx-0">
                                                <div class="col-xl-4 col-md-12 d-flex align-items-center pl-0">
                                                    <h6 class="invoice-number mr-75">Invoice#</h6>
                                                    <input type="text" name="bill_no" class="form-control pt-25 w-50" id="bill_no" value="{{$invoice_no}}" placeholder="#000">
                                                    </div>
                                                <div class="col-xl-8 col-md-12 px-0 pt-xl-0 pt-1">
                                                    <div class="invoice-date-picker d-flex align-items-center justify-content-xl-end flex-wrap">
                                                        <div class="d-flex align-items-center">
                                                            <small class="text-muted mr-75">Date Issue: </small>
                                                            <fieldset class="d-flex ">
                                                                <input type="text" class="form-control pickadate mr-2 mb-50 mb-sm-0" id="date" name="date" placeholder="Select Date">
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="row mx-0">
                                                <div class="col-md-6 mb-md-0 mb-4">
                                                    <img src="/app-assets/images/mascot/logo-without-background.png" alt="Shop Logo" width="120px">
                                                    <p class="mb-1">177, Nirnay Nagar Sector-4,</p>
                                                    <p class="mb-1">Opp. Vimalnath Bus Stand, Nirnay Nagar, Ahmedabad</p>
                                                    <p class="mb-1">+91 86906 97978, +91 95580 71708</p>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <dl class="row mb-2">
                                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                                            <span class="h4 text-capitalize mb-0 text-nowrap">Invoice
                                                                #</span>
                                                        </dt>
                                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                                            <div class="w-px-150">
                                                                <input type="text" class="form-control"
                                                                    placeholder="3905" disabled value="{{$invoice->invoice_number}}" name="invoice_no" id="invoiceId">
                                                            </div>
                                                        </dd>
                                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                                            <span class="fw-normal">Date:</span>
                                                        </dt>
                                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                                            <div class="w-px-150 d-flex">
                                                                <input type="text" value="{{\Carbon\Carbon::createFromFormat('Y-m-d', $invoice->date)->format('j F, Y')}}"
                                                                    class="form-control pickadate"
                                                                    placeholder="YYYY-MM-DD"  id="date" name="date">

                                                            </div>
                                                        </dd>
                                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                                            <span class="fw-normal">Delievery Date:</span>
                                                        </dt>
                                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                                            <div class="w-px-150 d-flex">
                                                                <input type="text" value="{{\Carbon\Carbon::createFromFormat('Y-m-d', $invoice->delivery_date)->format('j F, Y')}}"
                                                                class="form-control pickadate"
                                                                placeholder="YYYY-MM-DD" id="delivery_date" name="delivery_date">

                                                                </div>
                                                                </dd>
                                                        {{-- <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                                            <span class="fw-normal">Due Date:</span>
                                                        </dt>
                                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                                            <div class="w-px-150">
                                                                <input type="text"
                                                                    class="form-control date-picker flatpickr-input"
                                                                    placeholder="YYYY-MM-DD" readonly="readonly">
                                                            </div>
                                                        </dd> --}}
                                                    </dl>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- logo and title -->

                                            <!-- invoice address and contact -->
                                            <div class="row invoice-info">
                                                <div class="col-lg-6 col-md-12 mt-25">
                                                    <h6 class="invoice-to">Bill To</h6>
                                                    <fieldset class="invoice-address form-group">
                                                        <input type="number" name="ph_number" value="{{$invoice->customer->phone_number}}" class="form-control"
                                                            placeholder="Phone Number">
                                                            <span id="phoneError" style="color: red;"></span>
                                                    </fieldset>
                                                    <fieldset class="invoice-address form-group">
                                                        <input type="text" name="customer_name" class="form-control"
                                                            placeholder="Customer Name" value="{{$invoice->customer->name}}">
                                                            <span id="nameError" style="color: red;"></span>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="card-body pt-50">
                                            <!-- product details table-->
                                            <div class="invoice-product-details ">
                                                <div class="form invoice-item-repeater">
                                                    <div data-repeater-list="item">
                                                        @php
                                                        $count = 0;
                                                        @endphp
                                                        @foreach ($invoice->incoiceItems as $item )
                                                            <div data-repeater-item>
                                                                <div class="row mb-50">
                                                                    <div class="col-3 col-md-4 invoice-item-title">Item</div>
                                                                    <div class="col-3 invoice-item-title" id="">Rate
                                                                    </div>
                                                                    <div class="col-2 invoice-item-title">Qty/Mtr</div>
                                                                    <div class="col-3 col-md-2 invoice-item-title"
                                                                        style="text-align: center;">Ammount</div>
                                                                </div>
                                                                <div class="invoice-item d-flex border rounded mb-1">
                                                                    <div class="invoice-item-filed row pt-1 px-1" style="position: relative; width:110%;">
                                                                        <div class="col-12 col-md-4 form-group">
                                                                            <select class="form-control invoice-item-select"
                                                                                name="item[{{$count}}][type]" onchange="onItemSelect(this)" >
                                                                                <option value="shirt" {{$item->type == 'shirt' ? 'selected' : ''}}>Shirt</option>
                                                                                <option value="pent" {{$item->type == 'pent' ? 'selected' : ''}}>Pent</option>
                                                                                <option value="shirting" {{$item->type == 'shirting' ? 'selected' : ''}}>Shirting</option>
                                                                                <option value="suiting" {{$item->type == 'suiting' ? 'selected' : ''}}>Suiting</option>
                                                                                <option value="kurta" {{$item->type == 'kurta' ? 'selected' : ''}}>Kurta</option>
                                                                                <option value="lengha" {{$item->type == 'lengha' ? 'selected' : ''}}>Lengha</option>
                                                                                <option value="blezer" {{$item->type == 'blezer' ? 'selected' : ''}}>Blezer</option>
                                                                                <option value="jodhpuri" {{$item->type == 'jodhpuri' ? 'selected' : ''}}>Jodhpuri</option>
                                                                                <option value="safari" {{$item->type == 'safari' ? 'selected' : ''}}>Safari</option>
                                                                                <option value="indo-western" {{$item->type == 'indo-western' ? 'selected' : ''}}>Indo-western</option>
                                                                                <option value="koti" {{$item->type == 'koti' ? 'selected' : ''}}>Koti</option>
                                                                                <option value="pathani" {{$item->type == 'pathani' ? 'selected' : ''}}>Pathani</option>
                                                                                <option value="3 peice (shoot, pent and shirt)" {{$item->type == '3 peice (shoot, pent and shirt)' ? 'selected' : ''}}>3 peice (shoot, pent and shirt)</option>
                                                                                <option value="3 peice (kurta, paijama and koti)" {{$item->type == '3 peice (kurta, paijama and koti)' ? 'selected' : ''}}>3 peice (kurta, paijama and koti)</option>
                                                                                <option value="stitching" {{$item->type == 'stitching' ? 'selected' : ''}}>Stitching</option>
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 col-12 form-group">
                                                                            <input type="text" id="item[{{$count}}][cost]"
                                                                                name="item[{{$count}}][cost]" value="{{$item->cost}}"
                                                                                class="cost-input form-control"
                                                                                placeholder="0">
                                                                        </div>
                                                                        <div class="col-md-2 col-12 form-group  ">
                                                                            <input type="text" id="item[{{$count}}][quantity]"
                                                                                name="item[{{$count}}][quantity]" value="{{$item->quantity}}"
                                                                                class="quantity-input form-control"
                                                                                placeholder="0">
                                                                        </div>
                                                                        <div class="col-md-2 col-12 form-group"
                                                                            style="text-align: center; padding-top: 10px;">
                                                                            <strong class="text-primary align-middle"
                                                                                name="item[{{$count}}][price]">₹ {{$item->price}}</strong>
                                                                            <input type="hidden"
                                                                                class="text-primary align-middle raw_amount" value="{{$item->price}}"
                                                                                id="item[{{$count}}][price]" name="item[{{$count}}][price]">
                                                                        </div>
                                                                        <div class="col-md-1 col-12 form-group invoice-icon " style=" padding-top: 10px;">
                                                                            <span class="cursor-pointer close_button" data-repeater-delete>
                                                                                <i class="bx bx-x close_button"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            @php
                                                                $count++;
                                                            @endphp
                                                        @endforeach

                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col p-0">
                                                            <button class="btn btn-light-primary btn-sm"
                                                                data-repeater-create type="button">
                                                                <i class="bx bx-plus"></i>
                                                                <span class="invoice-repeat-btn">Add Item</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- invoice subtotal -->
                                            <hr>
                                            <div class="invoice-subtotal pt-50">
                                                <div class="row">
                                                    <div class="col-md-5 col-12">
                                                        <div class="form-group">
                                                            <h6 class="text-muted mr-75">Apply Discount: </h6>
                                                            <fieldset class="d-flex ">
                                                                <input type="text" name="discount_percentage"
                                                                    id="discount_percentage" class="form-control" value="{{$invoice->discount_percentange}}"
                                                                    placeholder="Enter percentage">
                                                            </fieldset>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="discount_amount"
                                                                id="discount_amount" class="form-control" value="{{$invoice->discount_ammount}}"
                                                                placeholder="Enter Amount">
                                                        </div>

                                                        <div class="form-group">
                                                            <h6 class="text-muted mr-75">Paid Amount: </h6>
                                                            <fieldset class="d-flex ">
                                                                <input type="text" name="paid_amount" id="paid_amount" value="{{$invoice->paid_ammount}}"
                                                                    class="form-control" placeholder="00">
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-7 offset-lg-2 col-12">
                                                        <ul class="list-group list-group-flush">
                                                            <li
                                                                class="list-group-item d-flex justify-content-between border-0 pb-0">
                                                                <span class="invoice-subtotal-title">Subtotal</span>
                                                                <h6 class="invoice-subtotal-value mb-0 subtotal">₹ {{$invoice->sub_total}}
                                                                </h6>
                                                                <input type="hidden" id="subtotal" name="sub_total" value="{{$invoice->sub_total}}">
                                                            </li>
                                                            <li class="list-group-item py-0 border-0 mt-25">
                                                                <hr>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between border-0 pb-0">
                                                                <span class="invoice-subtotal-title">Discount Amount</span>
                                                                <h6 class="invoice-subtotal-value mb-0">
                                                                    <span>₹</span>
                                                                    <span class="amount_discount_value">{{$invoice->discount_ammount}}</span>
                                                                </h6>
                                                            </li>

                                                            <li
                                                                class="list-group-item d-flex justify-content-between border-0 py-0">
                                                                <span class="invoice-subtotal-title">Discount
                                                                    Percentage</span>
                                                                <h6 class="invoice-subtotal-value mb-0 ">
                                                                    <span>₹</span>
                                                                    <span class="percentage_discount_value">{{$invoice->discount_percentange}}</span>
                                                                </h6>
                                                            </li>

                                                            <li class="list-group-item py-0 border-0 mt-25">
                                                                <hr>
                                                            </li>

                                                            <li
                                                                class="list-group-item d-flex justify-content-between border-0 py-0">
                                                                <span class="invoice-subtotal-title">Total Discount</span>
                                                                <h6
                                                                    class="invoice-subtotal-value mb-0 total_discount_value">
                                                                    - ₹ {{$invoice->total_discount}}</h6>
                                                                <input type="hidden" id="total_discount" name="total_discount" value="{{$invoice->total_discount}}">
                                                            </li>

                                                            <li
                                                                class="list-group-item d-flex justify-content-between border-0 pb-0">
                                                                <span class="invoice-subtotal-title">Invoice Total</span>
                                                                <h6 class="invoice-subtotal-value mb-0 total">₹ {{$invoice->total}}</h6>
                                                                <input type="hidden" name="total" id="total" value="{{$invoice->total}}">
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between border-0 pb-0">
                                                                <span class="invoice-subtotal-title">Paid to date</span>
                                                                <h6 class="invoice-subtotal-value mb-0 paid_amount">- ₹
                                                                    {{$invoice->paid_ammount}}</h6>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between border-0 pb-0">
                                                                <span class="invoice-subtotal-title">Remaining
                                                                    Amount</span>
                                                                <h6
                                                                    class="invoice-subtotal-value mb-0 remaining_amount_text">
                                                                    ₹ {{$invoice->remaining_ammount}}</h6>
                                                                <input type="hidden" name="remaining_amount"
                                                                    id="remaining_amount" value="{{$invoice->remaining_ammount}}">
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="text-align: center; margin-top: 10px;">
                                                <button class="btn btn-primary subtotal-preview-btn" type="submit" >Update Invoice</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- invoice action  -->
                            <div class="col-xl-3 col-md-4 col-12">
                                <div class="card invoice-action-wrapper shadow-none border">
                                    <div class="card-body">
                                        <div class="invoice-action-btn mb-1">
                                            <button class="btn btn-primary btn-block invoice-send-btn">
                                                <i class="bx bx-send"></i>
                                                <span>Send Invoice</span>
                                            </button>
                                        </div>
                                        <div class="invoice-action-btn mb-1">
                                            <button class="btn btn-light-primary btn-block">
                                                <span>Download Invoice</span>
                                            </button>
                                        </div>
                                        <div class="invoice-action-btn mb-1 d-flex">
                                            <div class="preview w-50 mr-50">
                                                <button class="btn btn-light-primary btn-block">
                                                    <span class="text-nowrap">Preview</span>
                                                </button>
                                            </div>
                                            <div class="save w-50">
                                                <button class="btn btn-light-primary btn-block">
                                                    <span class="text-nowrap">Save</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="invoice-action-btn mb-1">
                                            <button class="btn btn-success btn-block">
                                                <i class='bx bx-dollar'></i>
                                                <span>Add Payment</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-payment">
                                    <div class="invoice-payment-option mb-2">
                                        <p>Accept payments via</p>
                                        <select name="payment" id="paymentOption" class="form-control bg-transparent">
                                            <option value="DebitCard">Debit Card</option>
                                            <option value="DebitCard">Credit Card</option>
                                            <option value="DebitCard">Paypal</option>
                                            <option value="DebitCard">Internet Banking</option>
                                            <option value="DebitCard">UPI Transfer</option>
                                        </select>
                                    </div>
                                    <div class="invoice-terms">
                                        <div class="d-flex justify-content-between py-50">
                                            <span class="invoice-terms-title">Payment Terms</span>
                                            <div class="custom-control custom-switch custom-switch-glow">
                                                <input type="checkbox" class="custom-control-input" checked
                                                    id="paymentTerm">
                                                <label class="custom-control-label" for="paymentTerm">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between py-50">
                                            <span class="invoice-terms-title">Client Notes</span>
                                            <div class="custom-control custom-switch custom-switch-glow">
                                                <input type="checkbox" class="custom-control-input" checked
                                                    id="clientNote">
                                                <label class="custom-control-label" for="clientNote">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between py-50">
                                            <span class="invoice-terms-title">Payment Stub</span>
                                            <div class="custom-control custom-switch custom-switch-glow">
                                                <input type="checkbox" class="custom-control-input" id="paymentstub">
                                                <label class="custom-control-label" for="paymentstub">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </form>
    <!-- END: Content-->
@endsection

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-left d-inline-block">2020 &copy; PIXINVENT</span><span
            class="float-right d-sm-inline-block d-none">Crafted with<i
                class="bx bxs-heart pink mx-50 font-small-3"></i>by<a class="text-uppercase"
                href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a></span>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i
                class="bx bx-up-arrow-alt"></i></button>
    </p>
</footer>
<!-- END: Footer-->



@section('jqcdn')
    <script src="../../assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>

    <script src="/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
    <script src="/app-assets/js/scripts/pages/app-invoice.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        function onItemSelect(element) {
        var index = element.name.match(/\d+/)[0];

         if ($(`input[name="item[${index}][quantity]"]`).val() == 0) {
             $(`input[name="item[${index}][quantity]"]`).val(1)
         }
    }
    </script>
    <script>
        function validatePhoneNumber() {
            var phoneNumber = document.forms["invoiceForm"]["ph_number"].value;
            var phoneError = document.getElementById("phoneError");

            // Remove non-digit characters
            phoneNumber = phoneNumber.replace(/\D/g, '');

            // Check if the phone number is exactly 10 digits
            if (phoneNumber.length !== 10) {
                phoneError.innerHTML = "Phone Number should have exactly 10 digits";
                /* scrollToElement(phoneError); */

            } else {
                phoneError.innerHTML = "";
            }
        }

        function validateForm(event) {

        var phoneNumber = document.forms["invoiceForm"]["ph_number"].value;
        var customerName = document.forms["invoiceForm"]["customer_name"].value;
        var phoneError = document.getElementById("phoneError");
        var nameError = document.getElementById("nameError");

        // Check if the phone number is empty
        if (phoneNumber.trim() === "") {
            phoneError.innerHTML = "Phone Number cannot be empty";
            scrollToElement(phoneError);
            return false;
        }

        // Check if the phone number contains exactly 10 digits
        /* var phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phoneNumber)) {
            phoneError.innerHTML = "Phone Number should have exactly 10 digits";
            scrollToElement(phoneError);
            return false;
        } */

        // If phone number validation passes, reset the error message
        phoneError.innerHTML = "";

        // Check if the customer name is empty
        if (customerName.trim() === "") {
            nameError.innerHTML = "Customer Name cannot be empty";
            scrollToElement(nameError);
            return false;
        }

        // Check if the customer name contains only letters and numbers
        /* var namePattern = /^[a-zA-Z0-9]+$/;
        if (!namePattern.test(customerName)) {
            nameError.innerHTML = "Customer Name can only contain letters and numbers";
            scrollToElement(nameError);
            return false;
        } */

        // If all validations pass, reset the error message
        nameError.innerHTML = "";

        // Additional validation logic can be added here if needed

        // If everything is valid, submit the form
        document.getElementById("invoiceForm").submit();
    }

    function handleEnterKey(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
            }
        }

        function scrollToElement(element) {
            // Scroll the page to the specified element
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }


        </script>
@endsection
