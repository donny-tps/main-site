<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

    
?>
<div class="july-2016-wp-pages">
    <section>
        <div class="container">
            <div class="full-width">
                <h3><b>New Group</b> Add touchpoints to group</h3>
            </div>
            
            <form name="newGroup" method="POST" action="?page=tps-touch-point&action=add-group" class="new-group full-width">
                
                <div class="full-width">
                    <span>Group name</span>
                    <input type="text" name="group-name">
                </div>
                <div class="full-width">
                    <span>Add Touchpoints</span>
                    <ul class="touchpointsList" id="sortable">
                        <li>
                            <select name="touchpoint-1">
                                <option val="">Select a touchpoint.</option>
                                <?php
                                    $touchpoints = TouchPoint::getTouchpointNames();
                                    foreach($touchpoints as $key => $t) {
                                        echo '<option val="' . $t . '">' . $t . '</option>';
                                    }
                                ?>
                            </select>
                            <span class="remove"><i class="fa fa-trash-o"></i></span>
                            <span class="drag"><i class="fa fa-arrows"></i></span>
                        </li>
                    </ul>
                </div>
                
                
                
                <ul class="touchpoint-calculation">
                    <li>
                        
                    </li>
                    <li>
                        <button type="button" id="addTouchpointGroupButton">Add touchpoint</button>
                    </li>
                    <li>
                        <button type="submit">Add Group</button>
                    </li>
                </ul>
                
            </form>
        </div>
    </section>

</div>