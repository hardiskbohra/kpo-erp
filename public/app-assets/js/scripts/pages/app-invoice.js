/*=========================================================================================
    File Name: app-invoice.js
    Description: app-invoice Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Frest HTML Admin Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
var totalAmount = 0;

$(document).ready(function () {


    //--------------update delivery status---------------------------
    $('.delivery-status').on('click', function() {

        var checkbox = $(this);
        var deliveryStatusTd = checkbox.closest('.delivery-status');
        var invoiceId = deliveryStatusTd.data('invoice-id');
        var isDelivered = checkbox.closest('.delivery-status').data('delivered');
        var delivery_date = checkbox.closest('.delivery-status').data('delievery_date');
        var html = isDelivered != "yes" ? '<button class="badge badge-success badge-pill badge-round delivery-badge" style="border: none">Delivered</button>' :
        '<button class="badge badge-light-green badge-pill badge-round delivery-badge" style="border: none"">' + delivery_date + '</button>';

        // Simulate an Ajax call to update the delivered status
        $.ajax({
            url: '/update-delivered-status',  // Replace with your actual endpoint
            type: 'POST',
            data: {
                invoice_id: invoiceId,
            },
            success: function(response) {
                // Update the badge based on the new delivered status
                    deliveryStatusTd.html(html);
                    deliveryStatusTd.data('delivered',isDelivered == "yes" ? 'no' : 'yes')

            },
            error: function(error) {
                console.error('Error updating delivery status:', error);
            }
        });
    });
    //--------------update delivery status---------------------------

    //------------open add invoice page on click of floating button icon ------------------------
    $('#chat-demo-button').on('click', function () {
        // Collect data from the form
        var formData = $('#addPaymentForm').serialize();
        console.log(formData);
        // Make an AJAX call to store payment history
        $.ajax({
            url: '/add-payment-history', // Replace with your actual route
            type: 'POST',
            data: formData,
            success: function (response) {
                // Handle the success response (if needed)
                console.log(response);
                location.reload();
            },
            error: function (error) {
                // Handle the error (if needed)
                console.error(error);
            }
        });
    });
    //------------open add invoice page on click of floating button icon ------------------------


    //------------add payment ------------------------
    $('#addPaymentBtn').on('click', function () {
        // Collect data from the form
        var formData = $('#addPaymentForm').serialize();
        console.log(formData);
        // Make an AJAX call to store payment history
        $.ajax({
            url: '/add-payment-history', // Replace with your actual route
            type: 'POST',
            data: formData,
            success: function (response) {
                // Handle the success response (if needed)
                console.log(response);
                location.reload();

            },
            error: function (error) {
                // Handle the error (if needed)
                console.error(error);
            }
        });
    });
    //------------add payment ------------------------

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var nameInput = $('input[name="customer_name"]');
    var phoneInput = $('input[name="ph_number"]');
    phoneInput.focus();

   phoneInput.on('input', function () {
        // Clear the name field when the phone number changes
        nameInput.val('');

        var phoneNumber = $(this).val();

        // Check if the phone number has 10 digits
        if (phoneNumber.length >= 10 && phoneNumber.length <= 13 ) {
            // Make an AJAX call to get the customer name
            $.ajax({
                url: '/get-customer-name',
                type: 'POST',
                data: {ph_number: phoneNumber},
                success: function (response) {
                    // Check if a name is returned in the response
                    if (response.customer_name) {
                        // Make the name field readonly
                        nameInput.prop('readonly', true);
                    } else {
                        // Make the name field editable
                        nameInput.prop('readonly', false);
                    }

                    // Set the value of the name field
                    nameInput.val(response.customer_name);
                },
                error: function (error) {
                    console.error(error);
                }
            });
        } else {
            // If the phone number is not 10 digits, make the name field editable
            nameInput.prop('readonly', false);
        }
    });




    //dynamic price change
    $(document).on('input', '.cost-input, .quantity-input', function () {
        var index = $(this).attr('name').match(/\d+/)[0];

        // Get the corresponding cost and quantity values
        var cost = parseFloat($(`input[name="item[${index}][cost]"]`).val()) || 0;
        var quantity = parseFloat($(`input[name="item[${index}][quantity]"]`).val()) || 0;

        // Calculate total price
        var totalPrice = cost * quantity;

        // Update the price label
        $(`strong[name="item[${index}][price]"]`).text('₹ ' + totalPrice.toFixed(2));
        $(`input[name="item[${index}][price]"]`).val(totalPrice.toFixed(2));
        $(`input[name="item[${index}][price]"]`).trigger('change');
        $('#discount_amount').trigger('input');
    });

    $(document).on('change', 'input[name^="item["][name$="[price]"]', function () {
        var total = 0;
        $('input[name^="item["][name$="[price]"]').each(function() {
            var price = parseFloat($(this).val()) || 0;
            total += price;
        });

        // Update the total label
        $('.subtotal').text('₹ ' +total.toFixed(2));
        $('#subtotal').val(total.toFixed(2));
    });

    $(document).on('input', '#discount_amount, #discount_percentage, #paid_amount', function () {
        totalAmount = parseFloat($('#subtotal').val()) || 0;

        var discountPercentage = parseFloat($('#discount_percentage').val()) || 0;
        var discountAmount = parseFloat($('#discount_amount').val()) || 0;
        var paidAmount = parseFloat($('#paid_amount').val()) || 0;
        var discountedAmount = 0;

        $(".amount_discount_value").text(discountAmount.toFixed(2));

        if (discountPercentage > 0 && discountPercentage <= 100) {
            discountedAmount = (totalAmount * (discountPercentage / 100));
        }
        $(".percentage_discount_value").text(discountedAmount.toFixed(2));

        discountedAmount += discountAmount
        $('.total_discount_value').text('- ₹ ' +discountedAmount.toFixed(2));
        $("#total_discount").val(discountedAmount.toFixed(2));


        //showing total = sub total - discount
        $("#total").val((totalAmount - discountedAmount).toFixed(2));
        $(".total").text(' ₹ ' +(totalAmount - discountedAmount).toFixed(2));

        //changing paid amount value
        if(parseFloat($('#paid_amount').val()) != '' && parseFloat($('#paid_amount').val()) > 0)
        {
            $(".paid_amount").text(' ₹ '+parseFloat($('#paid_amount').val()) || 0);
        }
        else
        {
            $(".paid_amount").text(' ₹ '+ 0.00);
        }

        var totalPayAmount = totalAmount - discountedAmount;
        var remainingAmount = totalPayAmount - paidAmount;
        if (remainingAmount >= 0) {
            $(".remaining_amount_text").text(' ₹ ' + remainingAmount.toFixed(2));
            $("#remaining_amount").val(remainingAmount.toFixed(2));
        }

    });

    // $(document).on('click', '.close_button', function () {
    //     console.log($(this).closest(".raw_amount").val());
    // });


    $(document).on('click', '.close_button', function () {

        $(this).closest('[data-repeater-item]').remove()
        var total = 0;
        $('input[name^="item["][name$="[price]"]').each(function() {
            var price = parseFloat($(this).val()) || 0;
            total += price;
        });

        // Update the total label
        $('.subtotal').text('₹ ' +total.toFixed(2));
        $('#subtotal').val(total.toFixed(2));

        $('.copst-inut').trigger('change');
        $('.raw_amount').trigger('change');

        $('.quantity-input').trigger('input');

});


  /********Invoice View ********/
  // ---------------------------
  // init date picker
  if ($(".pickadate").length) {
    $(".pickadate").pickadate({
    //   format: "mm/dd/yyyy"
    });
  }

  /********Invoice List ********/
  // ---------------------------

  // init data table
  if ($(".invoice-data-table").length) {
    var dataListView = $(".invoice-data-table").DataTable({
      columnDefs: [
        {
          targets: 0,
          className: "control"
        },
        {
          orderable: true,
          targets: 1,
          checkboxes: { selectRow: true }
        },
        {
          targets: [0, 1],
          orderable: false
        },
      ],
      order: [2, 'asc'],
      dom:
        '<"top d-flex flex-wrap"<"action-filters flex-grow-1"f><"actions action-btns d-flex align-items-center">><"clear">rt<"bottom"p>',
      language: {
        search: "",
        searchPlaceholder: "Search Invoice"
      },
      select: {
        style: "multi",
        selector: "td:first-child",
        items: "row"
      },
      responsive: {
        details: {
          type: "column",
          target: 0
        }
      }
    });
  }

  // To append actions dropdown inside action-btn div
  var invoiceFilterAction = $(".invoice-filter-action");
  var invoiceOptions = $(".invoice-options");
  $(".action-btns").append(invoiceFilterAction, invoiceOptions);

  // add class in row if checkbox checked
  $(".dt-checkboxes-cell")
    .find("input")
    .on("change", function () {
      var $this = $(this);
      if ($this.is(":checked")) {
        $this.closest("tr").addClass("selected-row-bg");
      } else {
        $this.closest("tr").removeClass("selected-row-bg");
      }
    });
  // Select all checkbox
  $(document).on("change", ".dt-checkboxes-select-all input", function () {
    if ($(this).is(":checked")) {
      $(".dt-checkboxes-cell")
        .find("input")
        .prop("checked", this.checked)
        .closest("tr")
        .addClass("selected-row-bg");
    } else {
      $(".dt-checkboxes-cell")
        .find("input")
        .prop("checked", "")
        .closest("tr")
        .removeClass("selected-row-bg");
    }
  });

  // ********Invoice Edit***********//
  // --------------------------------
  // form repeater jquery
  if ($(".invoice-item-repeater").length) {
    $(".invoice-item-repeater").repeater({
      show: function () {
        $(this).slideDown();
      },
      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
      }
    });
  }

  // dropdown form's prevent parent action
  $(document).on("click", ".invoice-tax", function (e) {
    e.stopPropagation();
  });
  $(document).on("click", ".invoice-apply-btn", function () {
    var $this = $(this);
    var discount = $this
      .closest(".dropdown-menu")
      .find("#discount")
      .val();
    var tax1 = $this
      .closest(".dropdown-menu")
      .find("#Tax1 option:selected")
      .text();
    var tax2 = $this
      .closest(".dropdown-menu")
      .find("#Tax2 option:selected")
      .text();
    $this
      .parents()
      .eq(4)
      .find(".discount-value")
      .html(discount + "%");
    $this
      .parents()
      .eq(4)
      .find(".tax1")
      .html(tax1);
    $this
      .parents()
      .eq(4)
      .find(".tax2")
      .html(tax2);
  });
  // // on product change also change product description
  $(document).on("change", ".invoice-item-select", function (e) {
    var selectOption = this.options[e.target.selectedIndex].text;
    // switch case for product select change also change product description
    switch (selectOption) {
      case "Frest Admin Template":
        $(e.target)
          .closest(".invoice-item-filed")
          .find(".invoice-item-desc")
          .val("The most developer friendly & highly customisable HTML5 Admin");
        break;
      case "Stack Admin Template":
        $(e.target)
          .closest(".invoice-item-filed")
          .find(".invoice-item-desc")
          .val("Ultimate Bootstrap 4 Admin Template for Next Generation Applications.");
        break;
      case "Robust Admin Template":
        $(e.target)
          .closest(".invoice-item-filed")
          .find(".invoice-item-desc")
          .val(
            "Robust admin is super flexible, powerful, clean & modern responsive bootstrap admin template with unlimited possibilities"
          );
        break;
      case "Apex Admin Template":
        $(e.target)
          .closest(".invoice-item-filed")
          .find(".invoice-item-desc")
          .val("Developer friendly and highly customizable Angular 7+ jQuery Free Bootstrap 4 gradient ui admin template. ");
        break;
      case "Modern Admin Template":
        $(e.target)
          .closest(".invoice-item-filed")
          .find(".invoice-item-desc")
          .val("The most complete & feature packed bootstrap 4 admin template of 2019!");
        break;
    }
  });
  // print button
  if ($(".invoice-print").length > 0) {
    $(".invoice-print").on("click", function () {
      window.print();
    })
  }
});
