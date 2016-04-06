<?php
// Silence is golden.
    
    add_shortcode('shortcode', 'my_custom_shortcode');
    
    
    function my_custom_shortcode( $atts ) {

    ob_start(); ?>

    <form method="post" action="<?php echo $PHP_SELF;?>">
...... (your form) ......
<input type="submit" value="submit" name="submit"><br />
</form>


<br />


    <form>
    <input type="radio" name="gender" value="male" checked> Male<br>
    <input type="radio" name="gender" value="female"> Female<br>
    <input type="radio" name="gender" value="other"> Other
    </form>
<?php
    /* Get the buffered content into a var */
    $sc = ob_get_contents();
    
    /* Clean buffer */
    ob_end_clean();
    
    /* Return the content as usual */
    return $sc;



}



?>