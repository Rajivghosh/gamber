@extends('layouts.app_user')
@section('content')

<div class="row centered-form" style="margin-top: 20px">
	<div class="col-md-8">
		<div class="card">

			<div class="card-header">Register</div>

			<div class="card-body">
				<form id="regForm" action="" method="post">
					{{ csrf_field() }}
					<h1>Register:</h1>
					<!-- One "tab" for each step in the form: -->
					<div class="tab">
						<input type="text" name="username" id="username" class="form-control input-sm" value="{{ old('username') }}" placeholder="User name" oninput="this.className = ''">
						<p class="text-danger">{{ $errors->first('username') }}</p>

						<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="{{ old('email') }}" / oninput="this.className = ''">
						<p class="text-danger">{{ $errors->first('email') }}</p>

						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" oninput="this.className = ''" />
						<p class="text-danger">{{ $errors->first('password') }}</p>						

						<p><input  type="checkbox" name="age" value="Cats">Age 18 or Older</p>
						
						<p><input  type="checkbox" name="terms" value="Cats">Privacy Policy and terms of Use</p>
					</div>
					<div class="tab">
						
						<input type="text" name="first_name" id="first_name" class="form-control input-sm" value="{{ old('first_name') }}" placeholder="First name" oninput="this.className = ''">
						<p class="text-danger">{{ $errors->first('first_name') }}</p>

						<input type="text" name="last_name" id="last_name" class="form-control input-sm" value="{{ old('last_name') }}" placeholder="last name" oninput="this.className = ''">
						<p class="text-danger">{{ $errors->first('last_name') }}</p>

						<input type="text" name="address" id="address" class="form-control input-sm" value="{{ old('address') }}" placeholder="Address" oninput="this.className = ''">
						<p class="text-danger">{{ $errors->first('address') }}</p>

						<input type="text" name="city" id="city" class="form-control input-sm" value="{{ old('city') }}" placeholder="City" oninput="this.className = ''" >
						<p class="text-danger">{{ $errors->first('city') }}</p>

						<input type="text" name="state" id="state" class="form-control input-sm" value="{{ old('state') }}" placeholder="State" oninput="this.className = ''" />
						<p class="text-danger">{{ $errors->first('state') }}</p>

						<input type="text" name="country" id="country" class="form-control input-sm" value="{{ old('country') }}" placeholder="country" oninput="this.className = ''" />
						<p class="text-danger">{{ $errors->first('country') }}</p>

						<input type="text" name="zipcode" id="zipcode" class="form-control input-sm" value="{{ old('zipcode') }}" placeholder="zipcode" oninput="this.className = ''" />
						<p class="text-danger">{{ $errors->first('zipcode') }}</p>

						<input type="text" name="contact_no" id="contact_no" class="form-control input-sm" value="{{ old('contact_no') }}" placeholder="1234567890" oninput="this.className = ''" />
						<p class="text-danger">{{ $errors->first('contact_no') }}</p>

						<input type="text" class="form-control input-sm" placeholder="dd" oninput="this.className = ''" id="dob" name="dob">
						<p class="text-danger">{{ $errors->first('dob') }}</p>
						

					</div>

					<div style="overflow:auto;">
						<div style="float:right;">
							<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
							<button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
						</div>
					</div>
					<!-- Circles which indicates the steps of the form: -->
					<div style="text-align:center;margin-top:40px; display: none;">
						<span class="step"></span>
						<span class="step"></span>						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<style>
	
	#regForm {
		background-color: #ffffff;
		margin: 100px auto;
		font-family: Raleway;
		padding: 40px;
		width: 70%;
		min-width: 300px;
	}

	h1 {
		text-align: center;  
	}

	input {
		padding: 10px;
		width: 100%;
		font-size: 17px;
		font-family: Raleway;
		border: 1px solid #aaaaaa;
	}

	/* Mark input boxes that gets an error on validation: */
	input.invalid {
		background-color: #ffdddd;
	}

	/* Hide all steps by default: */
	.tab {
		display: none;
	}

	button {
		background-color: #4CAF50;
		color: #ffffff;
		border: none;
		padding: 10px 20px;
		font-size: 17px;
		font-family: Raleway;
		cursor: pointer;
	}

	button:hover {
		opacity: 0.8;
	}

	#prevBtn {
		background-color: #bbbbbb;
	}

	/* Make circles that indicate the steps of the form: */
	.step {
		height: 15px;
		width: 15px;
		margin: 0 2px;
		background-color: #bbbbbb;
		border: none;  
		border-radius: 50%;
		display: inline-block;
		opacity: 0.5;
	}

	.step.active {
		opacity: 1;
	}

	/* Mark the steps that are finished and valid: */
	.step.finish {
		background-color: #4CAF50;
	}
</style>
<script type="text/javascript">
	var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
  	document.getElementById("prevBtn").style.display = "none";
  } else {
  	document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
  	document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
  	document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
	var email = document.getElementById('email').value;
	/*var checkdata = echeckExistEmail(email);
	alert(checkdata);*/

	$.ajax({

				type: 'post',
				url: "{{ url('/user/echeckExistEmail') }}",
				async:false,
				data: {
					 _token: "{{csrf_token()}}",
					'email': email
				},
				success: function(data) {
					console.log(data.exist);
					if(data.exist==0){
						var x = document.getElementsByClassName("tab");
					  // Exit the function if any field in the current tab is invalid:
					  if (n == 1 && !validateForm()) return false;
					  // Hide the current tab:
					  x[currentTab].style.display = "none";
					  // Increase or decrease the current tab by 1:
					  currentTab = currentTab + n;
					  // if you have reached the end of the form...
					  if (currentTab >= x.length) {
					    // ... the form gets submitted:
					    document.getElementById("regForm").submit();
					    return false;
					}
					  // Otherwise, display the correct tab:
					  showTab(currentTab);
					}
				}
			});

  // This function will figure out which tab to display
  
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
  }
}
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
  	document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
  	x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

@endsection
