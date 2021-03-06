 @php
     $user = Auth::user();
 @endphp

 <div class="col-md-2">
     <br>
     <img class="card-img-top" style="border-radius:50%;"
         src="{{ !empty($user->profile_photo_path) ? url('upload/user_images/' . $user->profile_photo_path) : url('upload/no_image.jpg') }}"
         alt="image" height="100%" width="100%">
     <br> <br>
     <ul class="list-group list-group-flush">
         <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
         <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
         <a href="{{ route('user.order.index') }}" class="btn btn-primary btn-sm btn-block">Order</a>
         <a href="{{ route('user.order.return.list') }}" class="btn btn-primary btn-sm btn-block">Return Order</a>
         <a href="{{ route('user.order.cancel.list') }}" class="btn btn-primary btn-sm btn-block">Cancel Order</a>
         <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
         <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block ">Logout</a>

     </ul>
 </div>
