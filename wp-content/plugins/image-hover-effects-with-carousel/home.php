<?php
if (!defined('ABSPATH'))
    exit;
if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}
wp_enqueue_script('ihewc-vendor-bootstrap-jss', plugins_url('css-js/bootstrap.min.js', __FILE__));
wp_enqueue_style('ihewc-vendor-bootstrap', plugins_url('css-js/bootstrap.min.css', __FILE__));
wp_enqueue_style('ihewc-vendor-style', plugins_url('css-js/style.css', __FILE__));
wp_enqueue_style('font-awesome', plugins_url('css-js/font-awesome.min.css', __FILE__));
?>
<div class="wrap">
    <h1> Image Hover Effects <a href="<?php echo admin_url("admin.php?page=image-hover-carousel-new"); ?>" class="btn btn-primary"> Add New</a></h1>
    <div class="iheu-admin-wrapper table-responsive" style="margin-top: 20px; margin-bottom: 20px;">
        <table class="table table-hover widefat " style="background-color: #fff; border: 1px solid #ccc">
            <thead>
                <tr>
                    <th style="width: 15%">ID</th>
                    <th style="width: 20%">Name</th>
                    <th style="width: 50%">Shortcode</th>
                    <th style="width: 15%">Edit Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $wpdb;
                if (!empty($_POST['delete']) && is_numeric($_POST['id'])) {
                    $nonce = $_REQUEST['_wpnonce'];
                    if (!wp_verify_nonce($nonce, 'ihewcdeletehomedata')) {
                        die('You do not have sufficient permissions to access this page.');
                    } else {
                        global $wpdb;
                        $id = $_POST['id'];
                        $table_name = $wpdb->prefix . 'image_hover_with_carousel_style';
                        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id));
                    }
                }
                $data = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'image_hover_with_carousel_style ORDER BY id DESC', ARRAY_A);
                foreach ($data as $value) {
                    $id = $value['id'];
                    echo ' <tr>';
                    echo ' <td>' . $id . '</td>';
                    echo '  <td >' . $value['name'] . '</td>';
                    echo '<td ><span>Shortcode <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="[ihewc_oxi id=&quot;' . $id . '&quot;]"></span>'
                    . '<span>Php Code <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[ihewc_oxi  id=&quot;' . $id . '&quot;]&#039;); ?&gt;"></span></td>';
                    echo '<td >
                                    <a href="' . admin_url("admin.php?page=image-hover-carousel-new&styleid=$id") . '"  class="btn btn-info" style="float:left; margin-right: 5px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <form method="post"> ' . wp_nonce_field("ihewcdeletehomedata") . '
                                            <input type="hidden" name="id" value="' . $id . '">
                                            <button class="btn btn-danger" style="float:left" type="submit" value="delete" name="delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>  
                                    </form>
                                   
                             </td>';
                    echo ' </tr>';
                }
                ?>

            </tbody>
        </table> 
    </div>
</div>