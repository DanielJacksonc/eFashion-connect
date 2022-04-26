
<div class="full-row mt-2" style="background-image: url( <?php echo base_url('assets/bg/cprofile.jpg');?> );">
    <div class="container-fluid mt-4">
            <div class="main-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body bg-primary">
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
                                <ul class="list-group list-group-flush">

                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap bg-primary text-dark">
                                        <p> <?php echo $profile['des']; ?> </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-8">

                        <div class="row text-right mt-2">
                            <div class="col-sm-12 ">
                                <a class="" href="<?php echo base_url() . 'b/new_job'; ?>">
                                    <button class="btn btn-sm btn-success" > Post A Job </button>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-center"><h4 class="text-white"> All Posted Jobs </h4></div>
                        </div>

                        <div class="row m-3 p-2" style="background-color: gray;">
                            <div class="col-sm-6 text-white">&nbsp;&nbsp;&nbsp;&nbsp;<b>Description</b></div>
                            <div class="col-sm-2 text-white">&nbsp;<b>Price</b></div>
                            <div class="col-sm-2 text-white"><b>Offers</b></div>
                            <div class="col-sm-2 text-white"><b>View</b></div>
                        </div>

                            <?php

                                $posts = array_reverse($posts);

                                foreach ( $posts as $post ) {  
                                    ?>
                                        <div class="row m-3 p-2 text-white" style="background-color: #00008b;">
                                            <div class="col-sm-6"><?php echo $post['des']; ?></div>
                                            <div class="col-sm-2">$ <?php echo $post['price']; ?></div>
                                            <div class="col-sm-2"> <?php echo $post['offered']; ?></div>
                                            <div class="col-sm-2"><a class="btn btn-sm btn-success" href="<?php echo base_url() . 'b/offers/' . $post['job_id']; ?>">Explore</a></div>
                                        </div>

                                    <?php
                                }
                            ?>
                    </div>
                </div>
            </div>
    </div>

    <div style="height: 200px"></div>
</div>

    