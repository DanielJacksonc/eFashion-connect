

<div class="container mt-5 bg-light p-4 rounded">

<div class="row m-1 mt-3">
    <div class="col-sm-10">
        <h4><?php echo $gig['title']; ?></h4>
    </div>
    <!-- <div class="col-sm-2 text-right">
        <a href=""><button class="btn btn-outline-primary"> Edit Gig </button></a>
    </div> -->
</div>

<div class="row m-1 mt-2">
    <img src="<?php echo base_url() . 'resource/avtar/' . $profile['avtar']; ?>" class="rounded-circle  bg-primary" height="40" width="40">
    <a class="ml-2" href="<?php echo base_url() . 'profile'; ?>"> <?php echo $user['user_name']; ?> </a>
</div>

<div class="row m-1 mt-2">
    <div class="col-sm-8">
        <div class="row mt-4">
            <img src="<?php echo  base_url() . 'resource/gig-images/' . $gig['img']; ?>" height="400" width="650" alt="">
        </div>
    </div>

    <div class="col-sm-4 mt-5">

        <div class="card ">
            <div class="card-body">
                <div class="row">
                    <div class="col text-center">
                        <h4>Price</h4>
                    </div>
                </div>
                <hr>

                <div class="row mb-2">
                    <div class="col text-center">
                        <h6>&#36; <?php echo $gig['price']; ?></h6>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col text-center">
                        <h6><?php echo $gig['d_date']; ?> Days Delivary </h6>
                    </div>
                </div>

                <div class="row">
                    <button class="btn btn-primary btn-block">Continue</button>
                </div>

            </div>
        </div>
        
    </div>
</div>

<div class="row m-1 mt-5 ">
    <h5>About The Gig</h5>
</div>

<div class="row m-1 my-3">
    <p><?php echo $gig['des']; ?></p>
</div>

<div class="row m-1">
    <h5>About The Designer</h5>
</div>
<div class="row m-1 mt-3">

    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-5">
                <img src="<?php echo base_url() . 'resource/avtar/' . $profile['avtar']; ?>" class="rounded-circle  bg-primary" height="100" width="100">
            </div>

            <div class="col-lg-7">
                <h6><a class="ml-2" href="<?php echo base_url() . 'profile'; ?>"> <?php echo $profile['f_name'] . " " . $profile['l_name'] ; ?> </a></h6>
                <p>About The Seller</p>
                <button class="btn btn-outline-primary">Contact Me</button>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="row">
            <div class="col-sm-8">
                <textarea class="form-control" name="" id="" cols="10" rows="5" placeholder="Type Your Message"></textarea>
            </div>

            <div class="col-sm-4">
                <button class="btn btn-outline-primary">Send</button>
            </div>
        </div>
        
    </div>
    
</div>

</div>

<br>
<br>
<br><br><br>

