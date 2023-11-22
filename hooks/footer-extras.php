<?php 
    $script_name = basename($_SERVER['PHP_SELF']);
    if( $script_name == 'index.php' && isset($_GET['signIn'])) {
        ?>
        <style>
            body{
                background: url("images/gu.jpg") no-repeat fixed center center / cover;
            }
        </style>

        <div class="alert alert-success" id="benefits">
            <h1>Benefits of becoming a member:</h1>
            <ul>
                <li><h3> You'll be awsome!</h3></li>
                <li> <h3>We'll be richer!</h3></li>
            </ul>
        </div>
<script>
    $j(function(){
        $j('#benefits').appendTo('#login_splash');
    })
</script>
        <?php 
    }
    ?>


<?php if(!$_REQUEST['Embedded']){ ?>
    <div class=navbar-fixed-bottom hidden-print alert alert-info">
        <?php echo date('D, j M Y h:m:s a T'); ?>
    </div>
<?php } ?>

<script>
    function get_date(date_field){
        var y = $j('#' + date_field).val();
        var m = $j('#' + date_field + '-mm').val();
        var d = $j('#' + date_field + '-dd').val();
        
        var date_object = new Date(y, m - 1, d);
        
        if(!y) return false;
        
        return date_object;
    }
</script>