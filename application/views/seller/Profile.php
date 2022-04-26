

<div class="full-row mt-2" style="background-image: url( <?php echo base_url('assets/bg/profile-3.jpg');?> );">

    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-lg-4 border p-3">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="row">
                        <?php
                            if ( $profile['avtar'] == '' ) {?><i class="flaticon-user flat-large text-white"></i><?php
                            }
                            else {?><img src="<?php echo base_url() . 'resource/avtar/' . $profile['avtar']; ?>" alt="Admin" class="rounded-circle" height="100" width="95"><?php
                            }
                        ?>
                    </div>
                
                    <div class="row mt-3">
                        <h4 class="text-white "><?php echo $profile['f_name'] . " " . $profile['l_name'] ; ?></h4>
                    </div>

                </div>
                <hr class="my-4">
                <div class="text-white mx-4 p-2">
                    <h6 class="text-white">Description : </h6>
                    <p> <?php echo $profile['des']; ?> </p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row text-right mt-2">
                    <div class="col-sm-12 ">
                        <a class="" href="<?php echo base_url() . 's/new_gig'; ?>">
                            <button class="btn btn-sm btn-secondary" >Create New GIG</button>
                        </a>
                    </div>
                </div>

                <div class="row mt-2">

                    <?php

                        $gigs = array_reverse($gigs);

                        foreach ( $gigs as $gig ) { ?> 

                                <div class="col-sm-4 mb-4 ">
                                    <div class="card bg-dark">
                                        <a href="<?php echo base_url('gig/details/') . $gig['gig_id']; ?>">
                                            <img class="card-img-top" src="<?php echo base_url() . 'resource/gig-images/' . $gig['img']; ?>" alt="Card image" height="150" width="200">
                                            <div class="card-body p-2">
                                                <div class="card-text text-info"><?php echo $gig['title']; ?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                        <?php
                        }
                    ?>

                </div>
                
            </div>
        </div>
    </div>

    <div style="height: 180px"></div>

</div>
