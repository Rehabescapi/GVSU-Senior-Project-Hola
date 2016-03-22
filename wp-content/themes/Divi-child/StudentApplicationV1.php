<?php /* Template Name: Application Page V1 */ ?>

<?php
 
  //response generation function
  $response = "";
 
  //function to generate response
  function my_contact_form_generate_response($type, $message){
 
    global $response;
 
    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";
 
  }
?>


<?php get_header(); ?>
 
  <div id="primary" class="site-content">
    <div id="content" role="main">
 
      <?php while ( have_posts() ) : the_post(); ?>
 
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 
            <header class="entry-header">
              <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
 
            <div class="entry-content">
              <?php the_content(); ?>
 
              <p>
                <style type="text/css">
  .error{
    padding: 5px 9px;
    border: 1px solid red;
    color: red;
    border-radius: 3px;
  }
 
  .success{
    padding: 5px 9px;
    border: 1px solid green;
    color: green;
    border-radius: 3px;
  }
 
  form span{
    color: red;
  }
</style>
 
<div id="respond">
  <?php echo $response; ?>
  
  <div class = "main info" >
  <form action="<?php the_permalink(); ?>" method="post">
    <p><label for="first_name">First Name: <span>*</span> <br><input type="text" name="app_first_name" value="<?php echo esc_attr($_POST['message_Fname']); ?>"></label></p>
    <p><label for="last_name"> Last Name: <span>* </span> <br> <input type="text" name ="app_first_name"value="<?php echo esc_attr($_POST['message_Lname']); ?>"></span></label></label></p>
    <p><label for="user_email">Email: <span>*</span> <br><input type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>"></label></p>
   
   <p><label for="user_phone">Phone #: <span>*</span> <br><input type="text" name="message_phone" value="<?php echo esc_attr($_POST['message_phone']); ?>"></label></p>
  
  <p><label for="user_Birthday">Birthday (mm/dd/yy) #: <span>*</span> <br><input type="text" name="user_Birthday" value="<?php echo esc_attr($_POST['user_Birthday']); ?>"></label></p>
 
  
  <p><label for="user_Ethnicity">Ethnicity: <span>*</span> <br><input type="text" name="user_Ethnicity" value="<?php echo esc_attr($_POST['user_Ethinicity']); ?>"></label></p>
 
  <p><label for="user_Gender">Gender #: <span>*</span> <br><input type="text" name="user_Gender" value="<?php echo esc_attr($_POST['user_Gender']); ?>"></label></p>
 
  <p><label for="user_Residency">Residency #: <span>*</span> <br><input type="text" name="user_Residency" value="<?php echo esc_attr($_POST['user_REsidency']); ?>"></label></p>
 
  <p><label for="user_origin">How did you find out about our site: <span>*</span> <br><input type="text" name="user_origin" value="<?php echo esc_attr($_POST['user_Origin']); ?>"></label></p>
 
  </div>
  
  <div class = " Mail_info">
     <p><label for="user_MailAddress1">Address: <span>*</span> <br><input type="text" name="user_MailAddress1" value="<?php echo esc_attr($_POST['user_MailAddress1']); ?>"></label></p>
 <p><label for="user_Mailaddress2">Address2: <span>*</span> <br><input type="text" name="user_Mailaddress2" value="<?php echo esc_attr($_POST['user_Mailaddress2']); ?>"></label></p>
 <p><label for="user_Mailcountry">Country: <span>*</span> <br><input type="text" name="user_Mailcountry" value="<?php echo esc_attr($_POST['user_Mailcountry']); ?>"></label></p>
 <p><label for="user_MailCity">City: <span>*</span> <br><input type="text" name="user_MailCity" value="<?php echo esc_attr($_POST['user_MailCity']); ?>"></label></p>

 <p><label for="user_MailState">State: <span>*</span> <br><input type="text" name="user_MailState" value="<?php echo esc_attr($_POST['user_MailState']); ?>"></label></p>

    

     <p><label for="user_MailPostalCode">Postal Code: <span>*</span> <br><input type="text" name="user_MailPostalCode" value="<?php echo esc_attr($_POST['user_MailPostalCode']); ?>"></label></p>

    
    
  </div>
  
   <div class = "Permanent Address">
     
     <p> Check if same as mail address</p>
     
     <p><label for="user_Address1">Address: <span>*</span> <br><input type="text" name="user_Address1" value="<?php echo esc_attr($_POST['user_Address1']); ?>"></label></p>
 <p><label for="user_Address2">Address2: <span>*</span> <br><input type="text" name="user_Address2" value="<?php echo esc_attr($_POST['user_Address2']); ?>"></label></p>
 <p><label for="user_Country">Country: <span>*</span> <br><input type="text" name="user_Country" value="<?php echo esc_attr($_POST['user_Country']); ?>"></label></p>
 <p><label for="user_City">City: <span>*</span> <br><input type="text" name="user_City" value="<?php echo esc_attr($_POST['user_City']); ?>"></label></p>

 <p><label for="user_State">State: <span>*</span> <br><input type="text" name="user_State" value="<?php echo esc_attr($_POST['user_State']); ?>"></label></p>

    

     <p><label for="user_PostalCode">Postal Code: <span>*</span> <br><input type="text" name="user_PostalCode" value="<?php echo esc_attr($_POST['user_PostalCode']); ?>"></label></p>

    
    
  </div>
  
  <div class = "PlaceofBirth">
    
    
    
  </div>
  <div class = "College Information">
    
    
    
    
  </div>
  
  
  
  
    <input type="hidden" name="submitted" value="1">
    <p><input type="submit"></p>
    
    
    
    
  </form>
  
  
  <form name = "conditions "> 
  
  
  
  </form>
  
  
   <form name = "essay Questions"> 
  
  
  
  </form>
  
  <form name = "Release Questions"> 
  
  
  
  </form>
  
  <form name = "essay Questions"> 
  
  
  
  </form>
  
  
  <form name = "emergency Contacts"> 
  
  
  </form>
  
  
  <form name = "Deposit Information"> 
  
  </form>
  
  <form name = "Risk Release"> 
  
  
  </form>
  
  
  
  <form name = "finalize" >
    
  </form>
    
  
</div>
               
            </div><!-- .entry-content -->
 
          </article><!-- #post -->
 
      <?php endwhile; // end of the loop. ?>
 
    </div><!-- #content -->
  </div><!-- #primary -->
 


<?php get_footer(); ?>