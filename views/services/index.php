<h1 class="page-name">Services</h1>
<p class="page-description">Services</p>
<?php include_once __DIR__.'/../templates/bar.php' ?>
<h2>Sevices</h2>
<ul class="services">
    <?php foreach($services as $service): ?>
        <li>
            <p>Name: <span><?php echo $service->name;?></span></p>
            <p>Price: <span>$<?php echo $service->price;?></span></p>
        </li>
    <?php  endforeach; ?>
</ul>