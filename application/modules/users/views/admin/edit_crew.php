<div class="textbox">
    <h2>Boat Details</h2>
    <div class="textbox_content">
        <form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data">


            <p>
                <label>I'm looking to crew on  :</label>
                <br />
                <select name="boat[]" id="boat" multiple>
                    <option value="">Select</option>
                    <?php
                    foreach ($boats as $boat) {
                        $select = '';
                        foreach ($crew_boats as $crew_boat) {
                            if ($crew_boat->boat_id == $boat->boat_id)
                                $select = 'selected="selected"';
                        }
                        ?>

                        <option value="<?php echo $boat->boat_id; ?>"<?php
                        if (set_value("boat") == $boat->boat_id)
                            echo 'selected="selected"';
                        else
                            echo $select;
                        ?>><?php echo $boat->boat_title; ?></option>
                                <?php
                            }
                            ?>
                </select>
            </p>



            <p>
                <label>Main Activity type :</label>
                <br />
                <select name="activity[]" multiple>
                    <option value="">Select</option>
                    <?php
                    foreach ($acts as $act) {
                        $select = '';
                        foreach ($crew_acts as $crew_act) {
                            if ($crew_act->act_id == $act->activity_id)
                                $select = 'selected="selected"';
                        }
                        ?>
                        <option value="<?php echo $act->activity_id; ?>" <?php
                        if (set_value("activity") == $act->activity_id)
                            echo 'selected="selected"';
                        else
                            echo $select;
                        ?>><?php echo $act->activity_title; ?></option>
                                <?php
                            }
                            ?>
                </select>
            </p>


            <h3>Geographical details</h3>
            <p>
                <label>Ideal start location:</label>
                <br />
                <select name="start_location[]" multiple>
                    <option value="">Select</option>
                    <?php
                    foreach ($locations as $loc) {
                        $select = '';
                        foreach ($start_locations as $start) {
                            if ($start->location_id == $loc->location_id)
                                $select = 'selected="selected"';
                        }
                        ?>

                        <option value="<?php echo $loc->location_id; ?>" <?php
                        if (set_value("start_location") == $loc->location_id)
                            echo 'selected="selected"';
                        else
                            echo $select;
                        ?>><?php echo $loc->location_title; ?></option>
                                <?php
                            }
                            ?>
                </select>
            </p>

            <p>
                <label>Surrounding locations   :</label>
                <br />
                <select name="locations[]" multiple>
                    <option value="">Select</option>
                    <?php
                    foreach ($locations as $loc) {
                        $select = '';
                        foreach ($sarounds as $sur) {
                            if ($sur->location_id == $loc->location_id)
                                $select = 'selected="selected"';
                        }
                        ?>
                        <option value="<?php echo $loc->location_id; ?>" <?php
                        if (set_value("locations") == $loc->location_id)
                            echo 'selected="selected"';
                        else
                            echo $select;
                        ?>><?php echo $loc->location_title; ?></option>
                                <?php
                            }
                            ?>
                </select>
            </p>

            <p>
                <label>Acceptable radius :</label>
                <br />
                <select name="destination">
                    <option value="">Select</option>
                    <?php
                    foreach ($radius as $loc) {
                        ?>
                        <option value="<?php echo $loc->id; ?>" <?php if ($loc->id == set_value("destination", $user_details->user_destination)) echo 'selected="selected"'; ?>><?php echo $loc->radius; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <h3>My Background</h3>
            <p>
                <label>My Wake boarding experience  :</label>
                <br />
                <select name="wakeboard">
                    <option value="">Select</option>
                    <?php
                    foreach ($waters as $water) {
                        ?>
                        <option value="<?php echo $water->experience_id; ?>" <?php if ($water->experience_id == set_value("water", $user_details->crew_water_spot_experience)) echo 'selected="selected"'; ?>><?php echo $water->title; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label>I have my own Boarding gear:</label><br />
                <?php
                foreach ($gears as $gear) {
                    $cond = 0;
                    foreach ($crew_gears as $g) {
                        if ($g->gear_id == $gear->id) {
                            $cond = 1;
                        }
                    }
                    ?>
                    <input type="checkbox" name="boarding_gear[]" value ="<?php echo $gear->id; ?>" <?php echo $cond == 1 ? 'checked' : ''; ?> >  <?php
                    echo $gear->title;
                }
                ?>


            </p>
            <p>
                <label>My water skiing experience  :</label>
                <br />
                <select name="water">
                    <option value="">Select</option>
                    <?php
                    foreach ($waters as $water) {
                        ?>
                        <option value="<?php echo $water->experience_id; ?>" <?php if ($water->experience_id == set_value("water", $user_details->crew_water_spot_experience)) echo 'selected="selected"'; ?>><?php echo $water->title; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label>I have my own Ski gear  :</label><br />
                <select name="water_equipment">
                    <option value="">Select</option>
                    <option value="1">Ski</option>
                    <option value="2">Vest</option>
                </select>
            </p>
            <p>
                <label>My fishing experience  :</label>
                <br />
                <select name="fish">
                    <option value="">Select</option>
                    <?php
                    foreach ($fishs as $fish) {
                        ?>
                        <option value="<?php echo $fish->experience_id; ?>" <?php if ($fish->experience_id == set_value("fish", $user_details->crew_fishing_experience)) echo 'selected="selected"'; ?>><?php echo $fish->title; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label>I have my own tackle :</label><br />
                <select name="fish_equipment">
                    <option value="">Select</option>
                    <option value="1">Rod</option>
                    <option value="2">Tackle</option>
                    <option value="3">Net</option>
                </select>
            </p>
            <p>
                <label>My sailing experience  :</label>
                <br />
                <select name="sailing">
                    <option value="">Select</option>
                    <?php
                    foreach ($sails as $sail) {
                        ?>
                        <option value="<?php echo $sail->experience_id; ?>" <?php if ($sail->experience_id == set_value("sailing", $user_details->crew_sailing_experience)) echo 'selected="selected"'; ?>><?php echo $sail->title; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>


            <p>
                <label>I have my own sailing equipment :</label>
                <br />
                <input type="text" size="60" class="text" name="sailing_equipment" value="<?php echo set_value("sailing_equipment", $user_details->crew_sailing_equipment_own); ?>"/>
            </p>
            <?php /* <p>
              <label>Water sporting Equipment :</label>
              <br />
              <input type="text" size="60" class="text" name="water_equipment" value="<?php echo set_value("water_equipment", $user_details->crew_water_spot_equipment_own); ?>"/>
              </p>

              <p>
              <label>Fishing Equipment :</label>
              <br />
              <input type="text" size="60" class="text" name="fish_equipment" value="<?php echo set_value("fish_equipment", $user_details->crew_fishing_equipment_own); ?>"/>
              </p>
             */ ?>
            <p>
                <label>I want to be :</label>
                <br />
                <input type="radio" value="0" name="crew_type" <?php if ($user_details->user_crew_type == 0) echo 'checked="checked"'; ?> > An active participant
                <input type="radio" value="1" name="crew_type" <?php if ($user_details->user_crew_type == 1) echo 'checked="checked"'; ?> > Passive observer
            </p>
            <p>
                <label>The experience I seek is  :</label>
                <br />
                <input type="text" size="60" class="text" name="after" value="<?php echo set_value("after", $user_details->crew_experience_after); ?>"/>
            </p>
            <h3>Contact details</h3>
            <p>
                <label>First Name :</label>
                <br />
                <input type="text" size="60" class="text" name="first_name" value="<?php echo set_value('first_name', $user_details->user_firstname); ?>"/>
            </p>
            <p>
                <label>Last Name:</label>
                <br />
                <input type="text" size="60" class="text" name="last_name" value="<?php echo set_value("last_name", $user_details->user_lastname); ?>" />
            </p>
            <p>
                <label>Screen name:</label>
                <br />
                <input type="text" size="60" class="text" name="fb" value="<?php echo set_value("fb", $user_details->user_fb_twitter); ?>"/>
            </p>
            <p>
                <label>Email:</label>
                <br />
                <input type="text" size="60" class="text" name="user_email" value="<?php echo set_value('user_email', $user_details->user_email); ?>" />
            </p>
            <p>
                <label>Password:</label>
                <br />
                <input type="password" size="60" class="text" name="password" value="<?php echo set_value('password'); ?>" />
            </p>
            <p>
                <label>Confirm Password:</label>
                <br />
                <input type="password" size="60" class="text" name="cofirm_password" value="<?php echo set_value('confirm_password'); ?>" />
            </p>
            <p>
                <label>Image:</label>
                <br />
                <input type="file" size="40" class="text" name="userfile" value="" />
            </p>
            <p>
                <?php if (file_exists('./assets/uploads/users/' . $user_details->user_img) && $user_details->user_img != '') { ?>
                    <img src="<?php echo base_url() . 'assets/uploads/users/_thumb/' . $user_details->user_img; ?>" />
<?php } ?>
            </p>
            <br />


            <p>
                <label>Contact no :</label>
                <br />
                <input type="text" size="60" class="text" name="contact_no" value="<?php echo set_value("contact_no", $user_details->user_contact_no); ?>"/>
            </p>






            <?php /*   <p>
              <label>Privacy and Policy sign up :</label>
              <br />
              <input type="text" size="60" class="text" name="signup" value="<?php echo set_value('signup', $user_details->user_desclaimer_privacy_policy_signup); ?>"/>
              </p> */
            ?>
            <p class="onoffswitch">
                <input type="checkbox" name="user_status" class="onoffbtn" <?php if ($user_details->user_status == 1) { ?> checked="checked" <?php } ?> />
                <label>Active</label>
            </p>
            <br />

            <p>
                <input type="hidden" name="group_id" value="3"  />
                <input type="hidden" name="user_id" value="<?php echo $user_details->user_id; ?>"  />
                <input type="submit" class="submit" value="Submit" />
            </p>
        </form>
    </div>
</div>

