<?php
include 'global.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
    $(document).ready(function(){

    
    $("[data-toggle=tooltip]").tooltip();
});</script>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    if(isset($_SESSION['uid'])) {
                    	?>
						<li><a href="index.php">Blogposts</a></li>                    	
						<li><a href="#" data-toggle="modal" data-target="#SearchModal">Search</a></li>

                    	<?php
                    }

                    ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <?php

if (isset($_SESSION['uid'])) {
?>
                	<li><a href="#">Welcome <?php
	echo $_SESSION['una']; ?></a></li>
                	<li><a href="index.php?action=Logout">Logout</a></li>
                	<?php
}
else {
?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
								 <form class="form" role="form" method="post" action="index.php?action=Login" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <label for="email">Email address</label>
											 <input type="email" class="form-control" id="email" placeholder="Email address" name="email" required>
										</div>
										<div class="form-group">
											 <label for="pass">Password</label>
											 <input type="password" class="form-control" id="pass" placeholder="Password" name="pass" required>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">Sign in</button>
										</div>
								 </form>
							</div>
					 </div>
				</li>
			</ul>
        </li>

                <?php
} ?>
                                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <?php

if ($action == "Login") {
	$email = $sql->real_escape_string($_POST['email']);
	$pass = $sql->real_escape_string($_POST['pass']);
	if (!isset($email) XOR !isset($pass)) {
		throw_error("Please enter an email and a password");
	}
	else
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		throw_error("The email you inserted is not in the right format.");
	}
	else {
		$query = $sql->query("SELECT email FROM user WHERE email='$email'");
		if (!$query) {
			throw_error("This account does not exist.");
		}
		else {
			$q = mysqli_fetch_object($sql->query("SELECT * FROM user WHERE email='$email'"));
			$hash = hash('whirlpool', $pass);
			if ($hash != $q->password) {
				throw_error("The password is wrong.");
			}
			else {
				$_SESSION['uid'] = $q->userID;
				$_SESSION['una'] = $q->username;
				echo "<script>location.href='index.php';</script>";
			}
		}
	}
}
elseif ($action == "Logout") {
	unset($_SESSION['uid']);
	unset($_SESSION['una']);
	echo "<script>location.href='index.php'</script>";
}
else {
	if (isset($_SESSION['uid'])) {
		$uid = $_SESSION['uid'];
		$una = $_SESSION['una'];
		if (!$page) {
			echo "<h1>Welcome " . $una . "!</h1>";
?>
		<div class="panel panel-primary">
			<div class="panel-heading">Publish a blog post</div>
			<?php
			if ($action == "Publish") {
				$text = $sql->real_escape_string($_POST['textarea']);
				$title = $sql->real_escape_string($_POST['title']);
				if (empty($text) || empty($title)) {
					throw_error("Please enter something in the textarea to write a blogpost.");
				}
				else {
					$sql->query("INSERT INTO `posts` (`title`, `text`, `userID`, `created_at`, `comments`) VALUES ('" . $title . "', '" . nl2br($text) . "', '" . $uid . "', '" . date("Y-m-d H:i") . "', '0');");
					echo "<div class='alert alert-success'>You published a new post.</div>";
				}
			}

?>
  			<form action="index.php?action=Publish" method="POST" role="form" class="form-horizontal">
  			<div class="panel-body">
     			<div class="form-group">
  					<div class="col-md-12">                     
    					<input type="text" id="title" name="title" class="form-control" placeholder="Title" />
  					</div>
				</div> 			
    			<div class="form-group">
  					<div class="col-md-12">                     
    					<textarea class="form-control" id="textarea" name="textarea" rows="10" placeholder="Blogpost"></textarea>
  					</div>
				</div>
  			</div>
  			<div class="panel-footer">
				<div class="form-group">
  					<div class="col-md-12">
    					<button type="submit" class="btn btn-success">Publish</button>
  					</div>
				</div>  				
  			</div>
  			</form>
		</div>

		<hr />

		<?php
			$query = $sql->query("SELECT * FROM posts ORDER BY postID DESC");
			while ($row = mysqli_fetch_object($query)) {
				$user = mysqli_fetch_object($sql->query("SELECT * FROM user WHERE userID=" . $row->userID));
?>
			<div class="panel panel-default">
				<div class="panel-heading">

					<h1><?php
				echo $row->title; ?> <small>by <?php
				echo $user->username; ?></small></h1>
					<p></p>
				</div>
				<div class="panel-body">
					<p class="lead"><?php
				echo $row->text; ?></p>
				</div>
				<div class="panel-footer">
				<i class="fa fa-comments"></i> <?php
				echo '<a href="index.php?page=Comments&id=' . $row->postID . '">' . $row->comments . ' Comment(s)</a>'; ?>  | <span class="glyphicon glyphicon-time"></span> Posted: <?php
				echo $row->created_at; ?>
				</div>
			</div>

			<?php
			}

?>
		<?php
		}
		elseif ($page == "Comments") {
			if (!isset($id) || $id <= 0) {
				echo "<script>location.href='index.php';</script>";
			}
			else {
				$query = $sql->query("SELECT * FROM posts WHERE postID='$id'");
				if (!$query) {
					echo "<script>location.href='index.php';</script>";
				}
				else {
					$pdata = mysqli_fetch_object($query);
					$user = mysqli_fetch_object($sql->query("SELECT * FROM user WHERE userID=" . $pdata->userID));
?>
			<div class="panel panel-default">
				<div class="panel-heading">

					<h1><?php
					echo $pdata->title; ?> <small>by <?php
					echo $user->username; ?></small></h1>
					<p></p>
				</div>
				<div class="panel-body">
					<p class="lead"><?php
					echo $pdata->text; ?></p>
				</div>
				<div class="panel-footer">
				<i class="fa fa-comments"></i> <?php
					echo $pdata->comments; ?> Comment(s) | <span class="glyphicon glyphicon-time"></span> Posted: <?php
					echo $pdata->created_at; ?>
				</div>
			</div>
			<h3>Comments</h3>
			<hr>
			<div class="panel panel-primary">
			<div class="panel-heading">Comment</div>
			<?php
					if ($action == "comment") {
						$text = $sql->real_escape_string($_POST['textarea']);
						if (empty($text)) {
							throw_error("Please enter something in the textarea to write a comment.");
						}
						else {
							$sql->query("INSERT INTO `comments` (`postID`, `userID`, `comment`, `created_at`) VALUES ('" . $id . "', '" . $uid . "', '" . nl2br($text) . "', '" . date("Y-m-d H:i") . "');");
							$sql->query("UPDATE posts SET comments=comments+1 WHERE postID='" . $id . "'");
							echo "<div class='alert alert-success'>You published a new comment.</div>";
						}
					}

?>
  			<?php
					echo '<form action="index.php?page=Comments&action=comment&id=' . $id . '" method="POST" role="form" class="form-horizontal">'; ?>
  			<div class="panel-body">			
    			<div class="form-group">
  					<div class="col-md-12">                     
    					<textarea class="form-control" id="textarea" name="textarea" rows="10" placeholder="Comment"></textarea>
  					</div>
				</div>
  			</div>
  			<div class="panel-footer">
				<div class="form-group">
  					<div class="col-md-12">
    					<button type="submit" class="btn btn-success">Comment</button>
  					</div>
				</div>  				
  			</div>
  			</form>
		</div>

<?php
					$cdata = $sql->query("SELECT * FROM comments WHERE postID='$id' ORDER BY commentID DESC");
					while ($row = mysqli_fetch_object($cdata)) {
						$user = mysqli_fetch_object($sql->query("SELECT * FROM user WHERE userID='" . $row->userID . "'"));
?>
			<div class="panel panel-default">
				<div class="panel-body">
					<p class="lead"><?php
						echo $row->comment;
 ?></p>
				</div>
				<div class="panel-footer">
				<i class="fa fa-comments"></i> Posted by <?php
						echo $user->username; ?> | <span class="glyphicon glyphicon-time"></span> Posted: <?php
						echo $row->created_at; ?>
				</div>
			</div>				
				<?php
					}
				}
			}
		} elseif($page == "Search") {
			$s = $sql->real_escape_string($_POST['search']);
			if(empty($s)) {
				throw_error("Please enter something to search!");
			} else {
				$res = $sql->query("SELECT * FROM `posts` WHERE `title` LIKE '%".$s."%' XOR `text` LIKE '%".$s."%'  ORDER BY postID DESC");
				if($res->num_rows == 0) {
					throw_error("We couldn't find anything containing ' ".$s." ' :( ");
				} else {
					if($res->num_rows == 1)
						echo "<h3>1 Result</h3><hr>";
					else
						echo "<h3>".$res->num_rows." Results</h3><hr>";

					while($row = mysqli_fetch_object($res)) {
					$user = mysqli_fetch_object($sql->query("SELECT * FROM user WHERE userID=" . $row->userID));						
					?>
						<div class="panel panel-default">
							<div class="panel-heading">

								<h1><?php
								echo $row->title; ?> <small>by <?php
								echo $user->username; ?></small></h1>
							</div>
							<div class="panel-body">
								<p class="lead"><?php
									echo $row->text; ?></p>
							</div>
						<div class="panel-footer">
						<i class="fa fa-comments"></i> <?php
						echo '<a href="index.php?page=Comments&id=' . $row->postID . '">' . $row->comments . ' Comment(s)</a>'; ?>  | <span class="glyphicon glyphicon-time"></span> Posted: <?php
						echo $row->created_at; ?>
				</div>
			</div>
			<?php
					}				
				}
			}
		}
	}
}

?>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; nns.li 2016</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->



	<!-- JS stuff -->
<div class="modal fade" id="SearchModal" tabindex="-1" role="dialog" aria-labelledby="SearchModal">
  	<div class="modal-dialog" role="document">
  		<form action="index.php?page=Search" method="POST" role="form" class="form-horitontal">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Search</h4>
      		</div>
      		<div class="modal-body">
       			<div class="form-group">
       				<div class="col-md-12">
						<input id="search" type="text" name="search" placeholder="What do you want to search after?" class="form-control" >
       				</div>
       			</div><br />
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		<button type="submit" class="btn btn-primary">Search</button>
     		</div>
    	</div>
    	</form>
    </div>
</div>

	<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<!-- AngularJS -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
</body>

</html>
 
