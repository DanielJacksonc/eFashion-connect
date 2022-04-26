
<div class="full-row mt-0" style="background-image: url(<?php echo base_url('assets/bg/gig.png') ; ?>)">
    
    <div class="container">
        <div class="alert alert-danger d-none" id="alert"></div>
        <div class="alert alert-success d-none" id="success"></div>
        <div id="ruler" class="">
        </div>
    </div>



    <div class="container mt-3 p-3 rounded">
        <div class="row">
            <div class="col-lg-8 text-dark">

                <form id="update_profile" autocomplete="off" id="btn-gig-submit" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="profile_img">Profile Image</label>
                        <input type="file" style="color: #B9F8D3;" class="form-control-file" name="profile_img" id="profile_img" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="des">Description</label>
                        <textarea style="background-color: #B9F8D3;" class="form-control" name="des" id="des"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="dob">Birthday</label>
                        <input style="background-color: #B9F8D3;" class="form-control" type="date" name="dob" id="dob" />
                    </div>

                    <div class="row mt-4">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input style="background-color: #B9F8D3;" type="text" class="form-control" name="address" id="address">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input style="background-color: #B9F8D3;" type="text" class="form-control" name="city" id="city">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input style="background-color: #B9F8D3;" type="text" class="form-control" name="country" id="country">
                            </div>
                        </div>

                    </div>

                    <div class="form-group text-center mt-3">
                        <button class="btn btn-block btn-success"> Save </button>
                    </div>

                </form>
            </div>

            <div class="col-lg-4">
                <img src="<?php echo base_url() . 'resource/images/design_2.png' ?>" alt="Model" height="500">
            </div>
        </div>
    </div>
</div>
