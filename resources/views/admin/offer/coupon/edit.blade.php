<form action="{{ route('coupon.update',$coupon->id) }}" method="Post" id="add-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
          <label for="coupon_code">Coupon Code</label>
          <input type="text" id="coupon_code" class="form-control"  name="coupon_code" required="" placeholder="Coupon Code" value="{{$coupon->coupon_code}}">
        </div> 
        <div class="form-group">
          <label for="type">Coupon Type</label>
          <select name="type" class="form-control" id="type">
              <option value="Fixed" {{ ($coupon->type == 'Fixed') ? 'selected': '' }}>Fixed</option>
              <option value="Percentage" {{ ($coupon->type == 'Percentage') ? 'selected': '' }}>Percentage</option>
          </select>
        </div> 
        <div class="form-group">
          <label for="amount">Amount</label>
          <input type="text" id="amount" class="form-control"  name="amount" required="" placeholder="Amount" value="{{$coupon->amount}}">
        </div> 
        <div class="form-group">
          <label for="valid_date">Valid Date</label>
          <input type="date" id="valid_date" class="form-control"  name="valid_date" required="" placeholder="valid_date" value="{{$coupon->valid_date}}">
        </div> 
        <div class="form-group">
          <label for="status">Coupon Status</label>
          <select name="status" class="form-control" id="status">
              <option value="Active" {{ ($coupon->status == 'Active') ? 'selected': '' }}>Active</option>
              <option value="Inactive" {{ ($coupon->status == 'Inactive') ? 'selected': '' }}>Inactive</option>
          </select>
        </div> 
    </div>
    <div class="modal-footer">
      <button type="Submit" class="btn btn-primary"> <span class="loading d-none"> Loading....</span> Submit</button>
    </div>
    </form>