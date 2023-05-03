<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JQuery Practice</title>
    <link rel="stylesheet" href="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>

<h1 class="header" style="text-align: center" >Multiple Row</h1>

<div class="container">
    <div class="row">
        <form method="POST" action="{{ route('product.sale') }}">
            @csrf
            <div class="col-md-8">
                <table class="table" id="table">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="insertRow">
                    <tr>
                        <td>
                            <select name="category[]" class="category">
                                <option value="">Select Category</option>
                                @foreach($categories as $id => $title)
                                    <option value="{{ $id }}">{{ $title }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <select name="product[]" class="selectProduct">
                                <option value="">Select Product</option>
                            </select>
                        </td>
                        <td>
                            <input class="unit" type="text" placeholder="Enter Unit" name="unit[]" id="">
                        </td>
                        <td>
                            <input class="price" type="text" placeholder="Enter Price" name="price[]" id="">
                        </td>
                        <td>
                            <button id="add" class="btn btn-primary">Add</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="btn">
                    <button type="submit" class="btn btn-success" id="save"> Save Data </button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    var i = 0;
    $('#add').click(function (e){
        e.preventDefault();
        i++;
        $('#insertRow').append(
            `<tr>
                <td>
                        <select name="category[]" class="category">
                            <option value="">Select Category</option>
                            @foreach($categories as $id => $title)
                                <option value="{{ $id }}">{{ $title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                            <select name="product[]" class="selectProduct">
                                <option value="">Select Product</option>
                            </select>
                        </td>
                        <td>
                            <input class="unit" type="text" placeholder="Enter Unit" name="unit[]" id="">
                        </td>
                        <td>
                            <input class="price" type="text" placeholder="Enter Price" name="price[]" id="">
                        </td>
                <td>
                    <button type="button" class="remove" class="btn btn-danger remove-table-row">Remove</button>
                </td>
            </tr>`);

        $('#table').on('click','.remove', function(){
            $(this).closest('tr').remove();
        });
    });
    //ajax setup
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $(document).on('change', '.category', function (){
        var categoryId = $(this).val();
        // alert(categoryId);
        var productRow = $(this).closest('tr').find('.selectProduct');
        $.ajax({
            type: "get",
            url: "/sales/category-product/" + categoryId,
            dataType: "json",
            success: function (response) {
                productRow.empty();
                if(response.status=="ok"){
                    $.each(response.data, function(index, item) {
                        productRow.append(`<option value="${item.id}">${item.title}</option>`);
                    });
                }
            }
        });
    });

    $('.product').on('change',function (){
        var productId = $(this).val();
        var unitRow = $(this).closest('tr').find('.unit');
        $.ajax({
            type: "get",
            url: "/sales/product-detail/" + productId,
            dataType: "json",
            success: function (response) {
                unitRow.empty();
                if(response.status=="ok"){
                    unitRow.val(response.data.unit);
                }
            }
        });
    });
</script>

</body>
</html>
