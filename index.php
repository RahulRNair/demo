<?php

include_once("db.php"); // Include Db file for database connection

/******* Delete Call Goes here ********/
if(isset($_POST['action']) && $_POST['action']=='delete')
{

		$query_delete = "DELETE FROM notes_demo WHERE id=".mysql_real_escape_string($_POST['id']);
		mysql_query($query_delete);
		$response_data = array();
		$response_data['status'] = 200;
		$response_data['message'] = "success";
		echo json_encode($response_data);
		die();


}
/********* Update Call Goes here ***************/
if(isset($_POST['update']))
{


		 $title = mysql_real_escape_string($_POST['title']);
		 $note = mysql_real_escape_string($_POST['note']);
		 $time = time();
		 $query = "UPDATE notes_demo SET title='".$title."',note='".$note ."',date='".$time."' WHERE id=".$_POST['id'];

		 mysql_query($query); 
?>
<!-- Message Box -->
<div class="container">
  <div class="row row-notes">
      <p class="bg-info msg">Note Updated Successfully!!</p>
  </div>
</div>

<?php

}
/******** New Note creation goes here **************/
if(isset($_POST['submit']))
{

		 $title = $_POST['title'];
		 $note = $_POST['note'];
		 $time = time();
		 $query = "INSERT INTO notes_demo(title,note,date) VALUES ('$title','$note'
		,'$time')";
		 mysql_query($query); 
?>
<!-- Message Box -->
<div class="container">
  <div class="row row-notes">
    <p class="bg-info msg">New Note Created</p>
  </div>
</div>
<?php


}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Demo</title>


    <!-- Latest compiled and minified CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  	 <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  	<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>




    <div class="container">
        <?php 

          if(isset($_GET['id']) && $_GET['id']>0){ // Condition For Edit Starts

            $query_select = "SELECT id,title,note FROM notes_demo WHERE id=".mysql_real_escape_string($_GET['id']);
            $result = mysql_query($query_select);
            $num_rows = mysql_numrows($result);
            if($num_rows > 0){
                $row = mysql_fetch_array($result);

          ?>

          <div class="jumbotron">

            <form class="form-horizontal" action="" method="POST">

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
              <div class="col-sm-10">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" required value="<?php echo $row['title']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Note</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="note" required><?php echo $row['note']; ?></textarea>			    </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success btn-right" name="update">Update Notes</button>
              </div>
            </div>
          </form>
          </div>
          <?php }else{ ?>
            <div class="row">
            <div class="row row-notes">
              <p class="bg-info msg">No Record Found</p>
            </div>
          </div>
            <?php 
            }
              }
              else{ // Condition For New Notes
            ?>
	<div class="row">
      <!-- Main component for a primary marketing message or call to action -->

      <div class="jumbotron">

       	<form class="form-horizontal" action="" method="POST">

			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Note</label>
			    <div class="col-sm-10">
			      <textarea class="form-control" rows="3" name="note" required></textarea>			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-success btn-right" name="submit">Save Notes</button>
			    </div>
			  </div>
			</form>
      </div>
      </div>
      <!-- List Notes -->

      <?php
      $query_select = "SELECT id,title,note FROM notes_demo";
      $result = mysql_query($query_select);
      $num_rows = mysql_numrows($result);
      if($num_rows > 0){
      while ($row = mysql_fetch_array($result))
		{
      ?>
      <div class="row row-notes">

        <div class="col-md-10 note-list"><p class="title-txt" ><?php echo $row['title'];?></p></div>
        <div class="col-md-2 note-list"><a  href="?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-space edit"  data="<?php echo $row['id']; ?>">Edit</a><button type="button" class="btn btn-danger delete" data="<?php echo $row['id']; ?>">Delete</button></div>

      </div>

      <?php }}else{ ?>
      <div class="row row-notes">
        <p class="bg-info msg">No Record Found</p>
      </div>
      <?php } }?>
      <!-- / List Notes -->

    </div> <!-- /container -->




</body>
<script>
$(".delete").click(function(){
var r = confirm("Do you really want to delete the note!");
    if (r == true) {
        var id = $(this).attr('data');
  $.post("index.php",
    {
        id: id,
        action: "delete",


    },
    function(data, status){
      var obj = JSON.parse(data);
      if(status=="success" && obj.status==200)
      {

        location.reload();
      }
    });
    } 

});
</script>
</html>