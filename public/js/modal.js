function sign_in() {
    $('#sign-in').addClass('active')
    $('#sign-up').removeClass('active')
    $('#reset-tab').removeClass('show active')
    $('#sign-up-tab').removeClass('show active')
    $('#sign-in-tab').addClass('show active')
}

function sign_up() {
     $('#sign-up').addClass('active')
     $('#sign-in').removeClass('active')
     $('#sign-in-tab').removeClass('show active')
     $('#reset-tab').removeClass('show active')
     $('#sign-up-tab').addClass('show active')
}

function reset_pwd() {
     $('#sign-in').removeClass('active')
     $('#sign-up').removeClass('active')
     $('#sign-in-tab').removeClass('show active')
     $('#sign-up-tab').removeClass('show active')
     $('#reset-tab').addClass('show active')
}


$(document).ready(function() {
   $("#check-pwd").click(function() {
       if ($("input[type=checkbox]").is(
         ":checked")) {
            $('#pwd').removeClass('d-none')
            $('#pwd-confirm').removeClass('d-none')
            $('#lbl-pwd').removeClass('d-none')
            $('#lbl-pwd-confirm').removeClass('d-none')
       } else {
         $('#pwd').addClass('d-none')
         $('#pwd-confirm').addClass('d-none')
         $('#lbl-pwd').addClass('d-none')
         $('#lbl-pwd-confirm').addClass('d-none')
       }
   });
});

$(document).on("change", "#file-name", function () {
   if (this.files && this.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
         $('#preview').attr('src', e.target.result);
      };
      reader.readAsDataURL(this.files[0]);
   }
});

function delete_modal(id) {
   $('#delete-modal').attr('data-id', id)
}

function img_data(status) {
   $('#image-modal').attr('data-status', status)
}

function modify_product(id, img, name, price, type, reduct, desc, status) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
   $('#modify-price').val(price)
   $('#modify-product-type').val(type)
   $('#modify-img').val(img)
   $('#modify-img').attr('src', "/images/"+img)
   $('#modify-hidden-img').val(img)
   $('#modify-reduction').val(reduct)
   $('#modify-description').val(desc)

   if (status == '1') {
      $("#modify-check-status").attr('checked', true)
   } else {
      $("#modify-check-status").attr('checked', false)
   }
}
function modify_producttype(id, name, desc) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
   $('#modify-description').val(desc)

}
function modify_companys(id, company_name, address, city, zipcode, country,subcription,subcription_date, status) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-company_name').val(company_name)
   $('#modify-address').val(address)
   $('#modify-city').val(city)
   $('#modify-zipcode').val(zipcode)
   $('#modify-country').val(country)
   $('#modify-subcription').val(subcription)
   $('#modify-subcription_date').val(subcription_date)

   if (status == '1') {
      $("#modify-check-status").attr('checked', true)
   } else {
      $("#modify-check-status").attr('checked', false)
   }
}
function modify_groups(id, name, desc,) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
   $('#modify-description').val(desc)

}
function modify_orderproducts(id, orders_id, products_id, quantity, sub_total) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-orders_id').val(orders_id)
   $('#modify-products-id').val(products-id)
   $('#modify-quantity').val(quantity)
   $('#modify-sub_total').val(sub_total)

}
function modify_orders(id, invoice_prefix, invoice_no, users_id, total, reduct, payment_country, payment_firstname, payment_lastname, payment_companys, payment_address, payment_city, payment_zipcode, comment, status) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-invoice_prefix').val(invoice_prefix)
   $('#modify-invoice_no').val(invoice_no)
   $('#modify-product-type').val(type)
   $('#modify-users_id').val(users_id) 
   $('#modify-total').val(total)
   $('#modify-reduction').val(reduct)
   $('#modify-payment_country').val(payment_country)
   $('#modify-payment_firstname').val(payment_firstname)
   $('#modify-payment_lastname').val(payment_lastname)
   $('#modify-payment_companys').val(payment_companys)
   $('#modify-payment_address').val(payment_address)
   $('#modify-payment_city').val(payment_city)
   $('#modify-payment_zipcode').val(payment_zipcode)
   $('#modify-comment').val(comment)

   if (status == '1') {
      $("#modify-check-status").attr('checked', true)
   } else {
      $("#modify-check-status").attr('checked', false)
   }
}
function modify_partners(id, img, name, price, type, reduct, desc, status) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
   $('#modify-price').val(price)
   $('#modify-product-type').val(type)
   $('#modify-img').val(img)
   $('#modify-img').attr('src', "/images/"+img)
   $('#modify-hidden-img').val(img)
   $('#modify-reduction').val(reduct)
   $('#modify-description').val(desc)

   if (status == '1') {
      $("#modify-check-status").attr('checked', true)
   } else {
      $("#modify-check-status").attr('checked', false)
   }
}
function modify_producttypes(id, img, name, price, type, reduct, desc, status) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
   $('#modify-price').val(price)
   $('#modify-product-type').val(type)
   $('#modify-img').val(img)
   $('#modify-img').attr('src', "/images/"+img)
   $('#modify-hidden-img').val(img)
   $('#modify-reduction').val(reduct)
   $('#modify-description').val(desc)

   if (status == '1') {
      $("#modify-check-status").attr('checked', true)
   } else {
      $("#modify-check-status").attr('checked', false)
   }
}
function modify_stocks(id, img, name, price, type, reduct, desc, status) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
   $('#modify-price').val(price)
   $('#modify-product-type').val(type)
   $('#modify-img').val(img)
   $('#modify-img').attr('src', "/images/"+img)
   $('#modify-hidden-img').val(img)
   $('#modify-reduction').val(reduct)
   $('#modify-description').val(desc)

   if (status == '1') {
      $("#modify-check-status").attr('checked', true)
   } else {
      $("#modify-check-status").attr('checked', false)
   }
}
function modify_subscriptions(id, img, name, price, type, reduct, desc, status) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
   $('#modify-price').val(price)
   $('#modify-product-type').val(type)
   $('#modify-img').val(img)
   $('#modify-img').attr('src', "/images/"+img)
   $('#modify-hidden-img').val(img)
   $('#modify-reduction').val(reduct)
   $('#modify-description').val(desc)

   if (status == '1') {
      $("#modify-check-status").attr('checked', true)
   } else {
      $("#modify-check-status").attr('checked', false)
   }
}
function modify_users(id, img, name, price, type, reduct, desc, status) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
   $('#modify-price').val(price)
   $('#modify-product-type').val(type)
   $('#modify-img').val(img)
   $('#modify-img').attr('src', "/images/"+img)
   $('#modify-hidden-img').val(img)
   $('#modify-reduction').val(reduct)
   $('#modify-description').val(desc)

   if (status == '1') {
      $("#modify-check-status").attr('checked', true)
   } else {
      $("#modify-check-status").attr('checked', false)
   }
}
function modify_warehouses(id, img, name, price, type, reduct, desc, status) {

   $('#modify-modal').attr('data-id', id)
   $('#modify-name').val(name)
   $('#modify-price').val(price)
   $('#modify-product-type').val(type)
   $('#modify-img').val(img)
   $('#modify-img').attr('src', "/images/"+img)
   $('#modify-hidden-img').val(img)
   $('#modify-reduction').val(reduct)
   $('#modify-description').val(desc)

   if (status == '1') {
      $("#modify-check-status").attr('checked', true)
   } else {
      $("#modify-check-status").attr('checked', false)
   }
}


