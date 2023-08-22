<h1 class="page-name">Admin panel</h1>
<p class="page-description"> Admin Panel</p>
<?php

use Model\Appointment;

 include_once __DIR__."/../templates/bar.php"; ?>
<h2>Search Appointments</h2>
<div class="search">
    <form class="form">
        <div class="field">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="<?php echo $date; ?>">
        </div>
    </form>
</div>
<?php if(count($appointments) === 0):?>
    <h2>No Appointmenst on <?php echo $date; ?></h2>
<?php endif; ?>
<div id="appointments-admin">
    <ul class="appointments">
        <?php
            $appointmentId = 0;
            foreach($appointments as $key => $appointment):
                //checks if the data if from same appointment
                if($appointmentId !== $appointment->id):
                    $total = 0;
        ?>
                    <li>
                        <p>ID: <span><?php echo $appointment->id; ?></span></p>
                        <p>Time: <span><?php echo $appointment->time; ?></span></p>
                        <p>Client: <span><?php echo $appointment->client; ?></span></p>
                        <p>Email: <span><?php echo $appointment->email; ?></span></p>
                        <p>Phone: <span><?php echo $appointment->phone; ?></span></p>
                        <h3>Services</h3>
        <?php
                $appointmentId = $appointment->id;
                endif;
                $total += $appointment->price;
        ?>
                <p class="service"><?php echo $appointment->service ."   $".$appointment->price; ?></p>
        <?php
             $actual = $appointment->id;
             $next = $appointments[$key +1]->id ?? 0; //check if is the last element
             if(lastElement($actual,$next)): ?>
                <p>Total: <span><?php echo "$".$total; ?></span></p>
                <form action="/api/delete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $appointment->id; ?>">
                    <input type="submit" value="Delete" class="button-delete">
                </form>
            </li>
        <?php endif;
            endforeach; ?>
    </ul>
    <?php //debuguear($appointments); ?>
</div>
<?php
    $script = "<script src='build/js/search.js'></script>";
?>