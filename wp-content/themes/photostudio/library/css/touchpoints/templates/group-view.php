<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$group = TouchPoint::getGroup($_GET['id']);
?>
<div class="july-2016-wp-pages">
    <section>
        <div class="container">
            <div class="full-width">
                <h3><b>Edit Group</b> <?php echo $group->name; ?></h3>
            </div>
            
            <form name="newGroup" method="POST" action="?page=tps-touch-point&action=update-group" class="new-group full-width">
                
                <div class="full-width">
                    <span>Group name</span>
                    <input type="text" name="group-name" value="<?php echo $group->name; ?>">
                </div>
                <div class="full-width">
                    <span>Add Touchpoints</span>
                    <ul class="touchpointsList" id="sortable">
                        
                        <?php $existing = json_decode($group->touchpoints);
                        $touchpoints = TouchPoint::getTouchpointNames();
                        
                        foreach($existing as $key=>$e) {?>
                            <li>
                                <select name="touchpoint-<?php echo $key ?>">
                                    <?php
                                        echo '<option val="' . $e . '" selected>' . $e . '</option>';
                                        foreach($touchpoints as $key => $t) {
                                            echo '<option val="' . $t . '">' . $t . '</option>';
                                        }
                                    ?>
                                </select>
                                <span class="remove"><i class="fa fa-trash-o"></i></span>
                                <span class="drag"><i class="fa fa-arrows"></i></span>
                            </li>
                        <?php } ?>
                        

                    </ul>
                </div>
                
                
                
                <ul class="touchpoint-calculation">
                    <li>
                        
                    </li>
                    <li>
                        <button type="button" id="addTouchpointGroupButton">Add touchpoint</button>
                    </li>
                    <li>
                        <button type="submit">Update Group</button>
                    </li>
                </ul>
                
            </form>
        </div>
    </section>

</div>