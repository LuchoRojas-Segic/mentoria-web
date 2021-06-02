<h1>Register</h1>
<form method="POST">
  <div class="mb-3">
    <label class="form-label">Firstname</label>
    <input type="text" name = "firstname" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Lastname</label>
    <input type="text" name = "lastname" class="form-control">
  </div> 
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name = "email" class="form-control">
  </div>  
  <div class="mb-3">
    <label class="form-label">Password</label>
    <textarea type="password" name="password" class="form-control">     
  </div>
  <div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <textarea type="password" name = "confirmPassword" class="form-control">     
  </div>  

  <button type="submit" class="btn btn-primary">Save</button>
</form>