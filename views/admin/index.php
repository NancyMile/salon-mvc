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
            <input type="date" name="date" id="date">
        </div>
    </form>
</div>
<div id="appointments-admin">
    <ul class="appointments">
        <?php
            $appointmentId = 0;
            foreach($appointments as $appointment):
                //checks if the data if from same appointment
                if($appointmentId !== $appointment->id):
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
                endif;?>
                    <p class="service"><?php echo $appointment->service ."   $".$appointment->price; ?></p>

                    </li>
        <?php  endforeach; ?>
    </ul>
    <?php //debuguear($appointments); ?>
</div>