
 $('.adddob, .editdob').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
  }).on('change', function(e){
   	var selectedDob = $(this).val();  

   var age =  ageCalculator(selectedDob);
    $('#age').val(age);
    $('.editage').val(age);
  });


$( document ).ready( function () {

	////////////// Application form validation ////////////////////
	$( "#application_frm" ).validate( {
		rules: {
			name: {
				required: true,
				minlength: 2,
				maxlength: 50
			},
			mobile: {
				required: true,
				minlength: 10,
				maxlength: 13
			},
			email: {
				required: true,
				email: true,
			},
			fathername: "required",
			mothername: "required",
			state: "required",
			city: "required",			
			address: {
				required: true,
				minlength: 5
			},
			gender: "required",
			courses: "required",
			age: "required",
			
		},
		messages: {
			name:{
				required: "Please enter name",
				minlength: "Name must consist of at least 2 characters",
				maxlength: "Name must note be more than 50 characters long",
			},
			mobile:{
				required: "Please enter mobile",
				minlength: "Mobile must consist of at least 10 digit",
				maxlength: "Mobile must note be more than 13 digit long",
			},
			email: "Please enter a valid email address",
			fathername: "Please enter mother name",
			mothername: "Please enter father name",
			state: "Please select state",
			city: "Please select city",
			address:{
				required: "Please enter address",
				minlength: "Address must consist of at least 5 characters"
			},
			gender: "Please select gender",
			courses: "Please select course",
			age: "Please enter age",
			
		},
		errorElement: "span",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );

			if ( element.prop( "type" ) === "radio" ) {
				error.insertAfter( element.parent( "form-radio" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".row" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".row" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function () {
			$('#message').html('');
			$('#add_e_message').html('');
			var gender = $("input[name='gender']:checked").val();
			$.post('http://localhost/Aotsum/model.php',{ch:5,name:$('#name').val(),mobile:$('#mobile').val(),email:$('#email').val(),fathername:$('#fathername').val(),mothername:$('#mothername').val(),state:$('#state').val(),city:$('#city').val(),address:$('#address').val(),gender:gender,courses:$('#courses').val(),age:$('#age').val(),dob:$('#dob').val()},
                function (callback) {
                	console.log(callback);
					if(callback==1)
					{				
					$('#addModal').modal('hide');	
					$('#message').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><strong>Success!</strong> Data inserted successfully</div>');  
					$('#application_frm')[0].reset();
					$('#comments-list').html(callback);	
					}
					else if(callback==2)
					{
						$('#add_e_message').html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><strong>Error!</strong> Try submitting again.</div>');  	
					}
					else{
						$('#add_e_message').html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><strong>Error!</strong> all * fields are required !</div>'); 	
					}
					
					get_applicants();				
					
				
                }) 
	        return false;
		}
	} );
	//////////////////////

	////////////// Application form validation ////////////////////
	$( "#update_application_frm" ).validate( {
		rules: {
			name: {
				required: true,
				minlength: 2,
				maxlength: 50
			},
			mobile: {
				required: true,
				minlength: 10,
				maxlength: 13
			},
			email: {
				required: true,
				email: true,
			},
			fathername: "required",
			mothername: "required",
			state: "required",
			city: "required",			
			address: {
				required: true,
				minlength: 5
			},
			gender: "required",
			courses: "required",
			age: "required",
			
		},
		messages: {
			name:{
				required: "Please enter name",
				minlength: "Name must consist of at least 2 characters",
				maxlength: "Name must note be more than 50 characters long",
			},
			mobile:{
				required: "Please enter mobile",
				minlength: "Mobile must consist of at least 10 digit",
				maxlength: "Mobile must note be more than 13 digit long",
			},
			email: "Please enter a valid email address",
			fathername: "Please enter mother name",
			mothername: "Please enter father name",
			state: "Please select state",
			city: "Please select city",
			address:{
				required: "Please enter address",
				minlength: "Address must consist of at least 5 characters"
			},
			gender: "Please select gender",
			courses: "Please select course",
			age: "Please enter age",
			
		},
		errorElement: "span",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );

			if ( element.prop( "type" ) === "radio" ) {
				error.insertAfter( element.parent( "form-radio" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".row" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".row" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function () {
			$('#message').html('');
			$('#add_e_message').html('');
			var gender = $("input[name='gender']:checked").val();

			$.post('http://localhost/Aotsum/model.php',{ch:9,name:$('.editname').val(),mobile:$('.editmobile').val(),email:$('.editemail').val(),fathername:$('.editfathername').val(),mothername:$('.editmothername').val(),state:$('.editstate').val(),city:$('.editcity').val(),address:$('.editaddress').val(),gender:gender,courses:$('.editcourses').val(),age:$('.editage').val(),dob:$('.editdob').val(),appid:$('#appid').val()},
                function (callback) {
                	console.log(callback);
					if(callback==1)
					{				
					$('#updateModal').modal('hide');	
					$('#message').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><strong>Success!</strong> Data inserted successfully</div>');  
					$('#update_application_frm')[0].reset();
					}
					else
					{
						$('#edit_e_message').html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><strong>Error!</strong> Try submitting again.</div>');  	
					}	
					get_applicants();	
				
                }) 
	        return false;
		}
	} );
	//////////////////////


});


$(function() {
   	function get_state()
   	{
		$.post('http://localhost/Aotsum/model.php',{ch:1},
        function (data) {
			var dataObj = JSON.parse(data)
			var s = '<option value="">- Select State -</option>';  
		for (var i = 0; i < dataObj.length; i++) {  

			s += '<option value="' + dataObj[i].id + '">' + dataObj[i].name + '</option>';  
		}  
		$("#state").html(s);  
		$(".editstate").html(s);
		
        })   
	}
    
    get_state();

    $('#state').change(function() {
    	var state_id = $('option:selected', this).val();
    	$.post('http://localhost/Aotsum/model.php',{ch:2,state_id:state_id},
        function (data) {
			var dataObj = JSON.parse(data)
			var s = '<option value="">- Select City -</option>';  
		for (var i = 0; i < dataObj.length; i++) {  

			s += '<option value="' + dataObj[i].id + '">' + dataObj[i].name + '</option>';  
		}  
		$("#city").html(s);  
		$(".editcity").html(s);

		
        })   
    })

    $('.editstate').change(function() {
    	var state_id = $('option:selected', this).val();
    	$.post('http://localhost/Aotsum/model.php',{ch:2,state_id:state_id},
        function (data) {
			var dataObj = JSON.parse(data)
			var s = '<option value="">- Select City -</option>';  
		for (var i = 0; i < dataObj.length; i++) {  

			s += '<option value="' + dataObj[i].id + '">' + dataObj[i].name + '</option>';  
		}    
		$(".editcity").html(s);

		
        })   
    })

    function get_courses()
   	{
		$.post('http://localhost/Aotsum/model.php',{ch:3},
        function (data) {
			var dataObj = JSON.parse(data)
			var s = '<option value="">- Select Course -</option>';  
		for (var i = 0; i < dataObj.length; i++) {  

			s += '<option value="' + dataObj[i].id + '">' + dataObj[i].name + '</option>';  
		}  
		$("#courses").html(s);
		$(".editcourses").html(s);  
		
        })   
	}
    
    get_courses();

     $('#courses').change(function() {
    	var course_id = $('option:selected', this).val();
    	$.post('http://localhost/Aotsum/model.php',{ch:4,course_id:course_id},
        function (data) {
			var dataObj = JSON.parse(data)
			if(dataObj.length>0){
				var s = '<thead class="thead-dark"><tr><th scope="col">Year</th><th scope="col">Fee</th><th scope="col">Consession</th><th scope="col">Total</th></tr><thead><tbody>';  
				for (var i = 0; i < dataObj.length; i++) {  
					s += '<tr><th scope="row">' + dataObj[i].year + '</th><td>' + dataObj[i].fees + '</td><td>' + dataObj[i].consession + '</td><td>' + (dataObj[i].fees- dataObj[i].consession ) + '</td></tr>';
					 
				}  
					s += '</tbody></table>';

				$("#courses_details_tbl").html(s);  
			}
			else{
				$("#courses_details_tbl").html('');
			}
        })   
    })


     

    //close whole function

});
function get_applicants()
   	{
		$.post('http://localhost/Aotsum/model.php',{ch:6},
        function (data) {
        	$("#applicant_tbl").html(data);		
        })   
	}
    
get_applicants();

$(document).on("click", ".delete", function(e){
    e.preventDefault();			
	if(window.confirm('Are you sure want to delete this applicant'))
	{
		var delete_id = $(this).attr('value'); 
	
		$.ajax({
			url: 'http://localhost/Aotsum/model.php',
			type: 'post',
			data:{ch:7,delete_id:delete_id},
			success: function(response){
				get_applicants();
				$('#message').html(response);
			}
		});				
	}
	else
	{
		return false;
	}
}); 

$(document).on('click','#edit', function(e){
			
	e.preventDefault();
	
	var edit_id = $(this).attr('value');
	
	$.ajax({
		url: 'http://localhost/Aotsum/model.php',
		type: 'post',
		data: {ch:8,edit_id:edit_id},
		success: function(response){
			var dataObj = JSON.parse(response)
			console.log(dataObj);
			$('.editname').val(dataObj.name);

			$('.editmobile').val(dataObj.mobile);
			$('.editemail').val(dataObj.email);
			$('.editfathername').val(dataObj.father_name);
			$('.editmothername').val(dataObj.mother_name);
			$('.editaddress').val(dataObj.address);
			$('.editdob').val(dataObj.dob);
			$('.editage').val(dataObj.age);
			$('.editstate').val(dataObj.state_id);
			$('.editcity').val(dataObj.city_id);
			$('.editcourses').val(dataObj.course);
			$('#appid').val(dataObj.id);
			if(dataObj.gender =='male'){
				$('#editmale').attr('checked',true);
			}else
			{
				$('#editfemale').attr('checked',true);

			}
			$('#updateModal').modal('show');	

		}
	});
			
});
			
  
function ageCalculator(selectedDob) { 
	const birthDate = new Date(selectedDob);

	var d1 = birthDate.getDate();
	var m1 = 1 + birthDate.getMonth();
	var y1 = birthDate.getFullYear();

	var date = new Date();
	var d2 = date.getDate();
	var m2 = 1 + date.getMonth();
	var y2 = date.getFullYear();
	var month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

	if(d1 > d2){
	d2 = d2 + month[m2 - 1];
	m2 = m2 - 1;
	}
	if(m1 > m2){
	m2 = m2 + 12;
	y2 = y2 - 1;
	}
	var d = d2 - d1;
	var m = m2 - m1;
	var y = y2 - y1;


	console.log('Age is '+y+' Years '+m+' Months '+d+' Days');
	return y+' Years '+m+' Months '+d+' Days';

}  