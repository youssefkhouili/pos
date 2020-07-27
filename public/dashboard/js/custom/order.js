$(document).ready(function() {
    $('.add-product-btn').on('click', function(e) {
        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'), 2);

        $(this).removeClass('btn-success').addClass('btn-default disabled')

        var orderBody = `
            <tr>
                <td>${name}</td>
                <td>
                    <input type="number" name="quantities[]" class="form-control input-sm product-quantity" data-price="${price}" min="1" max="20" value="1"/>
                </td>
                <td class="product-price">${price}</td>
                <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><i class="fas fa-trash"></i></button></td>
            </tr>
        `

        $('.order-list').append(orderBody)

        $('body').on('click', '.disabled', function(e) {
            e.preventDefault();
        })


        $('body').on('click', '.remove-product-btn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $(this).closest('tr').remove();
            $(`#product-${id}`).removeClass('btn-default disabled').addClass('btn-success')
            calculateTotal()
        })

        $('body').on('keyup change', '.product-quantity', function() {
            var quantity = $(this).val();
            var price = $(this).data('price');
            $(this).closest('tr').find('.product-price').html($.number(quantity * price, 2))
            calculateTotal();

        });



        calculateTotal()
    });

});

function calculateTotal() {

    var price = 0;

    $('.order-list .product-price').each(function() {

        price += parseFloat($(this).html().replace(/,/g, ''));

    })

    $('.total-price').html($.number(price, 2))

    if (price > 0) {
        $('#add-order-form-btn').removeClass('disabled')
    }
    else {
        $('#add-order-form-btn').addClass('disabled')
    }

}
