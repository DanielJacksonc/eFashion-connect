
<div class="full-row mt-2" style="background-image: url(<?php echo base_url('assets/bg/job_post.jpg') ; ?>)">
    <div class="container">
        <div class="alert alert-danger d-none" id="alert"></div>
        <div class="alert alert-success d-none" id="success"></div>
        <div id="ruler" class="">
        </div>
    </div>

    <div class="container mt-4 p-2">
        <div class="main-body">
            <div class="row">

                <div class="col-sm-5"></div>
                <div class="col-sm-2 text-center">
                    <h2 class="px-5 bg-info" style="width: 350px;">Create Your Job</h2>
                </div>
                <div class="col-sm-5"></div>
            </div>

            <div class="row px-4">
                <div class="col-sm">
                <form autocomplete="off" id="btn-post-submit" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="category" class="bg-info"><h5>Category</h5></label>
                        <select name="category" class="form-control" id="category" style="background-color: #B9F8D3;">
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


                    <div class="form-group">
                        <label for="post_des" class="bg-info"><h5>Description</h5></label>
                        <textarea name="post_des" class="form-control" id="post_des" style="background-color: #B9F8D3;"></textarea>
                    </div>


                    <div class="row mt-4">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="price" class="bg-info"><h5>Price &#36;</h5></label>
                                <input type="number" class="form-control" style="background-color: #B9F8D3;" name="price" id="price" min="1">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="d_date" class="bg-info"><h5>Delivary Time</h5></label>
                                <input type="number" class="form-control" style="background-color: #B9F8D3;" name="d_date" id="d_date" min="1">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                            <label for="file" class="text-white"><h5 class="bg-info">Attach File</h5></label>
                            <input type="file" class="form-control-file text-white" name="file" id="file" accept="*">
                            </div>
                        </div>

                    </div>

                    <div class="form-group text-center mt-3">
                        <button class="btn btn-secondary"  id="btn-gig-submit"> Publish </button>
                    </div>

                </form>

                </div>
            
            </div>
        </div>
    </div>
    <div style="height:50px"></div>

</div>
