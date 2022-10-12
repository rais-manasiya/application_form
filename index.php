<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>Application Form using PHP OOP PDO MySQL and Ajax</title>
		
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>

	<body>
	
	<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          
          <a class="navbar-brand" href="#">Aotsum</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">New Application</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add New Application</button>						
				<div id="message"></div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" style="margin-top:20px;" id="applicant_tbl">				
				</table>
				</div>			
			</div>	
		</div>						
	</div>	
	</div>
	
	<!-- Add Modal Start-->
	
	<div class="modal fade" id="addModal">
	  <div class="modal-dialog  modal-lg">
	  	<form id="application_frm" method="post" action="javascript:void(0)">

		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Admission Form</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">
			<div id="add_data">
			<div class="form-row">
					<div class="form-group col-md-6">
					<label for="name">Name*</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Name">
					</div>
					<div class="form-group col-md-6">
					<label for="mobile">Mobile*</label>
					<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
					<label for="email">Email ID*</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email">
					</div>
					<div class="form-group col-md-6">
					<label for="fathername">Father's Name</label>
					<input type="text" class="form-control" id="fathername" name="fathername" placeholder="Father's Name">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="mothername">Mother's Name</label>
						<input type="text" class="form-control" id="mothername" name="mothername" placeholder="Mother's Name">
					</div>
					<div class="form-group col-md-6">
						<label for="address">Address</label>
						<input type="textarea" class="form-control" id="address" name="address" placeholder="Address" size="10">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="state">State*</label>
						<select id="state" name="state" class="form-control">
							<option value="" selected> - Select State -</option>
						</select>
					</div>	
					<div class="form-group col-md-6">
						<label for="city">City*</label>
						<select id="city" name="city" class="form-control">
							<option value="" selected> - Select City -</option>
						</select>
					</div>
					
				</div>

				<div class="form-row">
					
					<div class="form-group col-md-6">
						<label for="dob">DOB*</label>
						<input id="dob"  class="form-control adddob"  name="dob" placeholder="select date" />

					</div>	
					<div class="form-group col-md-6">
						<label for="age">Age*</label>
						<input type="text" class="form-control" id="age" name="age" placeholder="Y M D" readonly="readonly">
					</div>
					
				</div>

				<div class="form-row">
					<div class="form-group  col-md-6">
					<label for="gender">Gender</label>

						<div class="form-radio">
						<input class="form-radio-input" type="radio" id="male" name="gender" value="male"  checked>
						<label class="form-radio-label" for="male">
							Male
						</label>&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="form-radio-input" type="radio" id="female" name="gender" value="female">
						<label class="form-radio-label" for="female">
							Female
						</label>
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="state">Course*</label>
						<select id="courses" name="courses" class="form-control">
							
						</select>
					</div>
				</div>
			<div class="table-responsive">
				<table class="table" style="margin-top:20px;" id="courses_details_tbl">
				
				</table>
			</div>
			

			</div>
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
		  			  	<div id="add_e_message"></div>

<!-- 			<button type="reset" class="btn btn-danger align-left" data-dismiss="modal">Close</button>
 -->			<button type="submit" id="btn_add" class="btn btn-success">Submit</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	

<!-- Update Modal Start-->
	
	<div class="modal fade" id="updateModal">
	  <div class="modal-dialog  modal-lg">
	  	<form id="update_application_frm" method="post" action="javascript:void(0)">

		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Update Applicant</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">
			<div id="add_data">
			<div class="form-row">
					<div class="form-group col-md-6">
					<label for="name">Name*</label>
					<input type="text" class="form-control editname" id="name" name="name" placeholder="Name">
					</div>
					<div class="form-group col-md-6">
					<label for="mobile">Mobile*</label>
					<input type="text" class="form-control editmobile" id="mobile" name="mobile" placeholder="Mobile">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
					<label for="email">Email ID*</label>
					<input type="email" class="form-control editemail" id="email" name="email" placeholder="Email">
					</div>
					<div class="form-group col-md-6">
					<label for="fathername">Father's Name</label>
					<input type="text" class="form-control editfathername" id="fathername" name="fathername" placeholder="Father's Name">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="mothername">Mother's Name</label>
						<input type="text" class="form-control editmothername" id="mothername" name="mothername" placeholder="Mother's Name">
					</div>
					<div class="form-group col-md-6">
						<label for="address">Address</label>
						<input type="textarea" class="form-control editaddress" id="address" name="address" placeholder="Address" size="10">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="state">State*</label>
						<select id="state" name="state" class="form-control editstate">
							<option value="" selected> - Select State -</option>
						</select>
					</div>	
					<div class="form-group col-md-6">
						<label for="city">City*</label>
						<select id="city" name="city" class="form-control editcity">
							<option value="" selected> - Select City -</option>
						</select>
					</div>
					
				</div>

				<div class="form-row">
					
					<div class="form-group col-md-6">
						<label for="dob">DOB*</label>
						<input id="dob"  class="form-control editdob"  name="dob" placeholder="select date" />

					</div>	
					<div class="form-group col-md-6">
						<label for="age">Age*</label>
						<input type="text" class="form-control editage" id="age" name="age" placeholder="Y M D" readonly="readonly">
					</div>
					
				</div>

				<div class="form-row">
					<div class="form-group  col-md-6">
					<label for="gender">Gender</label>

						<div class="form-radio">
						<input class="form-radio-input" type="radio" id="editmale" name="gender" value="male">
						<label class="form-radio-label" for="editmale">
							Male
						</label>&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="form-radio-input" type="radio" id="editfemale" name="gender" value="female">
						<label class="form-radio-label" for="editfemale">
							Female
						</label>
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="state">Course*</label>
						<select id="courses" name="courses" class="form-control editcourses">
							
						</select>
					</div>
				</div>
			<div class="table-responsive">
				<table class="table" style="margin-top:20px;" id="courses_details_tbl">
				
				</table>
			</div>
			

			</div>
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
		  	<div id="edit_e_message"></div>
			<button type="submit" id="btn_add" class="btn btn-success">Submit</button>
		  </div>
		  <input type="hidden" id="appid" name="appid" value="">
		  <input type="hidden" id="ch" name="ch" value="9">

		  </form>
		</div>
	  </div>
	</div>
	
	
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /><script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	
	</body>
</html>

