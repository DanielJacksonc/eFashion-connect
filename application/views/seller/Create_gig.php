<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/gig.png') ; ?>)">

    <div class="container px-3">
        <div class="alert alert-danger d-none" id="alert"></div>
        <div class="alert alert-success d-none" id="success"></div>
        <div id="ruler" class=""></div>
    </div>
    

    <div class="container mt-2">
        <div class="main-body">
            <div class="row">
                <div class="col-sm text-center">
                    <h3 class="text-white">Create Your GIG</h3>
                </div>
            </div>

            <div class="row px-4">
                <div class="col-sm">
                <form autocomplete="off" id="btn-gig-submit" enctype="multipart/form-data">
                    
                    <div class="form-group mb-2">
                        <label for="gig_title"> <h6 class="text-white">Gig Title</h6></label>
                        <input type="text" style="background-color: #B9F8D3;" class="form-control" name="gig_title" id="gig_title" placeholder="I will do">
                    </div>

                    <div class="form-group mb-2">
                        <label for="gig_des"> <h6 class="text-white">Description</h6> </label>
                        <textarea name="gig_des" style="background-color: #B9F8D3;" class="form-control" id="gig_des"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="category"><h6 class="text-white">Category</h6></label>
                        <select name="category" style="background-color: #B9F8D3;" class="form-control" id="category">
                            <option value="Tank top">Tank top</option>
                            <option value="T-shirt">T-shirt</option>
                            <option value="V-neck shirt">V-neck shirt</option>
                            <option value="Polo shirt">Polo shirt</option>
                            <option value="Jersey">Jersey </option>
                            <option value="Sweatshirt">Sweatshirt</option>
                            <option value="Turtle neck">Turtle neck</option>
                            <option value="Hoody">Hoody</option>
                            <option value="Hawaiian shirt">Hawaiian shirt</option>
                            <option value="Dress shirt">Dress shirt</option>
                            <option value="Tuxedo">Tuxedo</option>
                            <option value="Plaid shirt">Plaid shirt</option>
                            <option value="Jacket">Jacket</option>

                        </select>
                    </div>

                    <div class="row my-4">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="price"><h6 class="text-white">Price &#36;</h6></label>
                                <input type="number" style="background-color: #B9F8D3;" class="form-control" name="price" id="price" min="1">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="d_date"><h6 class="text-white">Delivary Time</h6></label>
                                <input type="number" style="background-color: #B9F8D3;" class="form-control" name="d_date" id="d_date" min="1">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group text-white">
                            <label for="gig_img"><h6 class="text-white">Gig Images</h6></label>
                            <input type="file" class="form-control-file" name="gig_img" id="gig_img" accept="image/*">
                            </div>
                        </div>

                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-secondary"  id="btn-gig-submit">Publish</button>
                    </div>

                </form>

                </div>
            
            </div>
        </div>
    </div>
</div>
