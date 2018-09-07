(function get_coin_info() {
    $('#coin_select').change(function () {
        $('#coin_select option:selected').each(function () {
            if(this.value > 0){
                $.ajax({
                    url: "/api/coininfo/"+this.value,
                    success: function( result ) {
                        result = JSON.parse(result);
                        console.log(result);  // delete
                        $('#c input[name="index"]').val(result.index);
                        $('#c input[name="price"]').val(result.price);
                        $('#c input[name="id_coin"]').val(result.id);
                    }
                });
            }else{
                $('#c input[name="index"]').val('Pleas select coin...');
                $('#c input[name="price"]').val('Pleas select coin...');
                $('#c input[name="id_coin"]').val('Pleas select coin...');
            }
        })
    });
}());

function add_coin() {
    let err = 0;
    let err_tag = $('.err_address');
    let addr = $('#c input[name="address"]').val();
    let id = $('#c input[name="id_coin"]').val();

    err_tag.html('');

    if(addr === ''){
        err_tag.append('<i style="color: red">write address</i>');
        err++;
    }

    $('#coin_select option:selected[value]').each(function (k, v) {
        if(v.value == 0){
            err++;
        }
    });

    if(err == 0){
        let data = $('#c').serializeArray();
        $.ajax({
            url: 'addcoin/add',
            type: 'post',
            data: data,
            success: function (response) {
                // setTimeout(function () {
                    window.location.replace('/');
                // }, 100)
            }
        });
    }
}

(function () {
    $('#enter').keydown(function (e) {
        if(e.keyCode === 13){
            $('#enter input[type="button"]').click();
        }
    })
}());
function enter() {
    let data = $('#enter').serializeArray();

    $.ajax({
        url: '/send',
        method: 'post',
        data: data,
        success: function (response) {
            if(response == true){
                $('#enter').css('display', 'none');
                $('#result').append('<a style="color: green">Perfect!</a>>');
                setTimeout(function () {
                    window.location.replace('/');
                },1000)
            }else{
                $('#result').append('<a style="color: red">Err!</a>>')
            }
            console.log(response)
        }
    })
}

function del_post(id) {
    let row = $('tr#row_'+id);
    let teg = $('tr#row_'+id+' td:eq(5)');
    let total = $('#total');


    // let s = function (n) {
    //     let m;
    //     n.each(function (k,v) {
    //         m = v.innerHTML;
    //     });
    //
    //     let reg = RegExp('[0-9]').exec(m);
    //     m = (reg['input'].replace(/\$/, ''));
    //     return m;
    // };
    //
    // let reg = RegExp('[0-9]').exec(total.html());
    // t = (reg['input'].replace(/\$/, ''));
    //
    // // total.html(round(t - s(teg)))
    //
    //
    //
    // console.log(s(teg));

    $.ajax({
        url: '/remove',
        type:'post',
        data: {id:id},
        success: function (response) {
            row.animate({
                height: 0
            }, 300,
            function(){
                row.remove();
            });
            total.html(response+' $')
            }
        });
    }

    (function post_open() {
        // $('.block_post').click(function () {
        //     let detale = $(this).children('.detale');
        //     detale.each(function (k, v) {
        //         if(v.attr())
        //     })
        // });
        console.log($('.block_post').attr('height'))
    }());


