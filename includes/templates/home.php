<div class="container">
    <div id="carouselExampleIndicators" class="carousel slide my-5"  data-ride="carousel">
        <div class="carousel-inner" style="height: 500px">
            <?php
            $slider = new slider($con);
            $slides = $slider ->viewAll();
            $active = 1;
            foreach ($slides as $slide){
                ?>
                <div class="carousel-item <?php  if($active == 1){ echo 'active'; $active++; } ?>">
                    <img class="d-block w-100" src="<?php echo $path . $slide['img']; ?>" alt="<?php echo $slide['head']; ?>">
                </div>
                <?php
            }
            ?>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next " href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>