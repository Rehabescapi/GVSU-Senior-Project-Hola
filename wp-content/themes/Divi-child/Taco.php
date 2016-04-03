


function fillerFunction()
{
    
   echo  "<form action=\"<?php the_permalink(); ?>\" method=\"post\"> " ;
  echo " <p><label for=\"first_name\">First Name: <span>*</span> <br><input type=\"text\" name="\app_first_name\" value=\"<?php echo esc_attr($_POST['message_Fname']); ?>\"></label></p>";
    echo" <p><label for=\"last_name\"> Last Name: <span>* </span> <br> <input type=\"text\" name =\"app_first_name\"value="<?php echo esc_attr($_POST['message_Lname']); ?>\"></span></label></label></p>";
   echo " <p><label for=\"user_email\">Email: <span>*</span> <br><input type=\"text\" name=\"message_email\" value=\"<?php echo esc_attr($_POST['message_email']); ?>\"></label></p>";
   
 echo   <<<EOL <p><label for="user_phone">Phone #: <span>*</span> <br><input type="text" name="message_phone" value="<?php echo esc_attr($_POST['message_phone']); ?>"></label></p> 
  
  <p><label for="user_Birthday">Birthday (mm/dd/yy) #: <span>*</span> <br><input type="text" name="user_Birthday" value="<?php echo esc_attr($_POST['user_Birthday']); ?>"></label></p>
 
  
<p><label for="user_Ethnicity">Ethnicity: <span>*</span> <br><input type="text" name="user_Ethnicity" value="<?php echo esc_attr($_POST['user_Ethinicity']); ?>"></label></p> 
 
<p><label for="user_Gender">Gender #: <span>*</span> <br><input type="text" name="user_Gender" value="<?php echo esc_attr($_POST['user_Gender']); ?>"></label></p>
<p><label for="user_Residency">Residency #: <span>*</span> <br><input type="text" name="user_Residency" value="<?php echo esc_attr($_POST['user_REsidency']); ?>"></label></p>
 
<p><label for="user_origin">How did you find out about our site: <span>*</span> <br><input type="text" name="user_origin" value="<?php echo esc_attr($_POST['user_Origin']); ?>"></label></p>
 
</div>
EOL;

    
    
    
}

