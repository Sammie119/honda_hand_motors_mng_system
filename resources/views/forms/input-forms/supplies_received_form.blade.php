<form action="store_supply" method="POST" autocomplete="off">
    @csrf
    @isset($supply)
        <input type="hidden" name="id" value="{{ $supply->supply_id }}" />
    @endisset

    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <label for="recipient-name" class="control-label">Items</label>
                <input type="text" placeholder="Select items" list="items_list" class="form-control form-control-border bg-white" id="items">
                <datalist id="items_list">
                  @foreach ($items as $item)      
                      <option value="{{ $item->item }}">
                  @endforeach
                </datalist>
            </div>
            <div class="col-3"> 
              <label for="recipient-name" class="control-label">Action:</label><br>
              <button type="button" class="btn btn-success add-all-input"> <i class="fa fa-plus"></i> Add New</button> 
            </div>
        </div>
    </div>
      
      
      
  {{-- </ul> --}}
  
  <div class="row mt-2">
      <div class="col-md-5">Description</div>
      <div class="col-md-2" style="text-align: center">Stock Qty</div>
      <div class="col-md-2" style="text-align: center">Restock Qty</div>
      <div class="col-md-2" style="text-align: center">Amount</div>
      <div class="col-md-1">Action</div>
  </div>
  
  <hr>

  <div class="products getTotalAmount">  
      @if (isset($supply))
          @foreach ($supply->item_id as $key => $item)
            @php
                $getItem = App\Models\Item::select('stock', 'item')->where('item_id', $item)->first();
            @endphp
            <div class="row mt-2">
                <div class="row mt-2">
                    <div class="col-md-5">
                        <select class="form-control form-control-border bg-white" name="items_id[]" placeholder=" " style="height: 35px;"><option value="{{ $item }}">{{ $getItem->item }}</option></select>
                    </div>
                    <div class="col-md-2">
                        <input value="{{ $supply->old_stock[$key] }}" class="form-control form-control-border bg-white stock" name="old_stock[]" type="number" placeholder=" " style="height: 35px; padding: 0px; text-align: right" readonly>
                    </div>
                    <div class="col-md-2">
                        <input value="{{ $supply->new_stock[$key] }}" class="form-control form-control-border bg-white quantity" name="new_stock[]" type="number" step="1" min="1" required placeholder=" " style="height: 35px; padding: 0px; text-align: right" >
                    </div>
                    <div class="col-md-2">
                        <input value="{{ $supply->amount[$key] }}" class="form-control form-control-border bg-white sub_total" name="amount[]" type="number" step="0.01" min="0" required placeholder=" " style="height: 35px; padding: 0px; text-align: right" >
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger bottn_delete">Del</button>
                    </div>
                </div>
            </div> 
          @endforeach

          <div class="row mt-2 add-input" style="display: none">
              <div class="col-md-12">
                  No data Found
              </div>
          </div>
      @else
          <div class="row mt-2 add-input">
              <div class="col-md-12">
                  No data Found
              </div>
          </div>
      @endif
      
  </div>
    <div class="row mt-2 add-input">
        <div class="col-md-9" style="text-align: right">
            <strong>Total Amount:</strong>
        </div>
        <div class="col-md-2">
            <input type="text" value="{{ (isset($supply)) ? number_format(array_sum($supply->amount), 2) : null }}" class="form-control form-control-border bg-white total_amount" name="" id="" style="height: 35px; text-align: right; font-weight: bolder" readonly>
        </div>
    </div>

    <hr>

    {{-- <div class="row mb-3">
        <div class="col-10">
            <div class="form-floating mb-3 mb-md-0">
                <input type="text" placeholder="Select items" value="{{ (isset($supply)) ? $supply->item_name->item : null }}" list="items_list" class="form-control form-control-border bg-white" name="item" id="items" required>
                <datalist id="items_list">
                    @foreach ($items as $item)
                        <option value="{{ $item->item }}">
                    @endforeach
                  </datalist>
                <label>Item</label>
            </div>                
        </div>
        <div class="col-2">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->old_stock : null }}" name="old_stock" id="old_stock" type="text" readonly placeholder=" " />
                <label>Stock</label>
            </div>
        </div>
    </div> --}}

    <div class="row mb-3">
        {{-- <div class="col-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->new_stock : null }}" name="new_stock" type="number" min="1" required placeholder=" " />
                <label>Restock Quantity</label>
            </div>
        </div> --}}
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="supplier_id" required >
                    <option value="" disabled selected>Supplier Name</option>
                    @foreach (App\Models\Supplier::orderBy('supplier_name')->get() as $supplier)
                        <option @if(isset($supply) && ($supply->supplier_id === $supplier->supplier_id)) selected @endif value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</option>
                    @endforeach
                </select>
                <label>Supplier Name</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->total_amount : null }}" name="total_amount" id="amount" type="number" step="0.01" min="1" required placeholder=" " />
                <label>Amount To Pay</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->paid : null }}" name="amount_paid" id="amount_paid" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Amount Paid</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->total_amount - $supply->paid : null }}" name="balance" id="balance" type="text" readonly placeholder=" " />
                <label>Balance</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->receipt_no : null }}" name="receipt_no" type="number" required placeholder=" " />
                <label>Receipt Number</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->sup_date : date('Y-m-d') }}" max="{{ date('Y-m-d') }}" name="sup_date" type="date" required placeholder=" " />
                <label>Date</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>

