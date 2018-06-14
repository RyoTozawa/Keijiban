<?php
require_once(dirname(__FILE__).'/config.php');
?>

<?php
if($_POST["delete"]){
    $records = ORM::for_table('comment')->where_like('id', (int)$_POST["delete"])->find_many();
    foreach($records as $record){
        $record->delete();
    }
    header( "Location: ../index.php" );
}
?>