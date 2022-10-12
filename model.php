<?php 
error_reporting(0);
	Class Model
	{
		private $host = 'localhost';
		private $username = 'root';
		private $password = '';
		private $database = 'aotsum';
		private $connection;

		//create connection
		public function __construct()
		{
			try 
			{
				$this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", 
											$this->username, $this->password);
			} 
			catch (PDOException $e) 
			{
				echo "Connection error " . $e->getMessage();
			}
		}


		function get_state()
		{
			$data = null;

			$state_stmt = $this->connection->prepare('SELECT id,name FROM state order by name');
			$state_stmt->execute();
			
			$data = $state_stmt->fetchAll();
						
			return json_encode($data);
		}

		function get_city($state_id)
		{
			$data = null;

			$city_stmt = $this->connection->prepare('SELECT id,name FROM city WHERE state_id = :state_id order by name');
			$city_stmt->bindParam(':state_id',$state_id);
			
			$city_stmt->execute();
			
			$data = $city_stmt->fetchAll(); 
			
			return json_encode($data);
		}

		function get_courses()
		{
			$data = null;

			$state_stmt = $this->connection->prepare('SELECT id,name FROM courses where status =? order by id');
			$state_stmt->execute([1]);
			
			$data = $state_stmt->fetchAll();
						
			return json_encode($data);
		}

		function get_course_details($course_id)
		{
			$data = null;

			$city_stmt = $this->connection->prepare('SELECT c.name,cd.* FROM courses_details as cd JOIN courses as c ON cd.course_id = c.id WHERE cd.course_id = :course_id order by c.id');
			$city_stmt->bindParam(':course_id',$course_id);
			
			$city_stmt->execute();
			
			$data = $city_stmt->fetchAll(); 
			
			return json_encode($data);
		}

		function insert_applications($post)
		{
			if(isset($post['ch']))
			{
				if(isset($post['name']) && isset($post['mobile']) && isset($post['email']) && isset($post['fathername']) && isset($post['mothername']) && isset($post['state']) && isset($post['city']) && isset($post['address']) && isset($post['courses']) && isset($post['age']))
				{
					if(!empty($post['name']) && !empty($post['mobile']) && !empty($post['email']) && !empty($post['fathername']) && !empty($post['mothername']) && !empty($post['state']) && !empty($post['city']) && !empty($post['address']) && !empty($post['courses']) && !empty($post['age']))
					{
						
						$name = $post['name'];
						$mobile = $post['mobile'];
						$email = $post['email'];
						$fathername = $post['fathername'];
						$mothername = $post['mothername'];
						$state = $post['state'];
						$city = $post['city'];
						$address = $post['address'];
						$courses = $post['courses'];
						$age = $post['age'];
						$gender = $post['gender'];
						$dob = $post['dob'];

						
						$insert_stmt=$this->connection->prepare('INSERT INTO `applications`( `name`, `mobile`, `email`, `father_name`, `mother_name`, `address`, `state_id`, `city_id`, `dob`, `age`, `gender`, `course`) VALUES ( :name, :mobile, :email, :father_name, :mother_name, :address, :state_id, :city_id, :dob, :age, :gender, :course)');
					 

						$insert_stmt->bindParam(':name',$name);
						$insert_stmt->bindParam(':mobile',$mobile);
						$insert_stmt->bindParam(':email',$email);
						$insert_stmt->bindParam(':father_name',$fathername);
						$insert_stmt->bindParam(':mother_name',$mothername);
						$insert_stmt->bindParam(':state_id',$state);
						$insert_stmt->bindParam(':city_id',$city);
						$insert_stmt->bindParam(':address',$address);
						$insert_stmt->bindParam(':course',$courses);
						$insert_stmt->bindParam(':age',$age);
						$insert_stmt->bindParam(':dob',$dob);
						$insert_stmt->bindParam(':gender',$gender);

						
						if($insert_stmt->execute()) 
						{
							return 1;
						}
						else
						{
							return 0;
						}		
					}
					else
					{
						return 2;
					}
				}
			}
		}

		function get_applicants()
		{
			$data = null;

			$select_stmt = $this->connection->prepare("SELECT a.id as applicant_id,a.name,a.mobile,a.age,s.name as state,c.name as city,cr.name course FROM applications as a LEFT JOIN state as s ON a.state_id = s.id Left JOIN city as c ON a.city_id = c.id LEFT JOIN courses as cr ON a.course = cr.id WHERE a.status = ? AND a.is_deleted = ?");
		
			$select_stmt->execute(['Active',0]);
			
			$data = $select_stmt->fetchAll();
			
			$s = '<thead class="thead-dark"><tr><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">State</th><th scope="col">City</th><th scope="col">Age</th><th scope="col">Course</th><th scope="col">Action</th></tr><thead><tbody>';  
			foreach ($data as $row)
			{
				$s .= '<tr><th scope="row">'. $row['name'].'</th><td>'. $row['mobile'].'</td><td>'. $row['state'].'</td><td>'. $row['city'].'</td><td>'. $row['age'].'</td><td>'. $row['course'].'</td><td class="action"><a id="edit" value="'.$row['applicant_id'].'" class="btn btn-warning">Edit</a> &nbsp;&nbsp; <a id="delete"  value="'.$row['applicant_id'].'" class="btn btn-danger delete">Delete</a></td></tr>';
					 
			}
			$s .= '</tbody></table>';
			return $s;
			
		}

		function delete_applicant($delete_id)
		{
			$update_stmt=$this->connection->prepare('UPDATE applications SET is_deleted= ? WHERE id= ?');
			$is_deleted = 1;
			
			if ($update_stmt->execute([$is_deleted, $delete_id])) 
			{
				echo '<div class="alert alert-success" style="margin-top: 15px;">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong> Deleted : Applicant deleted successfully </strong>
					 </div>';
			}
			else
			{
				echo '<div class="alert alert-danger" style="margin-top: 15px;">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong> Fail to delete Applicant </strong>
					  </div>' ;
			}
		}

		function edit_applicant($edit_id)
		{
			$edit_stmt=$this->connection->prepare('Select * from applications WHERE id= ?');
			
			$edit_stmt->execute([$edit_id]);
			
			$data = $edit_stmt->fetch(); 

			return json_encode($data);
		}

		function update_applications($post)
		{
			$update_stmt=$this->connection->prepare('UPDATE `applications` SET `name`=?,`mobile`=?,`email`=?,`father_name`=?,`mother_name`=?,`address`=?,`state_id`=?,`city_id`=?,`dob`=?,`age`=?,`gender`=?,`course`=? WHERE id= ?');
			$is_deleted = 1;
			
			if ($update_stmt->execute([$post['name'],$post['mobile'],$post['email'],$post['fathername'],$post['mothername'],$post['address'],$post['state'],$post['city'],$post['dob'], $post['age'],$post['gender'], $post['courses'], $post['appid']]))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
}

$_aXObj=new Model();
switch($_POST['ch'])
{	
	case 1: echo $_aXObj->get_state();
		break;
	case 2: echo $_aXObj->get_city($_POST['state_id']);
		break;
	case 3: echo $_aXObj->get_courses();
		break;
	case 4: echo $_aXObj->get_course_details($_POST['course_id']);
		break;	
	case 5:  echo $_aXObj->insert_applications($_POST);
		break;
	case 6:  echo $_aXObj->get_applicants();
		break;
	case 7:  echo $_aXObj->delete_applicant($_POST['delete_id']);
		break;
	case 8:  echo $_aXObj->edit_applicant($_POST['edit_id']);
		break;
	case 9:  echo $_aXObj->update_applications($_POST);
		break;
	
}
 ?>