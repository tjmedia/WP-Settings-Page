<?php
global $options;
// this attaches the option name to the $variable for use in the template file
$options = get_option('my_option_name', $options);
?>

<?php
// this displays the option id specified from the WP Settings Page. In this case, option id is 'arctic_training_number'
//helo
?>
<?php echo $options['arctic_training_number']; ?>
