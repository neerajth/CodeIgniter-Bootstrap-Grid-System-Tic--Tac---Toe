<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title; ?></title>
  <meta charset="utf-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    
    <?php echo link_tag('assets/css/tictactoe.css'); ?>
    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';        
    </script>
    <?php if ( $level == 0 ) { ?>
        <script src="<?php echo base_url(); ?>assets/js/tictactoe.js"></script>
    <?php } else if ( $level == 1 ) { ?>
        <script src="<?php echo base_url(); ?>assets/js/tictactoe_1.js"></script>
    <?php } else if ( $level == 2 ) { ?>
        <script src="<?php echo base_url(); ?>assets/js/tictactoe_2.js"></script>
    <?php } ?>
    
                
</head>
    <body>