

$('#inputName').keypress(function (e) {
            if (String.fromCharCode(e.which).match(/[A-Za-z!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]/)) {
                e.preventDefault();
            }
});


function submitContactForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var price = $('#inputName').val();
    var product_id = $('#product_id').val();
    var auction_id = $('#auction_id').val();
    var user_id = $('#user_id').val();
    var user_id = $('#user_id').val();
    var action = $('#action').val();
    var token = $('input[name="_token"]').val();
    if(price.trim() == '' ){
        alert('Please enter bidd price.');
        $('#inputName').focus();
        return false;
//    { name: "John", location: "Boston" }
    }else{
        $.ajax({
            type:'POST',
            url: action,
//            data:{ price: price,  _token: $('#_token').val()},
            data:'user_id='+user_id+'&price='+price+'&product_id='+product_id+'&auction_id='+auction_id+'&_token='+token,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                console.log(msg);
                if(msg.success == true){
                    $('#inputName').val('');
//                    $('#product_id').val('');
//                    $('#inputMessage').val('');
                    $('.statusMsg').html('<span style="color:green;">Bid Submitted.</p>');
                }else{
                    $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}


 function goDobidding(identifier){   
        var bidding_history_id =$(identifier).data('bidding_history_id');
        var last_bidding_user_id =$(identifier).data('last_bidding_user_id');
        var price = $(identifier).data('price');
        var product_price = $(identifier).data('product_price');
        var product_id = $(identifier).data('product_id');
        var auction_id = $(identifier).data('auction_id');
        var user_id = $(identifier).data('user_id');
        var user_name = $(identifier).data('user_name');
        var action = $(identifier).data('action');
        var token =$(identifier).data('csrf_token');
        var time =$(identifier).data('time');
        var auction_end_time = $(identifier).data('acuction_end_time');
        if(time)
           // alert("data-id:"+$(identifier).data('id')+", data-option:"+$(identifier).data('option')); 
//            alert(last_bidding_user_id +'::'+ user_id );
       if(last_bidding_user_id == user_id){
           
          $('#product_msg_'+product_id).html('You are highest bidder!');
           
       }else{     
            $.ajax({
                 type:'POST',
                 url: action,
     //            data:{ price: price,  _token: $('#_token').val()},
                 data:'user_id='+user_id+'&price='+price+'&product_id='+product_id+'&auction_id='+auction_id+'&_token='+token+'&time='+time+'&product_price='+product_price+'&user_name='+user_name+'&auction_end_time='+auction_end_time,
                 beforeSend: function () {
                     $('.msg').html('');
                     $('.submitBtn').attr("disabled","disabled");
     //                $('.modal-body').css('opacity', '.5');
                 },
                 success:function(msg){
                     console.log(msg);
                     if(msg.success == true){
     //                      product_id_{{ $product->id }}
                         $('#product_username_'+msg.bidingHistories.product_id).html(msg.bidingHistories.username);
                         $('#product_id_'+msg.bidingHistories.product_id).data("bidding_history_id",msg.bidingHistories.id);
                         $('#product_id_'+msg.bidingHistories.product_id).data("product_price",msg.bidingHistories.price);
                         $('#product_id_'+msg.bidingHistories.product_id).data("last_bidding_user_id",msg.bidingHistories.user_id);
                          $('.msg').html('');
//                         last_inserted_user_id = msg.bidingHistories.user_id ;
     //                    $('#inputMessage').val('');

                     }else{
                         $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                     }
                     $('.submitBtn').removeAttr("disabled");
     //                $('.modal-body').css('opacity', '');
                 }
             });
     
        }
     
    }
    
    
    
    
    function formateTwoDigit(n){
        return n > 9 ? "" + n: "0" + n;
    }




// success: function() {
//     alert("success");
// },
// error: function() {
//     alert("error");
// },


$("#register").submit(function(e) {


    var form = $(this);
    var host = window.location.host;

    $.ajax({
        type: "POST",
        url: 'register',
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            $("#email").removeClass("is-invalid");
            $("#email").closest('span').html( );
            $("#password").removeClass("is-invalid");
            $("#password").closest('span').html('');

            //alert(host); // show response from the php script.
            var homeurl = host+'/home';
            window.location = '/poxaapp/home'; //your desired url
        },
        error: function(data, status) {
            console.log(data.responseJSON.errors.email['0']);
            var password = 'password' in data.responseJSON.errors && data.responseJSON.errors.password[0] || 'no';
            var email = 'email' in data.responseJSON.errors && data.responseJSON.errors.email[0] || 'no';
            if(email != 'no'){
                $("#email").addClass("is-invalid");
                $("#email-error").html('<strong>'+data.responseJSON.errors.email['0']+'</strong>');
                // $("#email").closest('span').html('<strong>'+data.responseJSON.errors.email['0']+'</strong>');
            }
            if(password != 'no') {
                $("#password").addClass("is-invalid");
                $("#password-error").closest('span').html('<strong>'+data.responseJSON.errors.password['0']+'</strong>');
                // $("#password").closest('span').html('<strong>'+data.responseJSON.errors.password['0']+'</strong>');
            }
            // alert(data);
        },
    });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});


