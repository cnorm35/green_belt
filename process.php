<?php
session_start();
require('new-connection.php');

if(isset($_POST['action']) && $_POST['action'] == 'register')
{
	register_user($_POST);
}

elseif(isset($_POST['action']) && $_POST['action'] == 'login')
{
	login_user($_POST);
}

elseif(isset($_POST['action']) && $_POST['action'] == 'add_incident')
{
	add_incident($_POST);
}

elseif(isset($_GET['action']) && $_GET['action'] == 'view_incident')
{
	header("location: view.php?id={$_GET['id']}");
}
elseif(isset($_GET['action']) && $_GET['action'] == 'delete')
{
	delete_incident($_GET['id']);
}
elseif(isset($_GET['action']) && $_GET['action'] = 'people')
{
	header("location: people.php?id={$_GET['id']}");
}
else 
{
	session_destroy();
	header('location: index.php');
	die();
}



function register_user($post)
{
	$_SESSION['errors'] = array();

	if(empty($post['first_name']))
	{
		$_SESSION['errors'][] = "First name cannot be blank!";
	}

	if(empty($post['last_name']))
	{
		$_SESSION['errors'][] = "Last name cannot be blank!";
	}

	if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
		{
		$_SESSION['errors'][] = "Please enter a valid email address";
		}

	if(empty($post['password']))
	{
		$_SESSION['errors'][] = "Password cannot be left blank!";
	}

	if($post['password'] != $post['confirm_password'])
		{
			$_SESSION['errors'][] = "Passwords do not match.";
		}

	if(count($_SESSION['errors']) > 0)
	{
		header('location: index.php');
	}
	else
	{
		$first_name = escape_this_string($post['first_name']);
		$last_name = escape_this_string($post['last_name']);
		$email = escape_this_string($post['email']);
		$password = escape_this_string($post['password']);
		$query = "INSERT INTO Users (first_name, last_name, email, password, created_at, updated_at)
					VALUES ('$first_name', '$last_name', '$email', '$password', NOW(), NOW())";
		run_mysql_query($query);
		$_SESSION['success'] = "User successfully created!";
		header('location: index.php');
		die();
					
	}
}

function login_user($post)
{
	$query = "SELECT * FROM Users WHERE email = '{$post['email']}' AND password = '{$post['password']}'";
	$user = fetch_all($query);

	if(count($user) > 0)
		{
			// var_dump($user);
			$_SESSION['user-id'] = $user[0]['id']; 
			$_SESSION['first_name'] = $user[0]['first_name'];
			$_SESSION['logged_in'] = TRUE; 
			header('location: home.php');
			die();
		}
		else
		{
			$_SESSION['errors'][] = "No user found, please try again";
			header('location: index.php');
			die();
		}
}

function add_incident($post)
{
////////  Validate Infor Before Going Into the DB////////////
	$_SESSION['incident_errors'] = array();

	if(empty($post['incident_name']))
	{
		$_SESSION['incident_errors'][] = "Incident cannot be left blank!";
	}

	if(empty($post['incident_date']))
	{
		$_SESSION['incident_errors'][] = "Incident date cannot be left blank!";
	}

///////////////////End of validations/////////////
	if(count($_SESSION['incident_errors']) > 0)
	{
		header('location: home.php');
		die();
	}
	else 
	{
		$incident = $post['incident_name'];
		//date format can only enter #'s no need to escape string
		$query = "INSERT INTO Incidents (name, created_at, updated_at, Users_id, date)
					VALUES ('{$post['incident_name']}',NOW(), NOW(),{$_SESSION['user-id']}, '{$post['incident_date']}' )";
		run_mysql_query($query);
		header('location: home.php');
		die();

	}
}

function delete_incident($id)
{
	$query = "DELETE FROM Incidents WHERE id = {$id}";
	run_mysql_query($query);
	header('location: home.php');
	die();
}














?>