<script>

    $('#amount_paid').bind('change',function(){ 
        var amount = parseFloat($('#amount').val());
        var amount_paid = parseFloat($(this).val());

        $('#balance').val((amount - amount_paid).toFixed(2));
        
        // console.log(arr[k]); 
    });

    $(function(){
        $(".add-all-input").on("click", function(){
            var items = $('#items').val();
            
            // Array for all labs to check if labs exists
            var items_array = [];

            items_array.push(<?=$item_array ?>);

            if(items == ''){
                alert('Empty items Selected');
            } else if(items_array[0].includes(items)){

                $.ajax({
                    type:'GET',
                    url:"get-item-info",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        items
                        },
                    success:function(data) {
                        if($(".products").length < 10){
                            $(".products").append(
                                `<div class="row mt-2">
                                    <div class="col-md-5">
                                        <select class="form-control form-control-border bg-white" name="items_id[]" placeholder=" " style="height: 35px;"><option value="${data.item_id}">${items}</option></select>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control form-control-border bg-white stock" name="old_stock[]" type="number" value="${data.stock}" placeholder=" " style="height: 35px; padding: 0px; text-align: right" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control form-control-border bg-white quantity" name="new_stock[]" type="number" step="1" min="1" required placeholder=" " style="height: 35px; padding: 0px; text-align: right" >
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control form-control-border bg-white sub_total" name="amount[]" type="number" step="0.01" min="0" required placeholder=" " style="height: 35px; padding: 0px; text-align: right" >
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger bottn_delete">Del</button>
                                    </div>
                                </div>`
                            );
                            
                        }
                        
                    }
                });
                
                console.log('TRUE');
                document.querySelector('.add-input').style.display='none';
    
            } else {
                console.log('FALSE');
                alert('Selected Item is not on the List');
            }

            $('#items').val('');
            
        });
    });

     // Add all amounts
    function TotalAmount(){
        var totalAmount = 0;
        $('.sub_total').each(function(i, e){
            var s_total = $(this).val() - 0;

            totalAmount += s_total;
        });

        $('.total_amount').val(totalAmount.toFixed(2));
        $('#amount').val(totalAmount.toFixed(2));
    }

    $('.getTotalAmount').delegate('.sub_total', 'keyup', function(){
        var div = $(this).parent().parent();
        var qty = div.find('.sub_total').val() - 0;
        TotalAmount();
    });

    // delete row and subtract from total amount
    $('.getTotalAmount').delegate('.bottn_delete', 'click', function(){
        var div = $(this).parent().parent();
        var sub_total = div.find('.sub_total').val() - 0;
        var total_amount = $('.total_amount').val() - 0;
        var new_total = total_amount - sub_total;

        $('.total_amount').val(new_total.toFixed(2));
        //  alert(price);
        div.remove();
    });


</script>